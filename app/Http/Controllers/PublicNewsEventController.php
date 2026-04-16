<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\View\View;

class PublicNewsEventController extends Controller
{
    /**
     * Display all news/events with filtering and pagination.
     */
    public function all(): View
    {
        $type = request('type', 'all');

        if ($type === 'events') {
            $items = NewsEvent::where('status', 'published')
                ->where('type', 'event')
                ->with('department', 'departments')
                ->orderBy('event_date', 'desc')
                ->paginate(12);
            $title = 'All Events';
        } else {
            $items = NewsEvent::where('status', 'published')
                ->where('type', '!=', 'event')
                ->with('department', 'departments')
                ->orderBy('published_at', 'desc')
                ->paginate(12);
            $title = 'All News';
        }

        return view('public.news.all', [
            'items' => $items,
            'type' => $type,
            'title' => $title,
        ]);
    }

    /**
     * Display a listing of news and events.
     */
    public function index(): View
    {
        // Get upcoming events
        $upcomingEvents = NewsEvent::where('status', 'published')
            ->where('type', 'event')
            ->with('department', 'departments')
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        // Get latest news
        $latestNews = NewsEvent::where('status', 'published')
            ->where('type', '!=', 'event')
            ->with('department', 'departments')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        return view('public.news.index', [
            'upcomingEvents' => $upcomingEvents,
            'latestNews' => $latestNews,
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

        $newsEvent->load('department', 'departments');

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
