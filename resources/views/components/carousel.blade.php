<!-- Reusable Carousel Component -->
<div x-data="carousel({{ json_encode($items) }})" class="relative {{ $containerClass ?? 'w-full' }}">
    <!-- Carousel Container -->
    <div class="relative overflow-hidden rounded-xl shadow-lg">
        <!-- Items -->
        <div class="relative h-96 md:h-[500px] lg:h-[600px]">
            <template x-for="(item, index) in items" :key="index">
                <div x-show="currentIndex === index" x-transition:enter="transition duration-300 ease-in-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300 ease-in-out" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0">

                    <!-- Background Image -->
                    <img :src="item.image" :alt="item.title"
                        class="w-full h-full object-cover">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- Content -->
                    <div class="absolute inset-0 flex items-end p-6 md:p-12">
                        <div class="text-white max-w-2xl animate-fade-in-up">
                            <span x-show="item.badge"
                                class="inline-block px-3 py-1 bg-yellow-300 text-maroon-900 rounded-full text-sm font-semibold mb-4">
                                <span x-text="item.badge"></span>
                            </span>
                            <h3 x-text="item.title" class="text-4xl md:text-5xl font-bold mb-4"></h3>
                            <p x-text="item.description" class="text-lg md:text-xl text-gray-100 mb-6 line-clamp-3"></p>
                            <a :href="item.link"
                                class="inline-block px-6 py-3 bg-yellow-300 text-maroon-900 rounded-lg hover:bg-yellow-400 transition-all transform hover:scale-105 font-semibold">
                                Learn More →
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Navigation Buttons -->
        <button @click="prev()"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/80 hover:bg-white rounded-full flex items-center justify-center transition-all transform hover:scale-110 shadow-lg">
            <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button @click="next()"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white/80 hover:bg-white rounded-full flex items-center justify-center transition-all transform hover:scale-110 shadow-lg">
            <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Indicators (Dots) -->
    <div class="flex justify-center gap-2 mt-6">
        <template x-for="(item, index) in items" :key="index">
            <button @click="currentIndex = index"
                :class="currentIndex === index ? 'bg-maroon-500 w-8' : 'bg-gray-300 w-3 hover:bg-gray-400'"
                class="h-3 rounded-full transition-all duration-300">
            </button>
        </template>
    </div>
</div>

<script>
    function carousel(items) {
        return {
            items: items,
            currentIndex: 0,
            autoplayInterval: null,

            init() {
                this.startAutoplay();
            },

            next() {
                this.currentIndex = (this.currentIndex + 1) % this.items.length;
                this.resetAutoplay();
            },

            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                this.resetAutoplay();
            },

            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.next();
                }, 5000); // Change slide every 5 seconds
            },

            resetAutoplay() {
                clearInterval(this.autoplayInterval);
                this.startAutoplay();
            },

            destroy() {
                clearInterval(this.autoplayInterval);
            }
        };
    }
</script>
