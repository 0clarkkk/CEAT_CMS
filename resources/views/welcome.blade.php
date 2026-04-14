@extends('layouts.public')

<style>
    [x-cloak] { display: none !important; }
    
    .gradient-mesh {
        background: linear-gradient(-45deg, rgba(154, 52, 57, 0.05), rgba(255, 199, 0, 0.05), rgba(154, 52, 57, 0.03));
        background-size: 400% 400%;
        animation: mesh 15s ease infinite;
    }
    
    @keyframes mesh {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card-hover {
        @apply transition-all duration-500 hover:shadow-2xl hover:-translate-y-2;
    }

    .accent-line {
        @apply relative;
    }

    .accent-line::before {
        @apply absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-primary-500 to-maroon-600 transition-all duration-500 group-hover:w-full;
        content: '';
    }
</style>

@section('content')

    <!-- Carousel Section -->
    <section x-data="{ currentSlide: 0, init() { setInterval(() => { this.currentSlide = (this.currentSlide + 1) % {{ count($latestNews) > 0 ? count($latestNews) : 1 }} }, 5000); } }" x-init="init()" class="relative bg-gray-100 py-6 sm:py-8 lg:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative h-96 sm:h-[500px] lg:h-[600px] rounded-2xl overflow-hidden bg-gray-900 shadow-xl">
                <!-- News Carousel Slides -->
                @forelse($latestNews as $index => $news)
                    <div x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-in-out duration-500" x-transition:leave="transition ease-in-out duration-500" class="absolute inset-0 w-full h-full bg-gray-900">
                        @if($news->getFeaturedImageUrl())
                            <img src="{{ $news->getFeaturedImageUrl() }}" alt="{{ $news->title }}" class="w-full h-full object-contain bg-gray-900">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <div class="text-6xl mb-4">◈</div>
                                    <p class="text-xl font-semibold">{{ $news->title }}</p>
                                </div>
                            </div>
                        @endif
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        
                        <!-- Content -->
                        <div class="absolute inset-0 flex items-end p-6 sm:p-8 lg:p-12">
                            <div class="max-w-2xl text-white">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 bg-{{ $news->type === 'event' ? 'primary' : 'maroon' }}-500 text-white text-sm font-bold rounded-full">{{ ucfirst($news->type) }}</span>
                                    <span class="text-sm text-gray-200">{{ $news->published_at?->format('M d, Y') }}</span>
                                </div>
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-3 line-clamp-2">{{ $news->title }}</h2>
                                <p class="text-gray-200 text-sm sm:text-base mb-4 line-clamp-2">{{ $news->excerpt }}</p>
                                <a href="{{ route('view.news.show', $news) }}" class="inline-flex items-center gap-2 px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white font-bold rounded-lg transition-colors">
                                    Read More
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Slide -->
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                        <div class="text-center text-white">
                            <div class="text-6xl mb-4">◈</div>
                            <p class="text-xl font-semibold">Welcome to CEAT</p>
                        </div>
                    </div>
                @endforelse

                <!-- Navigation Buttons -->
                @if(count($latestNews) > 1)
                    <button @click="currentSlide = (currentSlide - 1 + {{ count($latestNews) }}) % {{ count($latestNews) }}" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-maroon-700 hover:bg-maroon-500 text-white p-3 rounded-lg transition-all duration-300 hover:shadow-2xl hover:shadow-maroon-500 hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="currentSlide = (currentSlide + 1) % {{ count($latestNews) }}" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-maroon-700 hover:bg-maroon-500 text-white p-3 rounded-lg transition-all duration-300 hover:shadow-2xl hover:shadow-maroon-500 hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex gap-2">
                        @for($i = 0; $i < count($latestNews); $i++)
                            <button @click="currentSlide = {{ $i }}" :class="currentSlide === {{ $i }} ? 'bg-primary-500' : 'bg-white/50'" class="w-3 h-3 rounded-full transition-colors"></button>
                        @endfor
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="relative min-h-screen pt-32 pb-20 overflow-hidden gradient-mesh">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200">
                            <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                            <span class="text-sm font-semibold text-primary-700">UPHSD DALTA - College of Engineering, Architecture & Technology</span>
                        </div>
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-gray-900 leading-tight">
                            Leading Excellence in
                            <span class="block bg-gradient-to-r from-maroon-600 to-maroon-800 bg-clip-text text-transparent">Engineering Education</span>
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-600 max-w-xl leading-relaxed">
                            Discover premier engineering programs, world-class faculty expertise, and innovative research opportunities at the University of Perpetual Help System DALTA's College of Engineering, Architecture, and Technology.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('view.departments') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl hover:shadow-maroon-600 hover:scale-110 transition-all duration-300">
                            Explore Programs
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('view.news') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-gray-200 text-gray-900 font-bold rounded-xl hover:border-maroon-600 hover:bg-maroon-50 hover:shadow-lg hover:shadow-maroon-300 hover:scale-110 transition-all duration-300">
                            Latest News
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8">
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">.</div>
                            <p class="text-sm text-gray-600">Departments</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">.</div>
                            <p class="text-sm text-gray-600">Programs</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-3xl font-black text-maroon-700">.</div>
                            <p class="text-sm text-gray-600">Faculty</p>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="hidden lg:block relative h-[600px]">
                    <div class="absolute inset-0 bg-gradient-to-br from-maroon-600 to-maroon-800 rounded-3xl shadow-2xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500/20 to-transparent rounded-3xl"></div>
                    <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-2xl backdrop-blur-xl"></div>
                    <div class="absolute bottom-10 left-10 w-24 h-24 bg-white/10 rounded-2xl backdrop-blur-xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary-100 rounded-full text-sm font-bold text-primary-700 mb-4">Stay Updated</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6">
                    Latest News & Events
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Keep informed about important announcements and upcoming events at UPHSD DALTA's College of Engineering, Architecture, and Technology.
                </p>
            </div>

            <!-- News Cards -->
            <div class="grid lg:grid-cols-3 gap-8 mb-12">
                <!-- Featured News (Left - Large Card) -->
                @if($newsCards->isNotEmpty())
                    @php $featured = $newsCards->first(); @endphp
                    <div class="lg:col-span-2">
                        <a href="{{ route('view.news.show', $featured) }}" class="group block">
                            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 h-full flex flex-col">
                                @if($featured->getFeaturedImageUrl())
                                    <div class="h-80 overflow-hidden">
                                        <img src="{{ $featured->getFeaturedImageUrl() }}" alt="{{ $featured->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                @else
                                    <div class="h-80 bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                                        <div class="text-6xl text-white/30">◈</div>
                                    </div>
                                @endif
                                <div class="p-8 flex flex-col flex-grow">
                                    <span class="inline-block px-3 py-1 bg-{{ $featured->type === 'event' ? 'primary' : 'maroon' }}-100 text-{{ $featured->type === 'event' ? 'primary' : 'maroon' }}-700 rounded-full text-xs font-bold mb-4 w-fit">{{ ucfirst($featured->type) }}</span>
                                    <div class="text-sm text-gray-400 mb-2">{{ $featured->published_at?->format('M d, Y') }}</div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-maroon-700 line-clamp-3">{{ $featured->title }}</h3>
                                    <p class="text-gray-600 text-base line-clamp-4 flex-grow">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) }}</p>
                                    <div class="pt-4 mt-4 border-t border-gray-100">
                                        <span class="inline-flex items-center text-maroon-600 font-semibold text-sm group-hover:text-maroon-700">
                                            READ MORE →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- News List (Right - Vertical Cards) -->
                    <div class="space-y-4">
                        @foreach($newsCards->skip(1) as $news)
                            <a href="{{ route('view.news.show', $news) }}" class="group block">
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 p-4 hover:border-maroon-200">
                                    <div class="text-sm text-gray-400 mb-2">{{ $news->published_at?->format('M d, Y') }}</div>
                                    <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-700 line-clamp-2">{{ $news->title }}</h4>
                                    <span class="inline-flex items-center text-maroon-600 font-semibold text-xs group-hover:text-maroon-700">
                                        READ MORE →
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- Fallback when no news -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 h-96 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl text-gray-300 mb-4">◈</div>
                                <p class="text-gray-500 font-semibold">No News Available</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                            <p class="text-gray-500 text-sm">Check back soon for latest updates</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('view.news') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-bold rounded-xl hover:shadow-2xl hover:shadow-maroon-500 hover:scale-110 transition-all duration-300">
                    View All News →
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-maroon-700 via-maroon-600 to-maroon-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-black text-white mb-6 leading-tight">
                Begin Your Engineering Excellence Journey
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Join our community of innovators and become part of UPHSD DALTA's College of Engineering, Architecture, and Technology legacy.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" style="padding: 14px 32px; background: #8b0000; color: white; font-weight: 600; border-radius: 8px; text-decoration: none; display: inline-block; transition: all 0.3s ease; border: none; cursor: pointer; box-shadow: 0 5px 15px rgba(139, 0, 0, 0.2);" onmouseover="this.style.background='#6b0000'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(139, 0, 0, 0.3)';" onmouseout="this.style.background='#8b0000'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(139, 0, 0, 0.2)';">
                    Enroll Now
                </a>
                <a href="{{ route('view.programs') }}" class="px-8 py-4 bg-white/10 text-white font-bold rounded-xl hover:bg-white/30 hover:shadow-2xl hover:shadow-white/20 transition-all duration-300 border border-white/30 hover:border-white hover:scale-110">
                    Learn More
                </a>
            </div>
        </div>
    </section>

@endsection
