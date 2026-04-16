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
        
        // Get faculty member, or create a minimal one if it doesn't exist
        $faculty = FacultyMember::where('user_id', $user->id)->first() 
            ?? FacultyMember::where('id', $user->faculty_member_id)->first();

        if (!$faculty) {
            // If no faculty member exists, return a view indicating they need to be set up
            return view('faculty.dashboard.index', [
                'faculty' => null,
                'pendingConsultations' => 0,
                'upcomingConsultations' => collect(),
                'completedThisMonth' => 0,
                'recentActivity' => collect(),
            ]);
        }

        // Get statistics
        $pendingConsultations = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'pending')
            ->count();

        $upcomingConsultations = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'approved')
            ->where('scheduled_at', '>=', now())
            ->where('scheduled_at', '<=', now()->addDays(7))
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        $completedThisMonth = Consultation::where('advisor_id', $faculty->id)
            ->where('status', 'completed')
            ->whereMonth('scheduled_at', now()->month)
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
