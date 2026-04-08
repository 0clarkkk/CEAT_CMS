<!-- Multi-level Navigation Component -->
<nav x-data="navigationMenu()" 
     x-init="initScrollListener()"
     class="fixed top-0 w-full z-50 transition-all duration-300"
     :style="`${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.95) 0%, rgba(127, 20, 22, 0.85) 100%); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25); border-bottom: 1px solid rgba(255, 255, 255, 0.1);' : 'background: rgba(255, 255, 255, 0.98); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(127, 20, 22, 0.1);'}; backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);`">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4 lg:py-0 lg:h-24">
            
            <!-- Logo Section -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0 z-10">
                <img src="{{ asset('images/coe-logo.png') }}" alt="CEAT Logo" class="h-16 w-auto group-hover:scale-110 transition-transform duration-300">
                <div class="hidden sm:block">
                    <h1 :style="`color: ${isScrolled ? 'white' : '#7f1416'};`" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">COLLEGE OF ENGINEERING,</h1>
                    <h1 :style="`color: ${isScrolled ? 'white' : '#7f1416'};`" class="font-bold text-sm lg:text-base tracking-tight leading-tight transition-colors duration-300">ARCHITECTURE & TECHNOLOGY</h1>
                </div>
            </a>

            <!-- Desktop Menu with Dropdowns -->
            <div class="hidden lg:flex items-center gap-0 flex-1 justify-center">
                @foreach($navigationItems as $itemKey => $item)
                    @if($item['hasDropdown'])
                        <!-- Dropdown Menu Item -->
                        <div @mouseenter="openDropdown('{{ $itemKey }}')" 
                             @mouseleave="closeDropdown()" 
                             class="relative">
                            <button class="nav-link flex items-center gap-2 px-4 py-6 font-medium text-sm transition-all duration-300 rounded-none hover:no-underline"
                                    :style="`color: ${isScrolled ? 'white' : '#7f1416'}; background-color: ${activeDropdown === '{{ $itemKey }}' ? (isScrolled ? 'rgba(255, 255, 255, 0.15)' : 'rgba(127, 20, 22, 0.05)') : 'transparent'};`"
                                    @click.prevent>
                                <span>{{ $item['label'] }}</span>
                                <svg class="w-4 h-4 transition-transform duration-300" 
                                     :class="activeDropdown === '{{ $itemKey }}' ? 'rotate-180' : ''" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Content -->
                            <div x-show="activeDropdown === '{{ $itemKey }}' && !isScrolling" 
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-2"
                                 @click.away="closeDropdown()"
                                 class="absolute left-0 top-full mt-0 w-56 shadow-2xl overflow-hidden z-50 dropdown-content"
                                 :style="`${isScrolled ? 'background: linear-gradient(135deg, rgba(127, 20, 22, 0.98) 0%, rgba(127, 20, 22, 0.95) 100%);' : 'background: white; border: 1px solid rgba(127, 20, 22, 0.1);'}; ${(activeDropdown === '{{ $itemKey }}' && !isScrolling) ? 'visibility: visible; opacity: 1;' : 'visibility: hidden; opacity: 0;'}`">
                                
                                @foreach($item['items'] as $subItem)
                                    <a href="{{ $subItem['url'] }}" 
                                       class="dropdown-link block px-6 py-3 text-sm font-medium transition-all duration-200 border-l-4 border-transparent"
                                       :style="`color: ${isScrolled ? 'white' : '#7f1416'}; background-color: ${isScrolled ? 'rgba(255, 255, 255, 0.05)' : 'transparent'};`"
                                       @mouseenter="`this.style.borderLeftColor = '#ffc700'; this.style.backgroundColor = '${isScrolled ? 'rgba(255, 199, 0, 0.2)' : 'rgba(127, 20, 22, 0.05)'}';`"
                                       @mouseleave="`this.style.borderLeftColor = 'transparent'; this.style.backgroundColor = '${isScrolled ? 'rgba(255, 255, 255, 0.05)' : 'transparent'}';`">
                                        {{ $subItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Single Link -->
                        <a href="{{ $item['url'] }}" 
                           class="nav-link px-4 py-6 font-medium text-sm transition-all duration-300 rounded-none"
                           :style="`color: ${isScrolled ? 'white' : '#7f1416'}; background-color: transparent;`">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Auth Buttons (right side) -->
            <div class="hidden lg:flex items-center gap-3 ml-auto">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary px-5 py-2 font-bold text-sm rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105" style="background-color: #ffc700; color: #7f1416;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300"
                       :style="`color: ${isScrolled ? 'white' : '#7f1416'};`">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-primary px-5 py-2 font-bold text-sm rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105" style="background-color: #ffc700; color: #7f1416;">Register</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg transition-colors duration-300 z-10"
                    :style="`color: ${isScrolled ? 'white' : '#7f1416'};`">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu with Collapsible Dropdowns -->
        <div x-show="mobileOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden w-full pb-4 overflow-y-auto max-h-96"
             :style="`border-top: 1px solid ${isScrolled ? 'rgba(255, 255, 255, 0.1)' : 'rgba(127, 20, 22, 0.1)'}; color: ${isScrolled ? 'white' : '#7f1416'};`">
            
            @foreach($navigationItems as $itemKey => $item)
                @if($item['hasDropdown'])
                    <!-- Mobile Dropdown -->
                    <div>
                        <button @click="toggleMobileDropdown('{{ $itemKey }}')" 
                                class="w-full text-left flex items-center justify-between py-3 px-4 border-b font-medium text-sm transition-colors duration-200"
                                :style="`border-color: ${isScrolled ? 'rgba(255, 255, 255, 0.1)' : 'rgba(127, 20, 22, 0.1)'}; background-color: ${openMobileDropdowns['{{ $itemKey }}'] ? (isScrolled ? 'rgba(255, 255, 255, 0.05)' : 'rgba(127, 20, 22, 0.05)') : 'transparent'};`">
                            <span>{{ $item['label'] }}</span>
                            <svg class="w-4 h-4 transition-transform duration-300" 
                                 :class="openMobileDropdowns['{{ $itemKey }}'] ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                        
                        <!-- Mobile Dropdown Items -->
                        <div x-show="openMobileDropdowns['{{ $itemKey }}']" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            @foreach($item['items'] as $subItem)
                                <a href="{{ $subItem['url'] }}" 
                                   class="dropdown-mobile-link block py-3 px-8 text-sm font-medium border-l-4 border-yellow-400 transition-all duration-200"
                                   :style="`background-color: ${isScrolled ? 'rgba(255, 255, 255, 0.03)' : 'rgba(127, 20, 22, 0.02)'};`">
                                    {{ $subItem['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Mobile Single Link -->
                    <a href="{{ $item['url'] }}" 
                       class="mobile-link block py-3 px-4 text-sm font-medium border-b transition-all duration-200"
                       :style="`border-color: ${isScrolled ? 'rgba(255, 255, 255, 0.1)' : 'rgba(127, 20, 22, 0.1)'}; background-color: transparent;`">
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach

            <!-- Mobile Auth Section -->
            <div class="flex flex-col gap-3 pt-4 px-4"
                 :style="`border-top: 1px solid ${isScrolled ? 'rgba(255, 255, 255, 0.1)' : 'rgba(127, 20, 22, 0.1)'};`">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2 font-bold text-sm text-center rounded-lg transition-all duration-300" style="background-color: #ffc700; color: #7f1416;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary px-4 py-2 font-semibold text-sm text-center rounded-lg transition-all duration-300"
                       :style="`color: ${isScrolled ? 'white' : '#7f1416'}; border: 1px solid currentColor;`">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-primary px-4 py-2 font-bold text-sm text-center rounded-lg transition-all duration-300" style="background-color: #ffc700; color: #7f1416;">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Alpine.js Navigation Controller -->
<script>
function navigationMenu() {
    return {
        mobileOpen: false,
        isScrolled: false,
        activeDropdown: null,
        openMobileDropdowns: {},
        lastScrollY: 0,
        isScrolling: false,
        scrollTimeout: null,
        scrollListener: null,
        
        initScrollListener() {
            // Remove any existing listener
            if (this.scrollListener) {
                window.removeEventListener('scroll', this.scrollListener);
            }
            
            // Create new scroll listener with proper context
            this.scrollListener = () => {
                const scrollY = window.scrollY;
                
                // Update scroll state for background color (only if threshold crossed)
                const wasScrolled = this.isScrolled;
                const nowScrolled = scrollY > 100;
                if (wasScrolled !== nowScrolled) {
                    this.isScrolled = nowScrolled;
                }
                
                // Mark as scrolling
                this.isScrolling = true;
                
                // CRITICAL: Close dropdown on any scroll movement
                if (scrollY !== this.lastScrollY) {
                    this.activeDropdown = null;
                }
                
                this.lastScrollY = scrollY;
                
                // Reset scrolling flag after scroll ends
                clearTimeout(this.scrollTimeout);
                this.scrollTimeout = setTimeout(() => {
                    this.isScrolling = false;
                }, 300);
            };
            
            // Attach listener with passive flag for better performance
            window.addEventListener('scroll', this.scrollListener, { passive: true });
        },
        
        openDropdown(name) {
            // Don't open dropdown while scrolling
            if (!this.isScrolling) {
                this.activeDropdown = name;
            }
        },
        
        closeDropdown() {
            this.activeDropdown = null;
        },
        
        toggleMobileDropdown(name) {
            this.$nextTick(() => {
                this.openMobileDropdowns[name] = !this.openMobileDropdowns[name];
            });
        },
        
        destroy() {
            if (this.scrollListener) {
                window.removeEventListener('scroll', this.scrollListener);
            }
            clearTimeout(this.scrollTimeout);
        }
    };
}
</script>

<style>
/* Navigation Link Styles */
.nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.nav-link:hover {
    text-decoration: none;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ffc700, transparent);
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.nav-link:hover::after {
    width: 80%;
}

.dropdown-link {
    text-decoration: none;
    display: block;
    transition: all 0.2s ease;
}

.dropdown-link:hover {
    text-decoration: none;
    border-left-color: #ffc700 !important;
}

.mobile-link,
.dropdown-mobile-link {
    text-decoration: none;
    transition: all 0.2s ease;
}

.mobile-link:hover,
.dropdown-mobile-link:hover {
    text-decoration: none;
}

/* Button Styles */
.btn-primary {
    text-decoration: none;
    display: inline-block;
}

.btn-primary:hover {
    text-decoration: none;
}

.btn-secondary {
    text-decoration: none;
    display: inline-block;
}

.btn-secondary:hover {
    text-decoration: none;
}

/* Ensure no link underlines appear */
a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}
</style>

