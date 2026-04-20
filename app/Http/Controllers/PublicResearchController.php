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
        $allResearch = ResearchCenter::with('researchers')
            ->where(function ($query) {
                $query->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
            })
            ->orderByRaw("COALESCE(published_at, created_at) DESC")
            ->get();

        $featuredResearch = ResearchCenter::with('researchers', 'department')
            ->where('is_featured', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
            })
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
        $research = ResearchCenter::with('researchers')
            ->where(function ($query) {
                $query->whereNull('published_at')
                      ->orWhere('published_at', '<=', now());
            })
            ->orderByRaw("COALESCE(published_at, created_at) DESC")
            ->paginate(12);

        return view('public.research.index', [
            'research' => $research,
        ]);
    }

    public function show(ResearchCenter $researchCenter): View
    {
        if ($researchCenter->published_at !== null && $researchCenter->published_at > now()) {
            abort(404);
        }
        $researchCenter->load('researchers', 'department');
        return view('public.research.show', [
            'researchCenter' => $researchCenter,
        ]);
    }
}
