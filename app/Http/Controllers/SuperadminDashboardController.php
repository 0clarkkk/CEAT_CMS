<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\View\View;

class SuperadminDashboardController extends Controller
{
    /**
     * Display the superadmin dashboard.
     */
    public function __invoke(): View
    {
        $user = auth()->user();
        $stats = [
            'total_users' => User::count(),
            'students'    => User::where('role', 'student')->count(),
            'admins'      => User::where('role', 'admin')->count(),
            'departments' => Department::count(),
            'active_users' => User::where('is_active', true)->count(),
        ];

        $recentAdmins = User::where('role', 'admin')
            ->latest()
            ->limit(5)
            ->get(['id', 'name', 'email', 'is_active', 'last_login_at', 'created_at']);

        return view('superadmin.dashboard', [
            'user'         => $user,
            'stats'        => $stats,
            'recentAdmins' => $recentAdmins,
        ]);
    }
}
