<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'University of Perpetual Help System DALTA - College of Engineering, Architecture, and Technology' }}">

    <title>{{ $title ?? config('app.name') }} | UPH Engineering</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900 custom-scrollbar">
    <div class="min-h-screen flex flex-col">
        <!-- Unified Glass Header + Navigation -->
        <nav x-data="{ mobileOpen: false, isScrolled: false }" 
             @scroll.window="isScrolled = window.scrollY > 100"
             :style="`position: fixed; top: 0; z-index: 50; width: 100%; transition: all 0.3s ease; ${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.95) 0%, rgba(127, 20, 22, 0.85) 100%); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25); border-bottom: 1px solid rgba(255, 255, 255, 0.1);' : 'background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(127, 20, 22, 0.1);'}`">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-auto lg:h-24 py-4 lg:py-2 flex-wrap lg:flex-nowrap gap-4 lg:gap-0">
                    <!-- Logo Section -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                        <img src="{{ asset('images/coe-logo.png') }}" alt="CEAT Logo" class="h-16 w-auto group-hover:scale-110 transition-transform duration-300">
                        <div class="hidden sm:block">
                            <h1 :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">COLLEGE OF ENGINEERING,</h1>
                            <h1 :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">ARCHITECTURE & TECHNOLOGY</h1>
                        </div>
                    </a>
                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-6 flex-1 justify-center" style="font-family: 'Inter', 'Segoe UI', sans-serif;">
                        <a href="{{ route('view.departments') }}" :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:shadow-2xl hover:scale-105'" class="px-3 py-2 rounded-lg">About</a>
                        <a href="{{ route('view.faculty') }}" :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:shadow-2xl hover:scale-105'" class="px-3 py-2 rounded-lg">Academics</a>
                        <a href="{{ route('view.news') }}" :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:shadow-2xl hover:scale-105'" class="px-3 py-2 rounded-lg">Faculty & Staff</a>
                        <a href="#" :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:shadow-2xl hover:scale-105'" class="px-3 py-2 rounded-lg">Students</a>
                        <a href="#" :style="`transition: all 0.3s ease; ${isScrolled ? 'color: white;' : 'color: #7f1416;'}`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:shadow-2xl hover:scale-105'" class="px-3 py-2 rounded-lg">Links</a>
                    </div>

                    <!-- Auth Buttons (right side) -->
                    <div class="hidden lg:flex items-center gap-3 ml-auto">
                        @auth
                        <a href="{{ route('dashboard') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 8px 16px; display: inline-block; border-radius: 6px; transition: all 0.3s ease;" class="hover:shadow-lg hover:shadow-yellow-400 hover:scale-110">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 600; font-size: 14px; padding: 8px 16px; display: inline-block;" :class="isScrolled ? 'hover:bg-white/20 hover:rounded-lg hover:scale-105' : 'hover:shadow-2xl hover:rounded-lg hover:scale-105'">Sign In</a>
                        <a href="{{ route('register') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 8px 16px; display: inline-block; border-radius: 6px; transition: all 0.3s ease;" class="hover:shadow-lg hover:shadow-yellow-400 hover:scale-110">Register</a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2.5 rounded-lg" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="transition-colors duration-300;">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileOpen" x-transition class="lg:hidden w-full pb-4" :style="isScrolled ? 'border-top: 1px solid rgba(255, 255, 255, 0.1); color: white;' : 'border-top: 1px solid rgba(127, 20, 22, 0.1); color: #7f1416;'" style="font-family: 'Inter', 'Segoe UI', sans-serif;">
                    <a href="{{ route('view.departments') }}" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 400; font-size: 14px; padding: 12px 16px; display: block; letter-spacing: 0.3px; transition-colors duration-300;">About</a>
                    <a href="{{ route('view.faculty') }}" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 400; font-size: 14px; padding: 12px 16px; display: block; letter-spacing: 0.3px; transition-colors duration-300;">Academics</a>
                    <a href="{{ route('view.news') }}" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 400; font-size: 14px; padding: 12px 16px; display: block; letter-spacing: 0.3px; transition-colors duration-300;">Faculty & Staff</a>
                    <a href="#" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 400; font-size: 14px; padding: 12px 16px; display: block; letter-spacing: 0.3px; transition-colors duration-300;">Students</a>
                    <a href="#" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 400; font-size: 14px; padding: 12px 16px; display: block; letter-spacing: 0.3px; transition-colors duration-300;">Links</a>
                    <div :style="isScrolled ? 'padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 16px;' : 'padding-top: 16px; border-top: 1px solid rgba(127, 20, 22, 0.1); margin-top: 16px;'" style="display: flex; flex-direction: column; gap: 8px;">
                        @auth
                        <a href="{{ route('dashboard') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 10px 16px; display: block; text-align: center; border-radius: 6px;">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" :style="isScrolled ? 'color: white;' : 'color: #7f1416;'" style="font-weight: 600; font-size: 14px; padding: 10px 16px; display: block; text-align: center; transition-colors duration-300;">Sign In</a>
                        <a href="{{ route('register') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 10px 16px; display: block; text-align: center; border-radius: 6px;">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="flex-grow mt-20 lg:mt-32">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-gray-400 relative overflow-hidden">
            <!-- Decorative top border -->
            <div class="h-1 bg-gradient-to-r from-maroon-500 via-primary-500 to-maroon-500"></div>

            <!-- Decorative shapes -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-maroon-500/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary-500/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-12 mb-12">
                    <!-- Brand -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-3 mb-6">
                            <img src="{{ asset('images/coe-logo.png') }}" alt="CEAT Logo" class="h-16 w-auto">
                            <div>
                                <h3 class="font-bold text-white text-sm">COLLEGE OF ENGINEERING,</h3>
                                <h3 class="font-bold text-white text-sm">ARCHITECTURE & TECHNOLOGY</h3>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                            Building the future through excellence in engineering education, innovative research, and community service.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Academic</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('view.departments') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Departments</a></li>
                            <li><a href="{{ route('view.programs') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Programs</a></li>
                            <li><a href="{{ route('view.faculty') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-maroon-500"></span>Faculty</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Resources</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('view.news') }}" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-primary-500"></span>News & Events</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-primary-500"></span>Support</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Contact</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                info@uphsd.edu.ph
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                +63 2 8xxx xxxx
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-maroon-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Las Piñas, Manila
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-gray-800 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                        <p class="text-gray-500">© {{ date('Y') }} University of Perpetual Help System DALTA. All rights reserved.</p>
                        <div class="flex gap-6">
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Terms</a>
                            <a href="#" class="text-gray-500 hover:text-primary-400 transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
