<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Consultation;
use App\Models\AdvisorAvailabilitySlot;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Exception;

class ConsultationService
{
    /**
     * Create a new consultation request by a student.
     */
    public function createConsultationRequest(
        int $studentId,
        int $advisorId,
        string $title,
        string $description,
        string $category,
        ?string $notes = null
    ): Consultation {
        // Validate advisor exists and is faculty with active consultation schedules
        $advisor = User::findOrFail($advisorId);
        
        \Log::info('Creating consultation', [
            'student_id' => $studentId,
            'advisor_id' => $advisorId,
            'advisor_role' => $advisor->role,
            'advisor_name' => $advisor->name,
        ]);
        
        if ($advisor->role !== 'faculty') {
            \Log::error('Advisor is not faculty', ['advisor_id' => $advisorId, 'role' => $advisor->role]);
            throw new Exception("User {$advisorId} is not a faculty member.");
        }
        
        // Verify advisor has active consultation slots
        $availableSlots = $advisor->availabilitySlots()->where('status', 'available')->count();
        \Log::info('Checking advisor availability slots', [
            'advisor_id' => $advisorId,
            'available_slots' => $availableSlots,
        ]);
        
        if ($availableSlots === 0) {
            \Log::error('Advisor has no available slots', ['advisor_id' => $advisorId]);
            throw new Exception("Advisor {$advisorId} has no available consultation slots.");
        }

        // Create consultation in pending status
        $consultation = Consultation::create([
            'student_id' => $studentId,
            'advisor_id' => $advisorId,
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'status' => 'pending',
            'notes' => $notes,
        ]);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($studentId))
            ->log('Consultation request created');

