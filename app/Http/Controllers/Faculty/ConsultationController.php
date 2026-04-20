<?php

declare(strict_types=1);

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class ConsultationController extends Controller
{
    /**
     * Show all consultations for the faculty member.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty) {
            return view('faculty.consultations.index', [
                'consultations' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15, 1),
                'stats' => [
                    'total' => 0,
                    'pending' => 0,
                    'approved' => 0,
                    'scheduled' => 0,
                    'completed' => 0,
                    'rejected' => 0,
                ],
            ]);
        }

        $query = Consultation::where('advisor_id', $faculty->id);

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $consultations = $query->with(['student'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Get statistics
        $stats = [
            'total' => Consultation::where('advisor_id', $faculty->id)->count(),
            'pending' => Consultation::where('advisor_id', $faculty->id)->where('status', 'pending')->count(),
            'approved' => Consultation::where('advisor_id', $faculty->id)->where('status', 'approved')->count(),
            'scheduled' => Consultation::where('advisor_id', $faculty->id)->where('status', 'scheduled')->count(),
            'completed' => Consultation::where('advisor_id', $faculty->id)->where('status', 'completed')->count(),
            'rejected' => Consultation::where('advisor_id', $faculty->id)->where('status', 'rejected')->count(),
        ];

        return view('faculty.consultations.index', [
            'consultations' => $consultations,
            'stats' => $stats,
        ]);
    }

    /**
     * Show a specific consultation.
     */
    public function show(Consultation $consultation): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        // Check if this consultation belongs to the faculty member
        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $consultation->load(['student', 'advisor', 'rejectedBy']);

        return view('faculty.consultations.show', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Show the form to reject a consultation.
     */
    public function rejectForm(Consultation $consultation): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        return view('faculty.consultations.reject', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Reject a consultation.
     */
    public function reject(Consultation $consultation, Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|min:10|max:500',
        ]);

        $consultation->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'rejected_by' => $faculty->id,
            'rejected_at' => now(),
        ]);

        return redirect()
            ->route('faculty.consultations.show', $consultation->id)
            ->with('success', 'Consultation rejected successfully.');
    }

    /**
     * Show the form to approve a consultation.
     */
    public function approveForm(Consultation $consultation): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        return view('faculty.consultations.approve', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Approve a consultation.
     */
    public function approve(Consultation $consultation, Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $consultation->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('faculty.consultations.show', $consultation->id)
            ->with('success', 'Consultation approved. You can now schedule a date and time.');
    }

    /**
     * Show the form to schedule a consultation.
     */
    public function scheduleForm(Consultation $consultation): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        return view('faculty.consultations.schedule', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Schedule a consultation.
     */
    public function schedule(Consultation $consultation, Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required|date_format:H:i',
            'location' => 'required|string|min:3|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $scheduledAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated['scheduled_date'] . ' ' . $validated['scheduled_time']
        );

        $consultation->update([
            'status' => 'scheduled',
            'scheduled_at' => $scheduledAt,
            'location' => $validated['location'],
        ]);

        return redirect()
            ->route('faculty.consultations.show', $consultation->id)
            ->with('success', 'Consultation scheduled successfully.');
    }

    /**
     * Show the form to reschedule a consultation.
     */
    public function rescheduleForm(Consultation $consultation): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        return view('faculty.consultations.reschedule', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * Reschedule a consultation.
     */
    public function reschedule(Consultation $consultation, Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required|date_format:H:i',
            'location' => 'required|string|min:3|max:255',
            'reschedule_reason' => 'nullable|string|max:500',
        ]);

        $scheduledAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated['scheduled_date'] . ' ' . $validated['scheduled_time']
        );

        $consultation->update([
            'scheduled_at' => $scheduledAt,
            'location' => $validated['location'],
        ]);

        return redirect()
            ->route('faculty.consultations.show', $consultation->id)
            ->with('success', 'Consultation rescheduled successfully.');
    }

    /**
     * Mark a consultation as completed.
     */
    public function complete(Consultation $consultation, Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $consultation->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()
            ->route('faculty.consultations.show', $consultation->id)
            ->with('success', 'Consultation marked as completed.');
    }

    /**
     * Cancel a consultation.
     */
    public function cancel(Consultation $consultation): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('user_id', $user->id)->first();

        if (!$faculty || $consultation->advisor_id !== $faculty->id) {
            abort(403, 'Unauthorized access');
        }

        $consultation->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('faculty.consultations.index')
            ->with('success', 'Consultation cancelled.');
    }
}
