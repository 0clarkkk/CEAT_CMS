<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\User;
use App\Services\ConsultationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function __construct(
        protected ConsultationService $consultationService
    ) {}

    /**
     * Show the student's consultation dashboard.
     */
    public function dashboard(): View
    {
        $student = auth()->user();
        $stats = $this->consultationService->getStudentStatistics($student->id);
        $consultations = $this->consultationService->getStudentConsultations($student->id, perPage: 5);
        $upcomingConsultations = Consultation::forStudent($student->id)
            ->upcoming()
            ->with(['advisor'])
            ->get();

        return view('student.consultations.dashboard', [
            'stats' => $stats,
            'consultations' => $consultations,
            'upcomingConsultations' => $upcomingConsultations,
        ]);
    }

    /**
     * Show all consultations for the student.
     */
    public function index(Request $request): View
    {
        $student = auth()->user();
        $status = $request->query('status');
        $consultations = $this->consultationService->getStudentConsultations(
            $student->id,
            $status,
            15
        );

        return view('student.consultations.index', [
            'consultations' => $consultations,
            'selectedStatus' => $status,
        ]);
    }

    /**
     * Show form to create a new consultation request.
     */
    public function create(): View
    {
        // Get all advisors
        $advisors = User::where('role', 'advisor')
            ->orWhereHas('roles', fn($q) => $q->where('name', 'advisor'))
            ->where('is_active', true)
            ->get();

        $categories = [
            'academic' => 'Academic',
            'career' => 'Career',
            'personal' => 'Personal',
            'technical' => 'Technical',
            'thesis' => 'Thesis',
            'other' => 'Other',
        ];

        return view('student.consultations.create', [
            'advisors' => $advisors,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a new consultation request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'advisor_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:1000',
            'category' => 'required|in:academic,career,personal,technical,thesis,other',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $consultation = $this->consultationService->createConsultationRequest(
                student_id: auth()->id(),
                advisor_id: $validated['advisor_id'],
                title: $validated['title'],
                description: $validated['description'],
                category: $validated['category'],
                notes: $validated['notes'] ?? null,
            );

            return redirect()
                ->route('student.consultations.show', $consultation->id)
                ->with('success', 'Consultation request submitted successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show a specific consultation.
     */
    public function show(Consultation $consultation): View
    {
        $this->authorize('view', $consultation);

        $consultation->load(['student', 'advisor', 'rejectedBy']);

        return view('student.consultations.show', [
            'consultation' => $consultation,
        ]);
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
                ->route('student.consultations.show', $consultation->id)
                ->with('success', 'Consultation cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show consultations by status.
     */
    public function byStatus(string $status): View
    {
        $validStatuses = ['pending', 'approved', 'scheduled', 'completed', 'rejected', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            abort(404);
        }

        $student = auth()->user();
        $consultations = $this->consultationService->getStudentConsultations(
            $student->id,
            $status,
            15
        );

        return view('student.consultations.by-status', [
            'consultations' => $consultations,
            'status' => $status,
        ]);
    }

    /**
     * Get available slots for a specific advisor.
     */
    public function getAdvisorSlots(Request $request): \Illuminate\Http\JsonResponse
    {
        $advisorId = $request->query('advisor_id');
        $date = $request->query('date');

        if (!$advisorId || !$date) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }

        try {
            $startDate = \Carbon\Carbon::parse($date)->startOfDay();
            $endDate = \Carbon\Carbon::parse($date)->endOfDay();

            $slots = $this->consultationService->getAdvisorAvailability(
                $advisorId,
                $startDate,
                $endDate,
                'available'
            );

            return response()->json([
                'slots' => $slots->map(fn($slot) => [
                    'id' => $slot->id,
                    'start_time' => $slot->start_time->toIso8601String(),
                    'end_time' => $slot->end_time->toIso8601String(),
                    'duration' => $slot->getFormattedDuration(),
                    'location' => $slot->location,
                ]),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
