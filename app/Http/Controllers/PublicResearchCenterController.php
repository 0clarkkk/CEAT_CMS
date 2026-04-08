<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ResearchCenter;
use Illuminate\View\View;

class PublicResearchCenterController extends Controller
{
    /**
     * Display a listing of research centers.
     */
    public function index(): View
    {
        $researchCenters = ResearchCenter::with('department')
            ->orderBy('name')
            ->get();

        return view('public.research.index', [
            'researchCenters' => $researchCenters,
        ]);
    }

    /**
     * Display the specified research center.
     */
    public function show(ResearchCenter $researchCenter): View
    {
        $researchCenter->load('department');

        return view('public.research.show', [
            'researchCenter' => $researchCenter,
        ]);
    }
}
