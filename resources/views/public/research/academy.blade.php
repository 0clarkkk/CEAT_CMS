@extends('layouts.public')

@section('content')


    <style>
        [x-cloak] { display: none !important; }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .slide-item {
            animation: slideIn 0.6s ease-out forwards;
        }
    </style>

    <!-- Featured Research Carousel -->
    @if($featuredResearch->isNotEmpty())
        <section class="pt-32 pb-56 bg-white relative" x-data="{ current: 0, count: {{ $featuredResearch->count() }}, touchStartX: 0, touchEndX: 0, goNext() { this.current = (this.current + 1) % this.count; }, goPrev() { this.current = (this.current - 1 + this.count) % this.count; }, goToSlide(index) { this.current = index; }, handleSwipe() { const diff = this.touchStartX - this.touchEndX; if (Math.abs(diff) > 50) { diff > 0 ? this.goNext() : this.goPrev(); } } }" @touchstart="touchStartX = $event.touches[0].clientX" @touchend="touchEndX = $event.changedTouches[0].clientX; handleSwipe()">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                        Research Publications
                    </h2>
                </div>

                <!-- Carousel Grid -->
                <div class="relative">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="min-height: 550px;">
                        @foreach($featuredResearch as $index => $featured)
                            <div x-show="current === {{ $index }}" class="slide-item space-y-6">
                                <h3 class="text-3xl sm:text-4xl font-black text-gray-900">{{ $featured->name }}</h3>
                                <p class="text-lg text-gray-600 leading-relaxed">{{ Str::limit(html_entity_decode(strip_tags($featured->description)), 300) }}</p>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 rounded-lg border border-gray-200">
                                        <p class="text-sm font-semibold text-gray-600">{{ $featured->researchers->count() === 1 ? 'Researcher' : 'Researchers' }}</p>
                                        <p class="text-lg font-bold text-gray-700">{{ $featured->researchers->pluck('name')->join(', ') ?: 'N/A' }}</p>
                                    </div>
                                    <div class="p-4 rounded-lg border border-gray-200">
                                        <p class="text-sm font-semibold text-gray-600">Published Date</p>
                                        <p class="text-lg font-bold text-gray-700">{{ $featured->published_at?->format('M d, Y') ?? $featured->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('view.research.show', $featured->slug) }}" class="inline-block px-6 py-3 bg-maroon-600 text-white font-bold rounded-lg hover:bg-maroon-700 transition-colors">Read More</a>
                            </div>
                        @endforeach

                        @foreach($featuredResearch as $index => $featured)
                            <div x-show="current === {{ $index }}" class="slide-item">
                                <div class="relative h-96 rounded-xl overflow-hidden shadow-lg bg-gradient-to-br from-primary-500 to-maroon-600">
                                    @if($featured->thumbnail_photo)
                                        <img src="/storage/{{ $featured->thumbnail_photo }}" alt="{{ $featured->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    @if($featuredResearch->count() > 1)
                        <button @click="goPrev()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-16 z-10 p-3 rounded-full text-maroon-600 hover:bg-maroon-100 transition-colors" style="background: transparent;" @mouseenter="$event.target.style.background = 'rgba(147, 51, 54, 0.1)'" @mouseleave="$event.target.style.background = 'transparent'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="goNext()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-16 z-10 p-3 rounded-full text-maroon-600 hover:bg-maroon-100 transition-colors" style="background: transparent;" @mouseenter="$event.target.style.background = 'rgba(147, 51, 54, 0.1)'" @mouseleave="$event.target.style.background = 'transparent'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    @endif
                </div>

                <!-- Indicators -->
                @if($featuredResearch->count() > 1)
                    <div class="flex gap-2 justify-center mt-2">
                        @foreach($featuredResearch as $index => $featured)
                            <button @click="goToSlide({{ $index }})" :class="current === {{ $index }} ? 'bg-maroon-600 w-8' : 'bg-gray-300 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Research Categories -->
    <section class="pt-16 pb-24 bg-gray-50" x-data="{ tab: 'latest' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tab Navigation -->
            <div class="flex justify-start gap-12 mb-16">
                <button @click="tab = 'latest'" :style="tab === 'latest' ? 'border-bottom: 4px solid #933336;' : ''" :class="tab === 'latest' ? 'text-maroon-600 font-black' : 'text-gray-500 font-bold'" class="pb-4 text-lg transition-all duration-300 hover:text-maroon-600">
                    Latest Research
                </button>
                <button @click="tab = 'featured'" :style="tab === 'featured' ? 'border-bottom: 4px solid #933336;' : ''" :class="tab === 'featured' ? 'text-maroon-600 font-black' : 'text-gray-500 font-bold'" class="pb-4 text-lg transition-all duration-300 hover:text-maroon-600">
                    Featured Research
                </button>
            </div>

            <!-- Latest Research Grid -->
            <div x-show="tab === 'latest'" x-transition>
                @if($allResearch->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allResearch as $index => $research)
                            <a href="{{ route('view.research.show', $research->slug) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                                <article class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                    
                                    <!-- Fixed Image Container -->
                                    <div class="relative h-64 bg-gradient-to-br from-maroon-500 to-maroon-600 overflow-hidden block">
                                        @if($research->thumbnail_photo)
                                            <img src="/storage/{{ $research->thumbnail_photo }}" 
                                                 alt="{{ $research->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <div class="text-5xl"></div>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    </div>

                                    <!-- Date Badge Overlapping Image and Content -->
                                    <div class="absolute top-56 left-0 bg-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-white uppercase tracking-widest whitespace-nowrap shadow-lg z-20">
                                        {{ $research->published_at?->format('M d, Y') ?? $research->created_at->format('M d, Y') }}
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6 flex-1 flex flex-col pt-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                @if($research->department)
                                                    <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                        {{ $research->department->name }}
                                                    </p>
                                                @endif
                                                <h3 class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                                    {{ $research->name }}
                                                </h3>
                                            </div>
                                        </div>

                                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                            {{ html_entity_decode(strip_tags($research->description)) }}
                                        </p>

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

            <!-- Featured Research Grid -->
            <div x-show="tab === 'featured'" x-transition>
                @php $featured = $allResearch->where('is_featured', true); @endphp
                @if($featured->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($featured as $index => $research)
                            <a href="{{ route('view.research.show', $research->slug) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                                <article class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                    
                                    <!-- Fixed Image Container -->
                                    <div class="relative h-64 bg-gradient-to-br from-maroon-500 to-maroon-600 overflow-hidden block">
                                        @if($research->thumbnail_photo)
                                            <img src="/storage/{{ $research->thumbnail_photo }}" 
                                                 alt="{{ $research->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <div class="text-5xl"></div>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    </div>

                                    <!-- Date Badge Overlapping Image and Content -->
                                    <div class="absolute top-56 left-0 bg-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-white uppercase tracking-widest whitespace-nowrap shadow-lg z-20">
                                        {{ $research->published_at?->format('M d, Y') ?? $research->created_at->format('M d, Y') }}
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6 flex-1 flex flex-col pt-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                @if($research->department)
                                                    <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                        {{ $research->department->name }}
                                                    </p>
                                                @endif
                                                <h3 class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                                    {{ $research->name }}
                                                </h3>
                                            </div>
                                        </div>

                                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                            {{ html_entity_decode(strip_tags($research->description)) }}
                                        </p>

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
                @else
                    <p class="text-center text-gray-600 text-lg">No featured research available</p>
                @endif
            </div>
            <!-- Spacer for footer gap -->
            <div class="h-40"></div>
        </div>
    </section>
@endsection
