{{-- Navigation Menu Component
Contains the desktop and mobile navigation header for the public pages.
Handles layout, dropdown behavior, scroll-based transparency, and CTA links.
Theme: Orange & Black .
--}}
<header x-data="navigationMenu()" x-init="initScrollListener()"
    class="fixed top-0 w-full z-50 transition-all duration-300" style="z-index: 9999;"
    :class="isScrolled ? 'shadow-lg' : ''">

    <!-- Top Bar: News Ticker & Socials -->
    <div class="nav-top-bar flex items-center justify-between px-4 sm:px-6 lg:px-8"
        style="background-color: #000000; height: 34px; border-bottom: 1px solid #222; z-index: 50;">
        <div class="flex-1 flex items-center h-full relative overflow-hidden">
            <div class="news-tab"
                style="background-color: #f05a22; color: white; padding: 0 35px 0 20px; height: 100%; display: flex; align-items: center; font-weight: 800; font-size: 10px; clip-path: polygon(0 0, 85% 0, 100% 100%, 0 100%); position: absolute; left: 0; top: 0; z-index: 20;">
                NEWS</div>
            <div class="news-ticker-container"
                style="flex: 1; padding-left: 110px; overflow: hidden; display: flex; align-items: center; height: 100%;">
                <div class="news-ticker-content"
                    style="white-space: nowrap; display: inline-block; animation: ticker-animation 35s linear infinite; color: #ffffff; font-size: 11px; font-weight: 500; font-style: italic;">
                    @php
                    $tickerNews = \App\Models\NewsEvent::latest()->take(3)->get();
                    @endphp
                    @if($tickerNews->count() > 0)
                    @foreach($tickerNews as $news)
                    <span class="mx-10">{{ $news->title }} • {{ $news->created_at->format('M d, Y') }}</span>
                    @endforeach
                    @else
                    <span class="mx-10">Welcome to the College of Engineering, Architecture and Technology.</span>
                    <span class="mx-10">New academic programs for the upcoming semester are now open for
                        application.</span>
                    <span class="mx-10">CEAT Research Symposium 2026: Call for papers is now active.</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="social-icons-container hidden sm:flex h-full">
            <a href="#" class="social-icon-box"
                style="width: 36px; height: 100%; display: flex; align-items: center; justify-content: center; color: #ffffff; border-left: 1px solid #222; transition: all 0.2s ease;"><i
                    class="fab fa-facebook-f text-[10px]"></i></a>
            <a href="#" class="social-icon-box"
                style="width: 36px; height: 100%; display: flex; align-items: center; justify-content: center; color: #ffffff; border-left: 1px solid #222; transition: all 0.2s ease;"><i
                    class="fab fa-twitter text-[10px]"></i></a>
            <a href="#" class="social-icon-box"
                style="width: 36px; height: 100%; display: flex; align-items: center; justify-content: center; color: #ffffff; border-left: 1px solid #222; transition: all 0.2s ease;"><i
                    class="fab fa-linkedin-in text-[10px]"></i></a>
        </div>
    </div>

    <!-- Brand Bar: Logo & Search -->
    <div class="brand-bar px-4 sm:px-6 lg:px-8 transition-all duration-300"
        style="border-bottom: 1px solid rgba(0,0,0,0.05); z-index: 40;"
        :style="isScrolled ? 'background-color: rgba(255,255,255,1); padding-top: 8px; padding-bottom: 8px;' : 'background-color: rgba(255,255,255,0.9); backdrop-filter: blur(8px); padding-top: 15px; padding-bottom: 15px;'">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo Section -->
            <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                <img src="{{ asset('images/coe-logo.png') }}" alt="CEAT Logo"
                    class="transition-all duration-300 group-hover:scale-105"
                    style="object-fit: contain; filter: drop-shadow(0 2px 3px rgba(0,0,0,0.1));"
                    :style="isScrolled ? 'height: 42px;' : 'height: 60px;'">
                <div class="flex flex-col">
                    <span class="font-black tracking-tighter leading-none transition-all duration-300 uppercase"
                        style="display: block; color: #000000;"
                        :style="`font-size: ${isScrolled ? '1rem' : '1.4rem'}; text-shadow: 0 1px 1px rgba(255,255,255,0.5);`"
                        class="text-gray-900">College of Engineering,</span>
                    <span class="font-black tracking-tighter leading-none transition-all duration-300 uppercase"
                        style="display: block; color: #000000;"
                        :style="`font-size: ${isScrolled ? '1rem' : '1.4rem'}; text-shadow: 0 1px 1px rgba(255,255,255,0.5);`"
                        class="text-gray-900"> Architecture and Technology</span>
                </div>
            </a>

            <!-- Search and Auth Section -->
            <div class="hidden lg:flex items-center gap-6">
                <!-- Smaller, More Visible Search Bar -->
                <div class="nav-search-container" style="position: relative; width: 280px;">
                    <span class="nav-search-icon"
                        style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #1a1a1a; z-index: 10;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search..." class="nav-search-input"
                        style="width: 100%; background-color: #ffffff; border: 1.5px solid #1a1a1a; border-radius: 9999px; padding: 7px 15px 7px 40px; font-size: 13px; font-weight: 600; color: #1a1a1a; transition: all 0.3s ease;">
                </div>

                <!-- Balanced Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                    @php
                    $dashboardUrl = route('dashboard');
                    if (auth()->user()->role === 'faculty') $dashboardUrl = route('faculty.dashboard');
                    elseif (auth()->user()->role === 'student') $dashboardUrl = route('student.dashboard');
                    elseif (auth()->user()->role === 'superadmin') $dashboardUrl = route('superadmin.dashboard');
                    @endphp
                    <a href="{{ $dashboardUrl }}"
                        class="px-5 py-2 bg-[#f05a22] text-white text-xs font-black rounded-full hover:bg-black transition-all shadow-md uppercase tracking-wide">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-xs font-black text-slate-900 hover:text-[#f05a22] transition-all px-4 py-2 border border-transparent hover:border-gray-200 hover:bg-gray-50 rounded-full uppercase tracking-wide shadow-sm"
                        style="background-color: rgba(255,255,255,0.8); backdrop-filter: blur(4px);">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-[#f05a22] text-white text-xs font-black rounded-full hover:bg-black transition-all shadow-md hover:shadow-lg uppercase tracking-wide border border-[#e04e1a]">
                        Join Now
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2 rounded-xl bg-gray-100 text-black hover:bg-gray-200 transition-colors">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="main-nav-bar hidden lg:block transition-all duration-300"
        style="background-color: #f05a22; box-shadow: 0 4px 10px rgba(0,0,0,0.1); z-index: 30;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                @foreach($navigationItems as $itemKey => $item)
                <div class="flex-1 flex justify-center border-r border-white/20 last:border-r-0">
                    @if($item['hasDropdown'])
                    <div class="relative w-full group" @mouseenter="openDropdown('{{ $itemKey }}')"
                        @mouseleave="closeDropdown()">
                        <button class="nav-menu-item w-full"
                            style="color: white; font-size: 13px; font-weight: 800; text-transform: uppercase; padding: 14px 10px; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s ease; letter-spacing: 0.6px;"
                            :class="activeDropdown === '{{ $itemKey }}' && 'active'"
                            :style="activeDropdown === '{{ $itemKey }}' ? 'background-color: rgba(0,0,0,0.2);' : ''">
                            {{ $item['label'] }}
                            <svg class="w-3.5 h-3.5 opacity-100 transition-transform duration-300"
                                :class="activeDropdown === '{{ $itemKey }}' && 'rotate-180'" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu (Orange Background, White Text) -->
                        <div x-show="activeDropdown === '{{ $itemKey }}'" x-cloak x-transition
                            class="absolute top-full left-0 nav-dropdown-menu"
                            style="background-color: #f05a22; border-radius: 0 0 8px 8px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); border-top: 2px solid rgba(255,255,255,0.3); min-width: 240px; z-index: 100; padding: 8px 0;">
                            @foreach($item['items'] as $subItem)
                            <a href="{{ $subItem['url'] }}" class="block nav-dropdown-item"
                                style="color: white; padding: 12px 24px; font-size: 13px; font-weight: 700; transition: all 0.2s ease; border-left: 4px solid transparent;"
                                onmouseenter="this.style.backgroundColor='rgba(0,0,0,0.15)'; this.style.borderLeftColor='white';"
                                onmouseleave="this.style.backgroundColor='transparent'; this.style.borderLeftColor='transparent';">
                                {{ $subItem['label'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <a href="{{ $item['url'] }}" class="nav-menu-item w-full"
                        style="color: white; font-size: 13px; font-weight: 800; text-transform: uppercase; padding: 14px 10px; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; letter-spacing: 0.6px;"
                        onmouseenter="this.style.backgroundColor='rgba(0,0,0,0.2)';"
                        onmouseleave="this.style.backgroundColor='transparent';">
                        {{ $item['label'] }}
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden absolute top-full left-0 w-full bg-white shadow-2xl border-t border-gray-100 py-6 px-4 z-50 max-h-[85vh] overflow-y-auto">
        <div class="flex flex-col gap-1">
            <a href="{{ route('home') }}"
                class="px-5 py-4 text-lg font-extrabold text-gray-900 hover:bg-orange-50 rounded-2xl transition-colors">Home</a>

            @foreach($navigationItems as $itemKey => $item)
            @if($item['hasDropdown'])
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-4 text-lg font-extrabold text-gray-900 hover:bg-orange-50 rounded-2xl transition-colors">
                    {{ $item['label'] }}
                    <svg class="w-5 h-5 transition-transform" :class="open && 'rotate-180'" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="bg-orange-500 rounded-2xl mx-2 my-1 overflow-hidden border border-orange-600">
                    @foreach($item['items'] as $subItem)
                    <a href="{{ $subItem['url'] }}"
                        class="block px-8 py-3.5 text-white font-bold hover:bg-orange-600 transition-all">{{
                        $subItem['label'] }}</a>
                    @endforeach
                </div>
            </div>
            @else
            <a href="{{ $item['url'] }}"
                class="px-5 py-4 text-lg font-extrabold text-gray-900 hover:bg-orange-50 rounded-2xl transition-colors">{{
                $item['label'] }}</a>
            @endif
            @endforeach

            <hr class="my-6 border-gray-100">

            <div class="flex flex-col gap-4 px-4 pb-4">
                @auth
                @php
                $dashboardUrl = route('dashboard');
                if (auth()->user()->role === 'faculty') $dashboardUrl = route('faculty.dashboard');
                elseif (auth()->user()->role === 'student') $dashboardUrl = route('student.dashboard');
                elseif (auth()->user()->role === 'superadmin') $dashboardUrl = route('superadmin.dashboard');
                @endphp
                <a href="{{ $dashboardUrl }}"
                    class="w-full py-4 bg-[#f05a22] text-white text-center font-black rounded-2xl shadow-md">DASHBOARD</a>
                @else
                <a href="{{ route('login') }}"
                    class="w-full py-4 border-2 border-gray-200 text-gray-800 text-center font-black rounded-2xl">SIGN
                    IN</a>
                <a href="{{ route('register') }}"
                    class="w-full py-4 bg-[#1a1a1a] text-white text-center font-black rounded-2xl shadow-lg">JOIN
                    NOW</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    function navigationMenu() {
        return {
            mobileOpen: false,
            isScrolled: false,
            activeDropdown: null,
            scrollListener: null,

            initScrollListener() {
                this.scrollListener = () => {
                    this.isScrolled = window.scrollY > 30;
                };
                window.addEventListener('scroll', this.scrollListener, { passive: true });
            },

            openDropdown(name) {
                this.activeDropdown = name;
            },

            closeDropdown() {
                this.activeDropdown = null;
            }
        };
    }
</script>