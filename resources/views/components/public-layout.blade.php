<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'University of Perpetual Help System DALTA - College of Engineering, Architecture, and Technology' }}">

    <title>UPHSD-CEAT</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900 custom-scrollbar pt-24 lg:pt-28">
    <div class="min-h-screen flex flex-col">
        <!-- Multi-level Navigation Menu Component -->
        <x-navigation-menu />
        
        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer Component
             Global footer for the public-facing application.
             Contains quick links, contact address, and legal text.
             Color scheme: Deep gray background, tangerine accents.
        --}}
        <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-gray-400 relative overflow-hidden">
            <!-- Decorative top border -->
            <div class="h-1 bg-gradient-to-r from-tangerine-500 via-orange-500 to-tangerine-500"></div>

            <!-- Decorative shapes -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-tangerine-500/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-gray-500/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

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
                            <li><a href="{{ route('view.departments') }}" class="hover:text-tangerine-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-tangerine-500"></span>Departments</a></li>
                            <li><a href="{{ route('view.programs') }}" class="hover:text-tangerine-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-tangerine-500"></span>Programs</a></li>
                            <li><a href="{{ route('view.faculty') }}" class="hover:text-tangerine-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-tangerine-500"></span>Faculty</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Resources</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('view.news') }}" class="hover:text-tangerine-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-gray-500"></span>News & Events</a></li>
                            <li><a href="#" class="hover:text-tangerine-400 transition-colors duration-200 flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-gray-500"></span>Support</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="font-semibold text-white mb-5 text-sm tracking-wider uppercase">Contact</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-tangerine-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                info@uphsd.edu.ph
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-tangerine-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                +63 2 8xxx xxxx
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-tangerine-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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
                            <a href="#" class="text-gray-500 hover:text-tangerine-400 transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-500 hover:text-tangerine-400 transition-colors">Terms</a>
                            <a href="#" class="text-gray-500 hover:text-tangerine-400 transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
