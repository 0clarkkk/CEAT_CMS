<?php

declare(strict_types=1);

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\AdvisorAvailabilitySlot;
use App\Services\ConsultationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class ConsultationManagementController extends Controller
{
    public function __construct(
        protected ConsultationService $consultationService
    ) {}

    /**
     * Show the advisor's consultation dashboard.
     */
    public function dashboard(): View
    {
        $advisor = auth()->user();
        $stats = $this->consultationService->getAdvisorStatistics($advisor->id);
        
        $pendingConsultations = Consultation::forAdvisor($advisor->id)
            ->pending()
            ->with(['student'])
            ->limit(5)
            ->get();

        $upcomingConsultations = Consultation::forAdvisor($advisor->id)
            ->upcoming()
            ->with(['student'])
            ->limit(5)
            ->get();

        $todaySlots = AdvisorAvailabilitySlot::forAdvisor($advisor->id)
            ->onDate(now())
            ->get();

        return view('advisor.consultations.dashboard', [
            'stats' => $stats,
            'pendingConsultations' => $pendingConsultations,
            'upcomingConsultations' => $upcomingConsultations,
            'todaySlots' => $todaySlots,
        ]);
    }

    /**
     * Show all consultations for the advisor.
     */
    public function index(Request $request): View
    {
        $advisor = auth()->user();
        $status = $request->query('status');
        $consultations = $this->consultationService->getAdvisorConsultations(
            $advisor->id,
            $status,
            15
        );

        return view('advisor.consultations.index', [
            'consultations' => $consultations,
            'selectedStatus' => $status,
        ]);
    }

    /**
     * Show a specific consultation.
     */
    public function show(Consultation $consultation): View
    {
        $this->authorize('view', $consultation);

        $consultation->load(['student', 'advisor', 'rejectedBy']);

        return view('advisor.consultations.show', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Approve a consultation request.
     */
    public function approve(Consultation $consultation): RedirectResponse
    {
        $this->authorize('approve', $consultation);

        try {
            $this->consultationService->approveConsultation($consultation->id, auth()->id());

            return redirect()
                ->route('advisor.consultations.show', $consultation->id)
                ->with('success', 'Consultation approved successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show form to reject a consultation.
     */
    public function rejectForm(Consultation $consultation): View
    {
        $this->authorize('reject', $consultation);

        return view('advisor.consultations.reject', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Reject a consultation.
     */
    public function reject(Request $request, Consultation $consultation): RedirectResponse
    {
        $this->authorize('reject', $consultation);

        $validated = $request->validate([
            'rejection_reason' => 'required|string|min:10|max:500',
        ]);

        try {
            $this->consultationService->rejectConsultation(
                $consultation->id,
                auth()->id(),
                $validated['rejection_reason']
            );

            return redirect()
                ->route('advisor.consultations.index')
                ->with('success', 'Consultation rejected successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show form to schedule a consultation.
     */
    public function scheduleForm(Consultation $consultation): View
    {
        $this->authorize('schedule', $consultation);

        $advisor = auth()->user();
        $availableSlots = $this->consultationService->getAdvisorAvailability(
            $advisor->id,
            Carbon::now(),
            null,
            'available'
        );

        return view('advisor.consultations.schedule', [
            'consultation' => $consultation,
            'availableSlots' => $availableSlots,
        ]);
    }

    /**
     * Schedule a consultation.
     */
    public function schedule(Request $request, Consultation $consultation): RedirectResponse
    {
        $this->authorize('schedule', $consultation);

        $validated = $request->validate([
            'slot_id' => 'required|integer|exists:advisor_availability_slots,id',
            'location' => 'nullable|string|max:255',
        ]);

        try {
            $this->consultationService->scheduleConsultation(
                $consultation->id,
                auth()->id(),
                $validated['slot_id'],
                $validated['location'] ?? null
            );

            return redirect()
                ->route('advisor.consultations.show', $consultation->id)
                ->with('success', 'Consultation scheduled successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show form to reschedule a consultation.
     */
    public function rescheduleForm(Consultation $consultation): View
    {
        $this->authorize('reschedule', $consultation);

        $advisor = auth()->user();
        $availableSlots = $this->consultationService->getAdvisorAvailability(
            $advisor->id,
            Carbon::now(),
            null,
            'available'
        );

        return view('advisor.consultations.reschedule', [
            'consultation' => $consultation,
            'availableSlots' => $availableSlots,
        ]);
    }

    /**
     * Reschedule a consultation.
     */
    public function reschedule(Request $request, Consultation $consultation): RedirectResponse
    {
        $this->authorize('reschedule', $consultation);

        $validated = $request->validate([
            'slot_id' => 'required|integer|exists:advisor_availability_slots,id',
            'location' => 'nullable|string|max:255',
        ]);

        try {
            $this->consultationService->rescheduleConsultation(
                $consultation->id,
                auth()->id(),
                $validated['slot_id'],
                $validated['location'] ?? null
            );

            return redirect()
                ->route('advisor.consultations.show', $consultation->id)
                ->with('success', 'Consultation rescheduled successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Mark a consultation as completed.
     */
    public function complete(Consultation $consultation): RedirectResponse
    {
        $this->authorize('complete', $consultation);

        try {
            $this->consultationService->completeConsultation($consultation->id, auth()->id());

            return redirect()
                ->route('advisor.consultations.show', $consultation->id)
                ->with('success', 'Consultation marked as completed.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Cancel a consultation.
     */
    public function cancel(Consultation $consultation): RedirectResponse
    {
        $this->authorize('cancel', $consultation);

        try {
            $this->consultationService->cancelConsultation($consultation->id, auth()->id());

            return redirect()
                ->route('advisor.consultations.show', $consultation->id)
                ->with('success', 'Consultation cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // ===== Availability Management Routes =====

    /**
     * Show availability slots management page.
     */
    public function availabilityIndex(): View
    {
        $advisor = auth()->user();
        $slots = AdvisorAvailabilitySlot::forAdvisor($advisor->id)
            ->orderBy('start_time', 'desc')
            ->paginate(15);

        return view('advisor.consultations.availability.index', [
            'slots' => $slots,
        ]);
    }

    /**
     * Show form to create availability slots.
     */
    public function createSlotForm(): View
    {
        return view('advisor.consultations.availability.create');
    }

    /**
     * Store new availability slots.
     */
    public function storeSlots(Request $request): RedirectResponse
    {
        // Check if recurring slots are being created
        $isRecurring = $request->has('use_recurring') && $request->boolean('use_recurring');

        if ($isRecurring) {
            $validated = $request->validate([
                'recurring_start_date' => 'required|date_format:Y-m-d',
                'recurring_start_time' => 'required|date_format:H:i',
                'recurring_end_time' => 'required|date_format:H:i',
                'recurring_weeks' => 'required|integer|min:1|max:52',
                'recurring_days' => 'required|array|min:1',
                'recurring_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                'recurring_location' => 'nullable|string|max:255',
                'recurring_notes' => 'nullable|string|max:500',
            ]);

            try {
                $this->consultationService->createRecurringSlots(
                    auth()->id(),
                    $validated['recurring_start_date'],
                    $validated['recurring_days'],
                    $validated['recurring_start_time'],
                    $validated['recurring_end_time'],
                    (int) $validated['recurring_weeks'],
                    $validated['recurring_location'],
                    $validated['recurring_notes']
                );

                return redirect()
                    ->route('advisor.consultations.availability.index')
                    ->with('success', 'Recurring availability slots created successfully!');
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', $e->getMessage());
            }
        } else {
            // Individual slots
            $validated = $request->validate([
                'slots' => 'required|array|min:1',
                'slots.*.start_time' => 'required|date_format:Y-m-d\TH:i',
                'slots.*.end_time' => 'required|date_format:Y-m-d\TH:i|after:slots.*.start_time',
                'slots.*.location' => 'nullable|string|max:255',
                'slots.*.notes' => 'nullable|string|max:500',
            ]);

            try {
                $this->consultationService->createAvailabilitySlots(
                    auth()->id(),
                    $validated['slots']
                );

                return redirect()
                    ->route('advisor.consultations.availability.index')
                    ->with('success', 'Availability slots created successfully!');
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', $e->getMessage());
            }
        }
    }

    /**
     * Show form to edit an availability slot.
     */
    public function editSlotForm(AdvisorAvailabilitySlot $slot): View
    {
        $advisor = auth()->user();
        if ($slot->advisor_id !== $advisor->id) {
            abort(403);
        }

        return view('advisor.consultations.availability.edit', [
            'slot' => $slot,
        ]);
    }

    /**
     * Update an availability slot.
     */
    public function updateSlot(Request $request, AdvisorAvailabilitySlot $slot): RedirectResponse
    {
        $advisor = auth()->user();
        if ($slot->advisor_id !== $advisor->id) {
            abort(403);
        }

        $validated = $request->validate([
            'start_time' => 'nullable|date_format:Y-m-d H:i',
            'end_time' => 'nullable|date_format:Y-m-d H:i',
            'status' => 'required|in:available,booked,blocked',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $this->consultationService->updateAvailabilitySlot(
                $slot->id,
                $advisor->id,
                $validated
            );

            return redirect()
                ->route('advisor.consultations.availability.index')
                ->with('success', 'Availability slot updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an availability slot.
     */
    public function deleteSlot(AdvisorAvailabilitySlot $slot): RedirectResponse
    {
        $advisor = auth()->user();
        if ($slot->advisor_id !== $advisor->id) {
            abort(403);
        }

        try {
            $this->consultationService->deleteAvailabilitySlot($slot->id, $advisor->id);

            return redirect()
                ->route('advisor.consultations.availability.index')
                ->with('success', 'Availability slot deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Get upcoming slots for calendar view (JSON API).
     */
    public function getUpcomingSlots(): \Illuminate\Http\JsonResponse
    {
        $advisor = auth()->user();
        $slots = $this->consultationService->getAdvisorAvailability(
            $advisor->id,
            Carbon::now(),
            Carbon::now()->addMonths(3)
        );

        return response()->json([
            'slots' => $slots->map(fn($slot) => [
                'id' => $slot->id,
                'start' => $slot->start_time->toIso8601String(),
                'end' => $slot->end_time->toIso8601String(),
                'status' => $slot->status,
                'location' => $slot->location,
                'title' => $slot->status === 'available' ? 'Available' : ucfirst($slot->status),
            ]),
        ]);
    }
}
