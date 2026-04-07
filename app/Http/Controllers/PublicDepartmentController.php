<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\View\View;

class PublicDepartmentController extends Controller
{
    /**
     * Display a listing of all departments.
     */
    public function index(): View
    {
        $departments = Department::with(['programs', 'facultyMembers', 'researchCenters'])
            ->get();

        return view('public.departments.index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Display a specific department.
     */
    public function show(Department $department): View
    {
        $department->load(['programs', 'facultyMembers', 'researchCenters']);

        return view('public.departments.show', [
            'department' => $department,
        ]);
    }
}