        return $consultation;
    }

    /**
     * Approve a consultation request.
     */
    public function approveConsultation(int $consultationId, int $advisorId): Consultation
    {
        $consultation = Consultation::findOrFail($consultationId);

        if ($consultation->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only approve their own consultations.");
        }

        if (!$consultation->isPending()) {
            throw new Exception("Only pending consultations can be approved.");
        }

        $consultation->update(['status' => 'approved']);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($advisorId))
            ->log('Consultation approved');

        return $consultation;
    }

    /**
     * Reject a consultation request with a reason.
     */
    public function rejectConsultation(int $consultationId, int $advisorId, string $reason): Consultation
    {
        $consultation = Consultation::findOrFail($consultationId);

        if ($consultation->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only reject their own consultations.");
        }

        if (!$consultation->isPending()) {
            throw new Exception("Only pending consultations can be rejected.");
        }

        $consultation->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'rejected_at' => now(),
            'rejected_by' => $advisorId,
        ]);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($advisorId))
            ->log('Consultation rejected');

        return $consultation;
    }

    /**
     * Schedule an approved consultation at an available slot.
     */
    public function scheduleConsultation(
        int $consultationId,
        int $advisorId,
        int $slotId,
        ?string $location = null
    ): Consultation {
        $consultation = Consultation::findOrFail($consultationId);
        $slot = AdvisorAvailabilitySlot::findOrFail($slotId);

        if ($consultation->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only schedule their own consultations.");
        }

        if (!$consultation->isApproved()) {
            throw new Exception("Only approved consultations can be scheduled.");
        }

        if ($slot->advisor_id !== $advisorId) {
            throw new Exception("Slot must belong to the same advisor.");
        }

        if (!$slot->isAvailable()) {
            throw new Exception("Selected slot is not available.");
        }

        // Update slot status to booked
        $slot->update(['status' => 'booked']);

        // Schedule the consultation
        $consultation->update([
            'status' => 'scheduled',
            'scheduled_at' => $slot->start_time,
            'location' => $location ?? $slot->location,
        ]);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($advisorId))
            ->log('Consultation scheduled');

        return $consultation;
    }

    /**
     * Reschedule a scheduled consultation to another available slot.
     * Only advisors can reschedule.
     */
    public function rescheduleConsultation(
        int $consultationId,
        int $advisorId,
        int $newSlotId,
        ?string $location = null
    ): Consultation {
        $consultation = Consultation::findOrFail($consultationId);
        $newSlot = AdvisorAvailabilitySlot::findOrFail($newSlotId);

        if ($consultation->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only reschedule their own consultations.");
        }

        if (!$consultation->canBeRescheduled()) {
            throw new Exception("Consultation cannot be rescheduled in its current status.");
        }

        if ($newSlot->advisor_id !== $advisorId) {
            throw new Exception("Slot must belong to the same advisor.");
        }

        if (!$newSlot->isAvailable()) {
            throw new Exception("Selected slot is not available.");
        }

        // Release old slot if it exists
        if ($consultation->scheduled_at) {
            $oldSlot = AdvisorAvailabilitySlot::where('advisor_id', $advisorId)
                ->where('start_time', $consultation->scheduled_at)
                ->first();

            if ($oldSlot) {
                $oldSlot->update(['status' => 'available']);
            }
        }

        // Book new slot
        $newSlot->update(['status' => 'booked']);

        // Update consultation
        $consultation->update([
            'scheduled_at' => $newSlot->start_time,
            'location' => $location ?? $newSlot->location,
        ]);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($advisorId))
            ->log('Consultation rescheduled');

        return $consultation;
    }

    /**
     * Cancel a consultation.
     */
    public function cancelConsultation(int $consultationId, int $userId): Consultation
    {
        $consultation = Consultation::findOrFail($consultationId);

        // Check if user can cancel (student or advisor of the consultation)
        if ($consultation->student_id !== $userId && $consultation->advisor_id !== $userId) {
            throw new Exception("User cannot cancel this consultation.");
        }

        if (!$consultation->canBeCancelled()) {
            throw new Exception("Consultation cannot be cancelled in its current status.");
        }

        // Release the slot if it was scheduled
        if ($consultation->scheduled_at) {
            $slot = AdvisorAvailabilitySlot::where('advisor_id', $consultation->advisor_id)
                ->where('start_time', $consultation->scheduled_at)
                ->first();

            if ($slot) {
                $slot->update(['status' => 'available']);
            }
        }

        $consultation->update(['status' => 'cancelled']);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($userId))
            ->log('Consultation cancelled');

        return $consultation;
    }

    /**
     * Mark a consultation as completed.
     */
    public function completeConsultation(int $consultationId, int $advisorId): Consultation
    {
        $consultation = Consultation::findOrFail($consultationId);

        if ($consultation->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only complete their own consultations.");
        }

        if (!$consultation->isScheduled()) {
            throw new Exception("Only scheduled consultations can be marked as completed.");
        }

        $consultation->update(['status' => 'completed']);

        activity()
            ->performedOn($consultation)
            ->causedBy(User::find($advisorId))
            ->log('Consultation completed');

        return $consultation;
    }

    /**
     * Get all consultations for a student with pagination.
     */
    public function getStudentConsultations(int $studentId, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Consultation::forStudent($studentId)
            ->with(['advisor', 'student', 'rejectedBy'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get all consultations for an advisor with pagination.
     */
    public function getAdvisorConsultations(int $advisorId, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Consultation::forAdvisor($advisorId)
            ->with(['advisor', 'student', 'rejectedBy'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get advisor's availability slots with filtering.
     */
    public function getAdvisorAvailability(
        int $advisorId,
        ?Carbon $startDate = null,
        ?Carbon $endDate = null,
        ?string $status = null
    ) {
        $query = AdvisorAvailabilitySlot::forAdvisor($advisorId)
            ->orderBy('start_time', 'asc');

        if ($startDate && $endDate) {
            $query->whereBetween('start_time', [$startDate, $endDate]);
        } else {
            // Default: show upcoming slots
            $query->where('start_time', '>', now());
        }

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    /**
     * Create availability slots in bulk.
     */
    public function createAvailabilitySlots(
        int $advisorId,
        array $slots
    ): array {
        $createdSlots = [];

        foreach ($slots as $slot) {
            $startTime = Carbon::parse($slot['start_time']);
            $endTime = Carbon::parse($slot['end_time']);

            // Validate time range
            if ($endTime <= $startTime) {
                throw new Exception("End time must be after start time.");
            }

            // Check for conflicts
            if (AdvisorAvailabilitySlot::hasConflict($advisorId, $startTime, $endTime)) {
                throw new Exception("Time slot conflicts with existing availability.");
            }

            $createdSlot = AdvisorAvailabilitySlot::create([
                'advisor_id' => $advisorId,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 'available',
                'location' => $slot['location'] ?? null,
                'notes' => $slot['notes'] ?? null,
            ]);

            $createdSlots[] = $createdSlot;
        }

        return $createdSlots;
    }

    /**
     * Update an availability slot.
     */
    public function updateAvailabilitySlot(
        int $slotId,
        int $advisorId,
        array $data
    ): AdvisorAvailabilitySlot {
        $slot = AdvisorAvailabilitySlot::findOrFail($slotId);

        if ($slot->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only update their own slots.");
        }

        if ($slot->isBooked()) {
            throw new Exception("Cannot update a booked slot.");
        }

        // Check for conflicts if time is being updated
        if (isset($data['start_time']) || isset($data['end_time'])) {
            $startTime = Carbon::parse($data['start_time'] ?? $slot->start_time);
            $endTime = Carbon::parse($data['end_time'] ?? $slot->end_time);

            if (AdvisorAvailabilitySlot::hasConflict($advisorId, $startTime, $endTime, $slotId)) {
                throw new Exception("Updated time slot conflicts with existing availability.");
            }
        }

        $slot->update($data);

        activity()
            ->performedOn($slot)
            ->causedBy(User::find($advisorId))
            ->log('Availability slot updated');

        return $slot;
    }

    /**
     * Delete an availability slot.
     */
    public function deleteAvailabilitySlot(int $slotId, int $advisorId): bool
    {
        $slot = AdvisorAvailabilitySlot::findOrFail($slotId);

        if ($slot->advisor_id !== $advisorId) {
            throw new Exception("Advisor can only delete their own slots.");
        }

        if ($slot->isBooked()) {
            throw new Exception("Cannot delete a booked slot.");
        }

        activity()
            ->performedOn($slot)
            ->causedBy(User::find($advisorId))
            ->log('Availability slot deleted');

        return $slot->delete();
    }

    /**
     * Get consultations by category.
     */
    public function getConsultationsByCategory(int $advisorId, string $category): array
    {
        return Consultation::forAdvisor($advisorId)
            ->where('category', $category)
            ->get()
            ->toArray();
    }

    /**
     * Get consultation statistics for an advisor.
     */
    public function getAdvisorStatistics(int $advisorId): array
    {
        return [
            'total_requests' => Consultation::forAdvisor($advisorId)->count(),
            'pending' => Consultation::forAdvisor($advisorId)->pending()->count(),
            'approved' => Consultation::forAdvisor($advisorId)->approved()->count(),
            'scheduled' => Consultation::forAdvisor($advisorId)->scheduled()->count(),
            'completed' => Consultation::forAdvisor($advisorId)->completed()->count(),
            'rejected' => Consultation::forAdvisor($advisorId)->rejected()->count(),
            'cancelled' => Consultation::forAdvisor($advisorId)->cancelled()->count(),
            'upcoming' => Consultation::forAdvisor($advisorId)->upcoming()->count(),
        ];
    }

    /**
     * Get consultation statistics for a student.
     */
    public function getStudentStatistics(int $studentId): array
    {
        return [
            'total_requests' => Consultation::forStudent($studentId)->count(),
            'pending' => Consultation::forStudent($studentId)->pending()->count(),
            'approved' => Consultation::forStudent($studentId)->approved()->count(),
            'scheduled' => Consultation::forStudent($studentId)->scheduled()->count(),
            'completed' => Consultation::forStudent($studentId)->completed()->count(),
            'rejected' => Consultation::forStudent($studentId)->rejected()->count(),
            'cancelled' => Consultation::forStudent($studentId)->cancelled()->count(),
            'upcoming' => Consultation::forStudent($studentId)->upcoming()->count(),
        ];
    }

    /**
     * Create recurring availability slots.
     * Example: Every Monday and Wednesday from 12:00 PM to 2:00 PM for 12 weeks
     */
    public function createRecurringSlots(
        int $advisorId,
        string $startDate,
        array $daysOfWeek,
        string $startTime,
        string $endTime,
        int $numberOfWeeks = 12,
        ?string $location = null,
        ?string $notes = null
    ): array {
        $createdSlots = [];
        $currentDate = Carbon::parse($startDate);
        $endDate = $currentDate->copy()->addWeeks($numberOfWeeks);

        // Map day names to Carbon constants
        $dayMap = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 0,
        ];

        // Convert day names to numbers
        $dayNumbers = array_map(fn($day) => $dayMap[$day] ?? null, $daysOfWeek);
        $dayNumbers = array_filter($dayNumbers, fn($d) => $d !== null);

        // Generate slots for each week
        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->dayOfWeek;

            if (in_array($dayOfWeek, $dayNumbers)) {
                $slotStartTime = $currentDate->copy()->setTimeFromTimeString($startTime);
                $slotEndTime = $currentDate->copy()->setTimeFromTimeString($endTime);

                // Check for conflicts
                if (!AdvisorAvailabilitySlot::hasConflict($advisorId, $slotStartTime, $slotEndTime)) {
                    $slot = AdvisorAvailabilitySlot::create([
                        'advisor_id' => $advisorId,
                        'start_time' => $slotStartTime,
                        'end_time' => $slotEndTime,
                        'status' => 'available',
                        'location' => $location,
                        'notes' => $notes,
                        'is_recurring' => true,
                        'recurrence_pattern' => 'weekly',
                        'recurrence_days' => $daysOfWeek,
                        'recurrence_end_weeks' => $numberOfWeeks,
                    ]);

                    $createdSlots[] = $slot;
                }
            }

            $currentDate->addDay();
        }

        return $createdSlots;
    }
}
