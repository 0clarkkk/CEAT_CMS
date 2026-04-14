<x-public-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[400px] pt-32 pb-20 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 {{ $type === 'events' ? 'bg-primary-100 border-primary-200' : 'bg-maroon-100 border-maroon-200' }} rounded-full border mb-6">
                    <span class="w-2 h-2 {{ $type === 'events' ? 'bg-primary-600' : 'bg-maroon-600' }} rounded-full"></span>
                    <span class="text-sm font-semibold {{ $type === 'events' ? 'text-primary-700' : 'text-maroon-700' }}">{{ $title }}</span>
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    {{ $title }}
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl leading-relaxed">
                    {{ $type === 'events' ? 'Explore all upcoming events and seminars.' : 'Browse all news and announcements.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Content Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        @if ($items->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                    {{ $type === 'events' ? '◈' : '▬' }}
                </div>
                <p class="text-gray-500 text-lg font-medium">
                    {{ $type === 'events' ? 'No events available at this time.' : 'No news available at this time.' }}
                </p>
                <p class="text-gray-400 text-sm mt-1">Check back later for updates.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($items as $index => $item)
                    <a href="{{ route('view.news.show', $item) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                        <article class="card-premium h-full">
                            <div class="h-1.5 {{ $type === 'events' ? 'bg-gradient-to-r from-primary-500 to-primary-400' : 'bg-gradient-to-r from-maroon-500 to-maroon-400' }} rounded-t-2xl"></div>

                            @if ($item->getFeaturedImageUrl())
                                <div class="relative h-52 overflow-hidden">
                                    <img src="{{ $item->getFeaturedImageUrl() }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                </div>
                            @else
                                <div class="relative h-52 {{ $type === 'events' ? 'bg-gradient-to-br from-primary-500 to-primary-600' : 'bg-gradient-to-br from-maroon-600 to-maroon-700' }} flex items-center justify-center overflow-hidden">
                                    <div class="absolute inset-0 hero-pattern opacity-30"></div>
                                    <div class="relative text-5xl group-hover:scale-110 transition-transform duration-500">
                                        {{ $type === 'events' ? '◈' : '▬' }}
                                    </div>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="{{ $type === 'events' ? 'badge badge-success' : 'badge badge-maroon' }}">
                                        {{ ucfirst($item->type) }}
                                    </span>
                                    @if ($item->event_date && $type === 'events')
                                        <span class="text-xs text-gray-400 font-medium">{{ $item->event_date->format('M d, Y') }}</span>
                                    @elseif ($item->published_at)
                                        <span class="text-xs text-gray-400 font-medium">{{ $item->published_at->format('M d, Y') }}</span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2 {{ $type === 'events' ? 'group-hover:text-primary-600' : 'group-hover:text-maroon-600' }} transition-colors line-clamp-2">{{ $item->title }}</h3>
                                <p class="text-sm text-gray-500 mb-3 font-medium">{{ $item->department->name }}</p>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-5 leading-relaxed">{{ $item->excerpt }}</p>

                                <div class="flex items-center justify-between {{ $type === 'events' ? 'text-primary-600' : 'text-maroon-600' }} font-semibold text-sm pt-4 border-t border-gray-100">
                                    <span>Read More</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($items->hasPages())
                <div class="flex justify-center">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </section>

    <!-- Back to News Button -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-gray-100">
        <a href="{{ route('view.news') }}" class="inline-flex items-center px-6 py-3 text-gray-700 font-semibold hover:text-maroon-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to News & Events
        </a>
    </section>
</x-public-layout>
