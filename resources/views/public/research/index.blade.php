<x-public-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[500px] pt-32 pb-20 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-maroon-100 rounded-full border border-maroon-200 mb-6">
                    <span class="w-2 h-2 bg-maroon-600 rounded-full"></span>
                    <span class="text-sm font-semibold text-maroon-700">Innovation Hub</span>
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Research Centers
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl leading-relaxed">
                    Discover our state-of-the-art research centers driving innovation and advancing engineering technology.
                </p>
            </div>
        </div>
    </section>

    <!-- Research Centers Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        @if ($researchCenters->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">🔬</div>
                <p class="text-gray-500 text-lg font-medium">No research centers available at this time.</p>
                <p class="text-gray-400 text-sm mt-1">Check back later for updates.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($researchCenters as $index => $center)
                    <a href="{{ route('view.research.show', $center) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                        <div class="card-premium h-full">
                            <div class="h-1.5 bg-gradient-to-r from-maroon-500 to-primary-500 rounded-t-2xl"></div>
                            <div class="relative bg-gradient-to-br from-maroon-500 to-maroon-700 h-32 flex items-center justify-center overflow-hidden">
                                <div class="absolute inset-0 hero-pattern opacity-30"></div>
                                <div class="relative text-5xl group-hover:scale-110 transition-transform duration-500">🔬</div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors">{{ $center->name }}</h3>
                                @if ($center->department)
                                    <p class="text-sm text-gray-500 mb-3 font-medium">{{ $center->department->name }}</p>
                                @endif
                                @if ($center->director)
                                <p class="text-sm text-gray-600 mb-3">
                                    <span class="font-semibold text-gray-700">Director:</span> {{ $center->director }}
                                </p>
                                @endif
                                <p class="text-gray-500 text-sm line-clamp-3 mb-5 leading-relaxed">
                                    {{ strip_tags($center->description) }}
                                </p>
                                <div class="flex items-center justify-between text-maroon-600 font-semibold text-sm pt-4 border-t border-gray-100">
                                    <span>Learn More</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</x-public-layout>
