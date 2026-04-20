<x-public-layout>
    <!-- Top Navigation with Buttons -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 border-b border-gray-100">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <!-- View All Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('view.news.all', ['type' => 'events']) }}" class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-lg hover:shadow-lg hover:shadow-primary-500 hover:scale-105 transition-all duration-300 text-center whitespace-nowrap">
                    View All Events
                </a>
                <a href="{{ route('view.news.all', ['type' => 'news']) }}" class="px-8 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-lg hover:shadow-lg hover:shadow-maroon-500 hover:scale-105 transition-all duration-300 text-center whitespace-nowrap">
                    View All News
                </a>
            </div>
        </div>
    </section>

    <!-- Hero Section with Updated Events -->
    <section class="relative min-h-[400px] pt-16 pb-12 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200 mb-4">
                <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                <span class="text-sm font-semibold text-primary-700">Stay Updated</span>
            </div>
            
            <div class="mb-8">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-3">Upcoming Events</h2>
                <p class="text-gray-600 text-lg">Don't miss out on important engineering events and seminars.</p>
            </div>

            @if ($upcomingEvents->isEmpty())
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">◈</div>
                    <p class="text-gray-500 text-lg font-medium">No upcoming events at this time.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($upcomingEvents as $index => $item)
                        <a href="{{ route('view.news.show', $item) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                            <article class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 hover:border-maroon-400 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                
                                <!-- Fixed Image Container -->
                                <div class="relative h-64 bg-gradient-to-br from-maroon-500 to-maroon-600 overflow-hidden block">
                                    @if ($item->getFeaturedImageUrl())
                                        <img src="{{ $item->getFeaturedImageUrl() }}" 
                                             alt="{{ $item->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-5xl">📰</div>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                </div>

                                <!-- Date Badge Overlapping Image and Content -->
                                <div class="absolute top-56 left-0 bg-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-white uppercase tracking-widest whitespace-nowrap shadow-lg z-20">
                                    {{ $item->published_at?->format('M d, Y') ?? $item->created_at->format('M d, Y') }}
                                </div>

                                <!-- Content -->
                                <div class="p-6 flex-1 flex flex-col pt-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            @if($item->department)
                                                <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                    {{ $item->department->name }}
                                                </p>
                                            @endif
                                            <h3 class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                                {{ $item->title }}
                                            </h3>
                                        </div>
                                    </div>

                                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                        {{ $item->excerpt }}
                                    </p>

                                    <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-600 text-xs font-bold rounded-full mb-4">{{ ucfirst($item->type) }}</span>

                                    <!-- Read More Link - Pushed to Bottom -->
                                    <div class="mt-auto pt-4 border-t border-gray-100 text-center">
                                        <span class="text-xs font-bold text-gray-500 hover:text-maroon-600 transition-colors uppercase tracking-widest cursor-pointer inline-block">
                                            Read More
                                        </span>
                                    </div>
                                </div>

                                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-maroon-500/10 to-transparent rounded-full blur-2xl group-hover:from-maroon-500/20 transition-all"></div>
                            </article>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-gray-100">
        <div class="mb-8">
            <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-3">Latest News</h2>
            <p class="text-gray-600 text-lg">Stay updated with the latest announcements and news.</p>
        </div>

        @if ($latestNews->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">▬</div>
                <p class="text-gray-500 text-lg font-medium">No recent news at this time.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($latestNews as $index => $item)
                    <a href="{{ route('view.news.show', $item) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                        <article class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 hover:border-maroon-400 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            
                            <!-- Fixed Image Container -->
                            <div class="relative h-64 bg-gradient-to-br from-maroon-500 to-maroon-600 overflow-hidden block">
                                @if ($item->getFeaturedImageUrl())
                                    <img src="{{ $item->getFeaturedImageUrl() }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-5xl">📰</div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            </div>

                            <!-- Date Badge Overlapping Image and Content -->
                            <div class="absolute top-56 left-0 bg-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-white uppercase tracking-widest whitespace-nowrap shadow-lg z-20">
                                {{ $item->published_at?->format('M d, Y') ?? $item->created_at->format('M d, Y') }}
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-1 flex flex-col pt-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        @if($item->department)
                                            <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                {{ $item->department->name }}
                                            </p>
                                        @endif
                                        <h3 class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                            {{ $item->title }}
                                        </h3>
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                    {{ $item->excerpt }}
                                </p>

                                <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-600 text-xs font-bold rounded-full mb-4">{{ ucfirst($item->type) }}</span>

                                <!-- Read More Link - Pushed to Bottom -->
                                <div class="mt-auto pt-4 border-t border-gray-100 text-center">
                                    <span class="text-xs font-bold text-gray-500 hover:text-maroon-600 transition-colors uppercase tracking-widest cursor-pointer inline-block">
                                        Read More
                                    </span>
                                </div>
                            </div>

                            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-maroon-500/10 to-transparent rounded-full blur-2xl group-hover:from-maroon-500/20 transition-all"></div>
                        </article>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</x-public-layout>
