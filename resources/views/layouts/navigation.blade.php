<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div
                            class="w-9 h-9 bg-gradient-to-br from-orange-700 to-orange-700 rounded-xl flex items-center justify-center text-white font-bold text-[10px] shadow-md group-hover:shadow-lg transition-all duration-300">
                            CEAT
                        </div>
                        <span class="font-bold text-orange-700 text-sm hidden sm:inline">Dashboard</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-gray-500 hover:text-orange-700 hover:bg-orange-50 transition-all duration-200">
                        <span class="font-bold text-orange-700 text-sm hidden sm:inline">{{ __('Home') }}</span>
                    </a>
                </div>
            </div>

            <!-- Settings Icons & Hamburger Menu -->
            <div class="flex items-center gap-4 sm:gap-6">
                <!-- Profile Icon (Desktop) -->
                <a href="{{ route('profile.edit') }}"
                    class="hidden sm:flex items-center justify-center w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-700 rounded-lg text-white text-xs font-bold shadow-sm hover:shadow-md transition-all hover:from-orange-700 hover:to-orange-800"
                    title="Edit Profile">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </a>

                <!-- Logout Icon (Desktop) -->
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center p-2 text-gray-600 hover:text-orange-700 hover:bg-gray-100 rounded-lg transition-all"
                        title="Log Out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>

                <!-- Hamburger Menu Button (Mobile) -->
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out sm:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @php
            $responsiveDashboardActive = request()->routeIs('dashboard') ||
            request()->routeIs('student.dashboard') ||
            request()->routeIs('faculty.dashboard') ||
            request()->routeIs('superadmin.dashboard');
            $responsiveDashboardUrl = route('dashboard');
            if (auth()->check()) {
            if (auth()->user()->role === 'faculty') {
            $responsiveDashboardUrl = route('faculty.dashboard');
            } elseif (auth()->user()->role === 'student') {
            $responsiveDashboardUrl = route('student.dashboard');
            } elseif (auth()->user()->role === 'superadmin') {
            $responsiveDashboardUrl = route('superadmin.dashboard');
            }
            }
            @endphp
            <x-responsive-nav-link :href="$responsiveDashboardUrl" :active="$responsiveDashboardActive">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-gradient-to-br from-orange-400 to-orange-700 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-sm text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="font-medium text-xs text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit"
                        class="block w-full text-start px-4 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>