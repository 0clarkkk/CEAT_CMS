<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\View\View;

class PublicNewsEventController extends Controller
{
    /**
     * Display a listing of news and events.
     */
    public function index(): View
    {
        $newsEvents = NewsEvent::where('status', 'published')
            ->with('department')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('public.news.index', [
            'newsEvents' => $newsEvents,
        ]);
    }

    /**
     * Display the specified news/event item.
     */
    public function show(NewsEvent $newsEvent): View
    {
        if ($newsEvent->status !== 'published') {
            abort(404);
        }

        $newsEvent->load('department');

        // Get related news/events
        $related = NewsEvent::where('status', 'published')
            ->where('id', '!=', $newsEvent->id)
            ->where('type', $newsEvent->type)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('public.news.show', [
            'newsEvent' => $newsEvent,
            'related' => $related,
        ]);
    }
}
