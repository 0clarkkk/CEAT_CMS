<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ResearchCenter;
use Illuminate\View\View;

class PublicResearchController extends Controller
{
    /**
     * Show research overview page for academics section
     */
    public function academy(): View
    {
        $allResearch = ResearchCenter::orderBy('featured_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $featuredResearch = ResearchCenter::where('is_featured', true)
            ->with('department')
            ->orderBy('featured_order', 'asc')
            ->limit(3)
            ->get();

        return view('public.research.academy', [
            'allResearch' => $allResearch,
            'featuredResearch' => $featuredResearch,
        ]);
    }

    public function index(): View
    {
        $research = ResearchCenter::orderBy('featured_order', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(12);

        return view('public.research.index', [
            'research' => $research,
        ]);
    }

    public function show(ResearchCenter $researchCenter): View
    {
        return view('public.research.show', [
            'researchCenter' => $researchCenter,
        ]);
    }
}
