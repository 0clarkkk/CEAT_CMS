<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function __invoke(): View
    {
        $user = auth()->user();
        $stats = [
            'departments' => Department::count(),
            'users' => \App\Models\User::count(),
            'programs' => \App\Models\Program::count(),
            'faculty' => \App\Models\FacultyMember::count(),
        ];

        return view('admin.dashboard', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }
}
