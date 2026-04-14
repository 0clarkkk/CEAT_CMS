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
    <section x-data="{ currentSlide: 0 }" class="relative bg-gray-900 overflow-hidden">
        <div class="relative h-96 sm:h-[500px] lg:h-[600px]">
            <!-- Slide 1 -->
            <div x-show="currentSlide === 0" x-transition class="absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url('{{ asset('images/sample1.jpg') }}'); background-size: cover; background-position: center;"></div>
            
            <!-- Slide 2 -->
            <div x-show="currentSlide === 1" x-transition class="absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url('{{ asset('images/sample2.jpg') }}'); background-size: cover; background-position: center;"></div>
            
            <!-- Slide 3 -->
            <div x-show="currentSlide === 2" x-transition class="absolute inset-0 w-full h-full" style="background-color: #7f1416;"></div>

            <!-- Navigation Buttons -->
            <button @click="currentSlide = (currentSlide - 1 + 3) % 3" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-maroon-700 hover:bg-maroon-500 text-white p-3 transition-all duration-300 hover:shadow-2xl hover:shadow-maroon-500 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="currentSlide = (currentSlide + 1) % 3" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-maroon-700 hover:bg-maroon-500 text-white p-3 transition-all duration-300 hover:shadow-2xl hover:shadow-maroon-500 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex gap-2">
                <button @click="currentSlide = 0" :class="currentSlide === 0 ? 'bg-primary-500' : 'bg-white/50'" class="w-3 h-3 rounded-full transition-colors"></button>
                <button @click="currentSlide = 1" :class="currentSlide === 1 ? 'bg-primary-500' : 'bg-white/50'" class="w-3 h-3 rounded-full transition-colors"></button>
                <button @click="currentSlide = 2" :class="currentSlide === 2 ? 'bg-primary-500' : 'bg-white/50'" class="w-3 h-3 rounded-full transition-colors"></button>
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
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-700 rounded-full text-xs font-bold mb-3">News</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">New Engineering Lab Opens</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">State-of-the-art robotics and AI laboratory now available for student research.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-bold mb-3">Event</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Annual Engineering Symposium</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">Join industry leaders for the 25th annual Engineering Symposium.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-maroon-700 to-maroon-900 flex items-center justify-center">
                            <div class="text-6xl">▬</div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-maroon-100 text-maroon-700 rounded-full text-xs font-bold mb-3">Research</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-700">Faculty Publication Highlight</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">Dr. Maria Santos publishes groundbreaking research on sustainable materials.</p>
                        </div>
                    </div>
                </a>
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
