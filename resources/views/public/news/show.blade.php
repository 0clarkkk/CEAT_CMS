<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.news') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white font-medium text-sm transition-all duration-300 backdrop-blur-sm border border-white/20 hover:border-white/40 mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                <span>Back to News & Events</span>
            </a>

            <div class="flex flex-wrap items-center gap-3 mb-4 animate-fade-in">
                <span class="{{ $newsEvent->type === 'event' ? 'badge badge-success' : 'badge badge-maroon' }}">
                    {{ ucfirst($newsEvent->type) }}
                </span>
                @if ($newsEvent->event_date && $newsEvent->type === 'event')
                    <span class="text-gray-300 text-sm">{{ $newsEvent->event_date->format('F d, Y \a\t g:i A') }}</span>
                @elseif ($newsEvent->published_at)
                    <span class="text-gray-300 text-sm">{{ $newsEvent->published_at->format('F d, Y') }}</span>
                @endif
            </div>

            <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 animate-fade-in-up leading-tight">{{ $newsEvent->title }}</h1>

            <div class="flex flex-wrap items-center gap-4 text-gray-300 text-sm animate-fade-in-up animation-delay-100">
                <a href="{{ route('view.departments.show', $newsEvent->department) }}" class="hover:text-primary-300 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    {{ $newsEvent->department->name }}
                </a>
                @if ($newsEvent->location && $newsEvent->type === 'event')
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $newsEvent->location }}
                </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Image -->
    @if ($newsEvent->getFeaturedImageUrl())
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-8">
        <div class="rounded-2xl overflow-hidden shadow-elevated">
            <img src="{{ $newsEvent->getFeaturedImageUrl() }}" alt="{{ $newsEvent->title }}" class="w-full h-80 lg:h-96 object-cover">
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <div class="lg:col-span-2 space-y-8">
                <article class="card-premium p-8 animate-fade-in-up">
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($newsEvent->content)) !!}
                    </div>
                </article>

                <!-- Share Section -->
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Share This
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('view.news.show', $newsEvent)) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1877F2] text-white rounded-xl hover:opacity-90 transition-opacity text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('view.news.show', $newsEvent)) }}&text={{ urlencode($newsEvent->title) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1DA1F2] text-white rounded-xl hover:opacity-90 transition-opacity text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                        <a href="mailto:?subject={{ urlencode($newsEvent->title) }}&body={{ urlencode(route('view.news.show', $newsEvent)) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:opacity-90 transition-opacity text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="space-y-6">
                <!-- Details Box -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Details
                    </h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Type</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ ucfirst($newsEvent->type) }}</p>
                        </div>
                        @if ($newsEvent->department)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Department</p>
                            <a href="{{ route('view.departments.show', $newsEvent->department) }}" class="font-semibold text-maroon-600 text-sm hover:text-maroon-700 transition-colors">{{ $newsEvent->department->name }}</a>
                        </div>
                        @endif
                        @if ($newsEvent->published_at)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Published</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $newsEvent->published_at->format('F d, Y') }}</p>
                        </div>
                        @endif
                        @if ($newsEvent->event_date)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Event Date</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $newsEvent->event_date->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                        @endif
                        @if ($newsEvent->location)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Location</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $newsEvent->location }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related News/Events -->
                @if ($related->count() > 0)
                <div class="card-premium p-6 animate-fade-in-right animation-delay-100">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        Related {{ ucfirst($newsEvent->type) }}s
                    </h3>
                    <div class="space-y-3">
                        @foreach ($related as $relatedItem)
                        <a href="{{ route('view.news.show', $relatedItem) }}" class="block p-3 rounded-xl hover:bg-maroon-50 transition-colors group">
                            <p class="font-semibold text-sm text-gray-900 group-hover:text-maroon-600 transition-colors line-clamp-2">{{ $relatedItem->title }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ ($relatedItem->published_at ?? $relatedItem->created_at)->format('M d, Y') }}
                            </p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</x-public-layout>
