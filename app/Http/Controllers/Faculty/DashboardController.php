<?php

declare(strict_types=1);

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\FacultyMember;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the faculty dashboard
     */
    public function index(): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('id', $user->faculty_member_id)->firstOrFail();

        // Get statistics
        $pendingConsultations = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'pending')
            ->count();

        $upcomingConsultations = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'approved')
            ->where('consultation_date', '>=', now())
            ->where('consultation_date', '<=', now()->addDays(7))
            ->orderBy('consultation_date')
            ->limit(5)
            ->get();

        $completedThisMonth = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'completed')
            ->whereMonth('consultation_date', now()->month)
            ->count();

        // Get recent activity
        $recentActivity = Consultation::where('advisor_id', $faculty->id)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('faculty.dashboard.index', [
            'faculty' => $faculty,
            'pendingConsultations' => $pendingConsultations,
            'upcomingConsultations' => $upcomingConsultations,
            'completedThisMonth' => $completedThisMonth,
            'recentActivity' => $recentActivity,
        ]);
    }
}
