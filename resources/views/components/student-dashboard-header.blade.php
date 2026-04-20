<!-- Modern Student Dashboard Header -->
<div class="sticky top-0 z-40 backdrop-blur-xl bg-white/80 border-b border-gray-200/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo & Breadcrumb -->
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">C</span>
                    </div>
                </a>
                <div class="hidden sm:block">
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-maroon-600 transition">Home</a>
                        <span class="text-gray-300">/</span>
                        <span class="text-maroon-600 font-medium">Dashboard</span>
                    </nav>
                </div>
            </div>

            <!-- Center: Welcome -->
            <div class="hidden lg:block text-center">
                <p class="text-sm text-gray-600">Welcome back, <span class="font-semibold text-gray-900">{{ Auth::user()->name }}</span></p>
            </div>

            <!-- Right: User Menu & Actions -->
            <div class="flex items-center gap-3">
                <!-- Quick Links -->
                <div class="hidden md:flex items-center gap-1 bg-gray-100 rounded-lg p-1">
                    <a href="{{ route('student.consultations.index') }}" class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-white rounded-md transition">Consultations</a>
                    <a href="{{ route('view.programs') }}" class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-white rounded-md transition">Programs</a>
                </div>

                <!-- Notifications (placeholder) -->
                <button class="relative p-2 text-gray-600 hover:text-maroon-600 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- User Avatar Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <div class="w-7 h-7 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-0 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile
                        </a>
                        <button type="button" onclick="document.getElementById('logout-form').submit()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 flex items-center gap-2 border-t border-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </div>
                </div>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
