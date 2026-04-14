<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
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

        return view('welcome', [
            'latestNews' => $latestNews,
            'newsCards' => $newsCards,
        ]);
    }
}
