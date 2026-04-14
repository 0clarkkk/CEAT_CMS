<x-public-layout>
    <!-- Hero Section with Updated Events -->
    <section class="relative min-h-[500px] pt-32 pb-20 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200 mb-6">
                <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                <span class="text-sm font-semibold text-primary-700">Stay Updated</span>
            </div>
            
            <div class="mb-12">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Upcoming Events</h2>
                <p class="text-gray-600 text-lg">Don't miss out on important engineering events and seminars.</p>
            </div>

            @if ($upcomingEvents->isEmpty())
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">◈</div>
                    <p class="text-gray-500 text-lg font-medium">No upcoming events at this time.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($upcomingEvents as $index => $item)
                        <a href="{{ route('view.news.show', $item) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                            <article class="card-premium h-full">
                                <div class="h-1.5 bg-gradient-to-r from-primary-500 to-primary-400 rounded-t-2xl"></div>

                                @if ($item->getFeaturedImageUrl())
                                    <div class="relative h-52 overflow-hidden">
                                        <img src="{{ $item->getFeaturedImageUrl() }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="relative h-52 bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center overflow-hidden">
                                        <div class="absolute inset-0 hero-pattern opacity-30"></div>
                                        <div class="relative text-5xl group-hover:scale-110 transition-transform duration-500">◈</div>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="badge badge-success">Event</span>
                                        @if ($item->event_date)
                                            <span class="text-xs text-gray-400 font-medium">{{ $item->event_date->format('M d, Y') }}</span>
                                        @endif
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $item->title }}</h3>
                                    <p class="text-sm text-gray-500 mb-3 font-medium">{{ $item->department->name }}</p>
                                    <p class="text-gray-500 text-sm line-clamp-3 mb-5 leading-relaxed">{{ $item->excerpt }}</p>

                                    <div class="flex items-center justify-between text-primary-600 font-semibold text-sm pt-4 border-t border-gray-100">
                                        <span>Read More</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-gray-100">
        <div class="mb-12">
            <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Latest News</h2>
            <p class="text-gray-600 text-lg">Stay updated with the latest announcements and news.</p>
        </div>

        @if ($latestNews->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">▬</div>
                <p class="text-gray-500 text-lg font-medium">No recent news at this time.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($latestNews as $index => $item)
                    <a href="{{ route('view.news.show', $item) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                        <article class="card-premium h-full">
                            <div class="h-1.5 bg-gradient-to-r from-maroon-500 to-maroon-400 rounded-t-2xl"></div>

                            @if ($item->getFeaturedImageUrl())
                                <div class="relative h-52 overflow-hidden">
                                    <img src="{{ $item->getFeaturedImageUrl() }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                </div>
                            @else
                                <div class="relative h-52 bg-gradient-to-br from-maroon-600 to-maroon-700 flex items-center justify-center overflow-hidden">
                                    <div class="absolute inset-0 hero-pattern opacity-30"></div>
                                    <div class="relative text-5xl group-hover:scale-110 transition-transform duration-500">▬</div>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="badge badge-maroon">{{ ucfirst($item->type) }}</span>
                                    @if ($item->published_at)
                                        <span class="text-xs text-gray-400 font-medium">{{ $item->published_at->format('M d, Y') }}</span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors line-clamp-2">{{ $item->title }}</h3>
                                <p class="text-sm text-gray-500 mb-3 font-medium">{{ $item->department->name }}</p>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-5 leading-relaxed">{{ $item->excerpt }}</p>

                                <div class="flex items-center justify-between text-maroon-600 font-semibold text-sm pt-4 border-t border-gray-100">
                                    <span>Read More</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <!-- View All Buttons -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-gray-100">
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('view.news.all', ['type' => 'events']) }}" class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-xl hover:shadow-2xl hover:shadow-primary-500 hover:scale-105 transition-all duration-300 text-center">
                View All Events
            </a>
            <a href="{{ route('view.news.all', ['type' => 'news']) }}" class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-xl hover:shadow-2xl hover:shadow-maroon-500 hover:scale-105 transition-all duration-300 text-center">
                View All News
            </a>
        </div>
    </section>
</x-public-layout>
