<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\View\View;

class PublicProgramController extends Controller
{
    /**
     * Display all programs.
     */
    public function index(): View
    {
        $programs = Program::where('is_active', true)
            ->with('department')
            ->get();

        return view('public.programs.index', [
            'programs' => $programs,
        ]);
    }

    /**
     * Display a specific program.
     */
    public function show(Program $program): View
    {
        $program->load(['department', 'courses']);

        return view('public.programs.show', [
            'program' => $program,
        ]);
    }
}
