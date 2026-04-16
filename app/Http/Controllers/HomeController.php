<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use App\Models\ResearchCenter;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestNews = NewsEvent::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $newsCards = NewsEvent::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $featuredResearch = ResearchCenter::where('is_featured', true)
            ->with('department', 'researchers')
            ->orderBy('featured_order', 'asc')
            ->first();

        // Get all featured research (up to 5) for gallery
        $allFeaturedResearch = ResearchCenter::where('is_featured', true)
            ->with('department', 'researchers')
            ->orderBy('featured_order', 'asc')
            ->limit(5)
            ->get();

        return view('welcome', [
            'latestNews' => $latestNews,
            'newsCards' => $newsCards,
            'featuredResearch' => $featuredResearch,
            'allFeaturedResearch' => $allFeaturedResearch,
        ]);
    }
}
