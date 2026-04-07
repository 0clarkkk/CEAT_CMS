<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class StudentDashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function __invoke(): View
    {
        $user = auth()->user();

        return view('student.dashboard', [
            'user' => $user,
        ]);
    }
}
