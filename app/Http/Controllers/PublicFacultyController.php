<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FacultyMember;
use Illuminate\View\View;

class PublicFacultyController extends Controller
{
    /**
     * Display all faculty members.
     */
    public function index(): View
    {
        $faculty = FacultyMember::where('is_active', true)
            ->with('department')
            ->get();

        return view('public.faculty.index', [
            'faculty' => $faculty,
        ]);
    }

    /**
     * Display a specific faculty member.
     */
    public function show(FacultyMember $faculty): View
    {
        $faculty->load('department');

        return view('public.faculty.show', [
            'faculty' => $faculty,
        ]);
    }
}
