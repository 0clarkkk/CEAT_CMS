<!-- Unified Glass Header + Navigation -->
<nav x-data="{ mobileOpen: false, isScrolled: false }" 
     @scroll.window="isScrolled = window.scrollY > 100"
     :style="`position: sticky; top: 0; z-index: 50; transition: all 0.3s ease; ${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.95) 0%, rgba(127, 20, 22, 0.85) 100%); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25); border-bottom: 1px solid rgba(255, 255, 255, 0.1);' : 'background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(127, 20, 22, 0.1);'}`">
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
                <a href="{{ route('view.departments') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:bg-maroon-100 hover:shadow-lg hover:scale-105'" class="px-3 py-2 rounded-lg">About</a>
                <a href="{{ route('view.faculty') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:bg-maroon-100 hover:shadow-lg hover:scale-105'" class="px-3 py-2 rounded-lg">Academics</a>
                <a href="{{ route('view.news') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:bg-maroon-100 hover:shadow-lg hover:scale-105'" class="px-3 py-2 rounded-lg">Faculty & Staff</a>
                <a href="#" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:bg-maroon-100 hover:shadow-lg hover:scale-105'" class="px-3 py-2 rounded-lg">Students</a>
                <a href="#" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 400; font-size: 14px; padding: 8px 12px; display: inline-block; letter-spacing: 0.3px;" :class="isScrolled ? 'hover:bg-white/20 hover:shadow-lg hover:scale-105' : 'hover:bg-maroon-100 hover:shadow-lg hover:scale-105'" class="px-3 py-2 rounded-lg">Links</a>
            </div>

            <!-- Auth Buttons (right side) -->
            <div class="hidden lg:flex items-center gap-3 ml-auto">
                @auth
                <a href="{{ route('dashboard') }}" style="background-color: #ffc700; color: #7f1416; font-weight: 700; font-size: 14px; padding: 8px 16px; display: inline-block; border-radius: 6px; transition: all 0.3s ease;" class="hover:shadow-lg hover:shadow-yellow-400 hover:scale-110">Dashboard</a>
                @else
                <a href="{{ route('login') }}" :style="`${isScrolled ? 'color: white;' : 'color: #7f1416;'} transition: all 0.3s ease;`" style="font-weight: 600; font-size: 14px; padding: 8px 16px; display: inline-block;" :class="isScrolled ? 'hover:bg-white/20 hover:rounded-lg hover:scale-105' : 'hover:bg-maroon-100 hover:rounded-lg hover:scale-105'">Sign In</a>
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
