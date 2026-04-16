@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-24 bg-gradient-to-br from-maroon-900 via-maroon-800 to-primary-900 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400/5 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-tight mb-6">
                    Research Centers & Initiatives
                </h1>
                <p class="text-lg sm:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
                    Discover our cutting-edge research centers and innovation initiatives driving excellence in engineering and technology.
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Research Section -->
    @if($featuredResearch->isNotEmpty())
        <section class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                        Featured Research Centers
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Explore our spotlight research initiatives making impact in their fields
                    </p>
                    <div class="h-1 w-16 bg-gradient-to-r from-primary-500 to-transparent rounded-full mx-auto mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($featuredResearch as $research)
                        <div class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 hover:border-primary-400 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            
                            <!-- Fixed Image Container -->
                            <a href="{{ route('view.research.show', $research->slug) }}" class="relative h-64 bg-gradient-to-br from-primary-500 to-maroon-600 overflow-hidden block">
                                @if($research->thumbnail_photo)
                                    <img src="/storage/{{ $research->thumbnail_photo }}" 
                                         alt="{{ $research->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-5xl">🔬</div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                
                                <!-- Date Badge Overlapping Bottom of Image -->
                                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white border-4 border-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-maroon-600 uppercase tracking-widest whitespace-nowrap shadow-lg">
                                    {{ $research->created_at->format('M d, Y') }}
                                </div>
                            </a>

                            <!-- Content -->
                            <div class="p-6 flex-1 flex flex-col pt-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        @if($research->department)
                                            <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                {{ $research->department->name }}
                                            </p>
                                        @endif
                                        <a href="{{ route('view.research.show', $research->slug) }}" class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                            {{ $research->name }}
                                        </a>
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                    @if($research->featured_description)
                                        {{ Str::limit($research->featured_description, 120) }}
                                    @else
                                        {{ Str::limit(html_entity_decode(strip_tags($research->description)), 120) }}
                                    @endif
                                </p>

                                @if($research->researchers->isNotEmpty())
                                    <p class="text-xs text-gray-600 mb-4">
                                        <span class="font-semibold text-maroon-600">👥 {{ $research->researchers->count() === 1 ? 'Researcher' : 'Researchers' }}:</span> 
                                        {{ $research->researchers->pluck('name')->join(', ', ' & ') }}
                                    </p>
                                @endif

                                <!-- Read More Link - Pushed to Bottom -->
                                <div class="mt-auto pt-4 border-t border-gray-100 text-center">
                                    <a href="{{ route('view.research.show', $research->slug) }}" class="text-xs font-bold text-gray-500 hover:text-maroon-600 transition-colors uppercase tracking-widest cursor-pointer inline-block">
                                        Read More →
                                    </a>
                                </div>
                            </div>

                            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary-500/10 to-transparent rounded-full blur-2xl group-hover:from-primary-500/20 transition-all"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- All Research Centers Section -->
    <section class="py-16 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                    All Research Centers
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Browse our complete directory of research centers and initiatives
                </p>
                <div class="h-1 w-16 bg-gradient-to-r from-primary-500 to-transparent rounded-full mx-auto mt-6"></div>
            </div>

            @if($allResearch->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($allResearch as $research)
                        <div class="group relative bg-white rounded-2xl overflow-visible border border-gray-200 hover:border-primary-400 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            
                            <!-- Fixed Image Container -->
                            <a href="{{ route('view.research.show', $research->slug) }}" class="relative h-64 bg-gradient-to-br from-primary-500 to-maroon-600 overflow-hidden block">
                                @if($research->thumbnail_photo)
                                    <img src="/storage/{{ $research->thumbnail_photo }}" 
                                         alt="{{ $research->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-5xl">🔬</div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                
                                <!-- Date Badge Overlapping Bottom of Image -->
                                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white border-4 border-maroon-600 rounded-xl px-4 py-2 text-sm font-bold text-maroon-600 uppercase tracking-widest whitespace-nowrap shadow-lg">
                                    {{ $research->created_at->format('M d, Y') }}
                                </div>
                            </a>

                            <!-- Content -->
                            <div class="p-6 flex-1 flex flex-col pt-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        @if($research->department)
                                            <p class="text-xs font-bold text-maroon-600 uppercase tracking-widest mb-1">
                                                {{ $research->department->name }}
                                            </p>
                                        @endif
                                        <a href="{{ route('view.research.show', $research->slug) }}" class="text-xl font-bold text-gray-900 hover:text-maroon-600 transition-colors cursor-pointer block">
                                            {{ $research->name }}
                                        </a>
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                    @if($research->description)
                                        {{ Str::limit(html_entity_decode(strip_tags($research->description)), 120) }}
                                    @else
                                        Research and innovation center dedicated to advancing technology
                                    @endif
                                </p>

                                @if($research->researchers->isNotEmpty())
                                    <p class="text-xs text-gray-600 mb-4">
                                        <span class="font-semibold text-maroon-600">👥 {{ $research->researchers->count() === 1 ? 'Researcher' : 'Researchers' }}:</span> 
                                        {{ $research->researchers->pluck('name')->join(', ', ' & ') }}
                                    </p>
                                @endif

                                <!-- Read More Link - Pushed to Bottom -->
                                <div class="mt-auto pt-4 border-t border-gray-100 text-center">
                                    <a href="{{ route('view.research.show', $research->slug) }}" class="text-xs font-bold text-gray-500 hover:text-maroon-600 transition-colors uppercase tracking-widest cursor-pointer inline-block">
                                        Read More →
                                    </a>
                                </div>
                            </div>

                            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary-500/10 to-transparent rounded-full blur-2xl group-hover:from-primary-500/20 transition-all"></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-6 text-4xl">
                        🔬
                    </div>
                    <p class="text-gray-600 text-lg font-semibold">No research centers available</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Research Statistics Section -->
    <section class="py-24 bg-gradient-to-r from-maroon-900 to-primary-900 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Stat 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-primary-400/30">
                        <span class="text-4xl font-black text-primary-300">{{ $allResearch->count() }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Research Centers</h3>
                    <p class="text-white/70">Active centers driving innovation</p>
                </div>

                <!-- Stat 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-primary-400/30">
                        <span class="text-4xl font-black text-primary-300">{{ $allResearch->filter(fn($r) => $r->is_featured)->count() }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Featured</h3>
                    <p class="text-white/70">Spotlight initiatives</p>
                </div>

                <!-- Stat 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-primary-400/30">
                        <span class="text-4xl font-black text-primary-300">{{ $allResearch->pluck('department_id')->unique()->count() }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Departments</h3>
                    <p class="text-white/70">Involved in research</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Interested in Our Research?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Get in touch with our research centers to explore collaboration opportunities
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('view.research.all') }}" 
                   class="px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-bold rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300">
                    View All Research
                </a>
                <a href="{{ route('view.about.college') }}" 
                   class="px-8 py-4 bg-gray-100 text-gray-900 font-bold rounded-xl hover:bg-gray-200 transition-all duration-300">
                    Learn About CEAT
                </a>
            </div>
        </div>
    </section>
@endsection
