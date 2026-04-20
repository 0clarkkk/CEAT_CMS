@extends('layouts.public')

@php
    use Illuminate\Support\Str;
@endphp

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
    <section x-data="{ 
        currentSlide: 0, 
        intervalId: null,
        init() { 
            this.startAutoplay();
        },
        startAutoplay() {
            if (this.intervalId) clearInterval(this.intervalId);
            this.intervalId = setInterval(() => { 
                this.currentSlide = (this.currentSlide + 1) % {{ count($latestNews) > 0 ? count($latestNews) : 1 }} 
            }, 3000); 
        },
        goToSlide(index) {
            this.currentSlide = index;
            this.startAutoplay();
        }
    }" x-init="init()" class="relative bg-gray-100 pt-24 pb-0 w-full">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-2xl overflow-hidden bg-gray-900 shadow-xl" style="will-change: opacity; height: 500px;" :style="{ height: window.innerWidth >= 1024 ? '700px' : window.innerWidth >= 640 ? '600px' : '500px' }">
                <!-- News Carousel Slides -->
                @forelse($latestNews as $index => $news)
                    <div x-show="currentSlide === {{ $index }}" class="absolute inset-0 w-full h-full bg-gray-900 flex items-center justify-center" style="position: relative; will-change: opacity;">
                        @if($news->getFeaturedImageUrl())
                            <!-- Blurred background image - scaled to avoid empty edges -->
                            <img src="{{ $news->getFeaturedImageUrl() }}" alt="" class="absolute inset-0 w-full h-full object-cover" style="filter: blur(25px) brightness(0.6); z-index: 0; transform: scale(1.15);">
                            <!-- Clear image with contain and padding -->
                            <img src="{{ $news->getFeaturedImageUrl() }}" alt="{{ $news->title }}" style="z-index: 10; position: relative; object-fit: contain; padding: 0.5rem; max-width: 100%; max-height: 100%; width: auto; height: auto;">
                        @else
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center z-0">
                                <div class="text-center text-white">
                                    <div class="text-6xl mb-4">◈</div>
                                    <p class="text-xl font-semibold">{{ $news->title }}</p>
                                </div>
                            </div>
                        @endif
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent" style="z-index: 20;"></div>
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
                    <button type="button" @click="goToSlide((currentSlide - 1 + {{ count($latestNews) }}) % {{ count($latestNews) }})" class="absolute left-4 top-1/2 -translate-y-1/2 z-50 bg-white/20 text-white p-3 rounded-lg transition-all duration-300 hover:scale-110" style="cursor: pointer;" @mouseenter="$el.style.backgroundColor='rgb(147, 51, 54)'" @mouseleave="$el.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" @click="goToSlide((currentSlide + 1) % {{ count($latestNews) }})" class="absolute right-4 top-1/2 -translate-y-1/2 z-50 bg-white/20 text-white p-3 rounded-lg transition-all duration-300 hover:scale-110" style="cursor: pointer;" @mouseenter="$el.style.backgroundColor='rgb(147, 51, 54)'" @mouseleave="$el.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-50 flex gap-2">
                        @for($i = 0; $i < count($latestNews); $i++)
                            <button type="button" @click="goToSlide({{ $i }})" :class="currentSlide === {{ $i }} ? 'bg-primary-500' : 'bg-white/50'" class="w-3 h-3 rounded-full transition-colors"></button>
                        @endfor
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6">
                    Latest News & Events
                </h2>
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
                                    <div class="h-80 overflow-hidden relative bg-gray-900 flex items-center justify-center">
                                        <!-- Blurred background image - scaled to avoid empty edges -->
                                        <img src="{{ $featured->getFeaturedImageUrl() }}" alt="" class="absolute inset-0 w-full h-full object-cover" style="filter: blur(25px) brightness(0.6); z-index: 0; transform: scale(1.15);">
                                        <!-- Clear image with contain and padding -->
                                        <img src="{{ $featured->getFeaturedImageUrl() }}" alt="{{ $featured->title }}" style="z-index: 10; position: relative; object-fit: contain; padding: 0.5rem; max-width: 100%; max-height: 100%; width: auto; height: auto; transition: transform 0.5s ease;" class="group-hover:scale-105">
                                    </div>
                                @else
                                    <div class="h-80 bg-gradient-to-br from-maroon-600 to-maroon-800 flex items-center justify-center">
                                        <div class="text-6xl text-white/30">◈</div>
                                    </div>
                                @endif
                                <div class="p-8 flex flex-col flex-grow">
                                    <div class="text-gray-600 text-base font-semibold mb-2">
                                        {{ $featured->published_at?->format('F d, Y') }}
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3 hover:text-maroon-700 transition-colors line-clamp-3">{{ $featured->title }}</h3>
                                    <p class="text-gray-600 text-base line-clamp-4 flex-grow">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) }}</p>
                                    <div class="pt-4 mt-4 border-t border-gray-100">
                                        <span class="inline-flex items-center text-gray-500 font-semibold text-sm hover:text-maroon-600 transition-colors cursor-pointer">
                                            READ MORE
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- News List (Right - Vertical Cards) -->
                    <div class="space-y-4">
                        @foreach($newsCards->skip(1)->take(3) as $news)
                            <a href="{{ route('view.news.show', $news) }}" class="group block">
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 p-4 hover:border-maroon-200" style="border-top: 4px solid #933336; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                    <div class="text-gray-600 text-base font-semibold mb-2">
                                        {{ $news->published_at?->format('F d, Y') }}
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-900 mb-2 hover:text-maroon-700 transition-colors line-clamp-2">{{ $news->title }}</h4>
                                    <span class="inline-flex items-center text-gray-500 font-semibold text-xs hover:text-maroon-600 transition-colors cursor-pointer">
                                        READ MORE
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
                <a href="{{ route('view.news') }}" class="inline-flex items-center px-8 py-3 font-bold rounded-xl transition-all duration-300" style="background-color: transparent; border: 2px solid #000000; color: #000000; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#933336'; this.style.borderColor='#933336'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#000000'; this.style.color='#000000';">
                    View All News
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Research Section -->
    <section class="py-24 bg-maroon-700 relative overflow-hidden">
        <!-- Subtle aesthetic blur accents -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ 
            currentGalleryImage: 0,
            featuredItems: @json($allFeaturedResearch),
            debug: true
        }" x-cloak>
            <!-- DEBUG: Show data structure -->
            <div style="background: #1f2937; color: #10b981; padding: 20px; border-radius: 8px; margin-bottom: 20px; font-size: 12px; margin-top: 20px; border: 1px solid #059669;" x-show="debug">
                <button @click="debug = !debug" style="background: #059669; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 10px;">Toggle Debug</button>
                <pre x-text="'Items count: ' + featuredItems.length + '\nFirst item: ' + JSON.stringify(featuredItems[0], null, 2)"></pre>
            </div>
            @if($allFeaturedResearch->isNotEmpty())
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
                        Featured Research
                    </h2>
                    <p class="text-lg sm:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed backdrop-blur-sm">
                        <template x-if="featuredItems[currentGalleryImage]">
                            <span x-text="(featuredItems[currentGalleryImage].featured_description || featuredItems[currentGalleryImage].description || '').substring(0, 300)"></span>
                        </template>
                        <template x-if="!featuredItems[currentGalleryImage]">
                            @if($featuredResearch->featured_description)
                                {{ Str::limit($featuredResearch->featured_description, 300) }}
                            @else
                                {{ Str::limit(html_entity_decode(strip_tags($featuredResearch->description)), 300) }}
                            @endif
                        </template>
                    </p>
                </div>

                <!-- Featured Research Card - Modern Design -->
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                    <!-- Image Section with Float Effect -->
                    <div class="relative group flex flex-col gap-6">
                        <!-- Decorative Float Border (Behind) -->
                        <div class="absolute -top-4 -left-4 w-32 h-32 border-2 border-white/10 rounded-3xl hidden lg:block"></div>
                        
                        <!-- Main Image -->
                        <div class="w-full">
                            <div class="relative h-96 sm:h-[500px] rounded-3xl overflow-hidden shadow-2xl">
                                <!-- Dynamic Main Image -->
                                <img id="mainFeatureImage" 
                                     src="@if($featuredResearch?->thumbnail_photo)/storage/{{ $featuredResearch->thumbnail_photo }}@elseif($featuredResearch?->featured_image)/storage/{{ $featuredResearch->featured_image }}@endif"
                                     alt="Featured Research"
                                     class="w-full h-full object-cover transition-transform duration-700"
                                     onerror="this.style.display='none'; document.getElementById('mainFeatureGradient').style.display='flex'">
                                
                                <!-- Fallback Gradient -->
                                <div id="mainFeatureGradient" class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary-500 to-maroon-600 flex items-center justify-center relative" @if($featuredResearch?->thumbnail_photo || $featuredResearch?->featured_image)style="display: none;" @endif>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    <div class="text-center relative z-10">
                                        <div class="text-7xl mb-4 animate-bounce">⚗️</div>
                                        <p class="text-white/80 font-medium text-lg" id="fallbackText">{{ $featuredResearch?->name ?? 'Research Initiative' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery Thumbnails - Always show 5 slots -->
                            @if($allFeaturedResearch->isNotEmpty())
                                <div class="flex gap-2 mt-4 w-full" id="galleryThumbnails">
                                    @foreach($allFeaturedResearch as $index => $research)
                                        <button data-index="{{ $index }}" 
                                                @click="currentGalleryImage = {{ $index }}; updateToResearch({{ $index }})" 
                                                class="flex-1 aspect-square rounded-lg overflow-hidden border-2 transition-colors duration-300 min-w-0"
                                                style="border-color: {{ $index === 0 ? '#FCD34D' : 'rgba(255, 255, 255, 0.3)' }}">
                                            @if($research->thumbnail_photo)
                                                <img src="/storage/{{ $research->thumbnail_photo }}" 
                                                     alt="Gallery {{ $index + 1 }}" 
                                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                            @elseif($research->featured_image)
                                                <img src="/storage/{{ $research->featured_image }}" 
                                                     alt="Gallery {{ $index + 1 }}" 
                                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full bg-white/5 flex items-center justify-center">
                                                    <span class="text-white/50 text-xs font-semibold">{{ $index + 1 }}</span>
                                                </div>
                                            @endif
                                        </button>
                                    @endforeach
                                    <!-- Empty placeholder slots up to 5 -->
                                    @for($i = $allFeaturedResearch->count(); $i < 5; $i++)
                                        <div class="flex-1 aspect-square rounded-lg border-2 border-white/20 min-w-0 bg-white/5">
                                        </div>
                                    @endfor
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Content Section with Modern Styling -->
                    <div class="flex flex-col justify-center space-y-6">
                        <!-- Department Tag -->
                        <div class="inline-flex items-center gap-3 w-fit">
                            <div class="w-3 h-3 bg-gradient-to-r from-primary-400 to-primary-500 rounded-full"></div>
                            <span class="text-sm font-bold text-primary-300 uppercase tracking-widest" 
                                  id="featureDept">
                                @if($featuredResearch?->department)
                                    {{ $featuredResearch->department->name }}
                                @else
                                    Department
                                @endif
                            </span>
                            <div class="flex-grow flex gap-1">
                                <div class="w-1 h-1 bg-primary-400 rounded-full"></div>
                                <div class="w-1 h-1 bg-primary-400 rounded-full opacity-50"></div>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight" id="featureTitle">
                            @if($featuredResearch)
                                {{ $featuredResearch->name }}
                            @else
                                Featured Research
                            @endif
                        </h3>

                        <!-- Description -->
                        <p class="text-base sm:text-lg text-white/80 leading-relaxed" id="featureDesc">
                            @if($featuredResearch)
                                @if($featuredResearch->featured_description)
                                    {{ Str::limit(Str::squish($featuredResearch->featured_description), 300) }}
                                @else
                                    {{ Str::limit(Str::squish(html_entity_decode(strip_tags($featuredResearch->description))), 300) }}
                                @endif
                            @else
                                Research description
                            @endif
                        </p>

                        <!-- Modern Info Cards -->
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 hover:border-primary-400/50 transition-all duration-300">
                                <div class="text-xs font-bold text-primary-300 mb-2 uppercase tracking-wider" id="researcherLabel">{{ $featuredResearch?->researchers->count() === 1 ? 'Researcher' : 'Researchers' }}</div>
                                <p class="text-sm text-white font-semibold" id="featureResearchers" style="word-break: break-word; white-space: normal; line-height: 1.5;">
                                    @if($featuredResearch?->researchers->isNotEmpty())
                                        @foreach($featuredResearch->researchers as $index => $researcher)
                                            @if($index > 0)<br>@endif{{ $researcher->name }}
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 hover:border-primary-400/50 transition-all duration-300">
                                <div class="text-xs font-bold text-primary-300 mb-2 uppercase tracking-wider">Email</div>
                                <p class="text-sm text-white font-semibold truncate" id="featureEmail">
                                    {{ $featuredResearch?->contact_email ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <!-- CTA Buttons - Modern Design -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            <a href="javascript:void(0)" onclick="exploreResearch(currentGalleryIndex)" class="px-8 py-4 bg-gradient-to-r from-maroon-600 to-maroon-700 text-primary-400 font-bold rounded-xl hover:shadow-2xl hover:shadow-maroon-600/40 hover:scale-105 transition-all duration-300 text-center border border-maroon-500/50 group relative overflow-hidden cursor-pointer">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Explore Research
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('view.research.all') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl hover:bg-white/20 hover:scale-105 transition-all duration-300 border border-white/30 hover:border-white/50 text-center">
                                View All Research
                            </a>
                        </div>

                        <!-- Accent Line -->
                        <div class="h-1 w-16 bg-gradient-to-r from-primary-500 to-transparent rounded-full mt-4"></div>
                    </div>
                </div>
            @else
                <!-- Empty State - Modern Design -->
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 text-4xl border border-white/20">⚗️</div>
                    <p class="text-white/70 text-xl font-semibold">No featured research center yet. Stay tuned!</p>
                </div>
            @endif
        </div>
    </section>

    <script>
        // Store featured research items in global scope
        const featuredResearchData = @json($allFeaturedResearch);
        let currentGalleryIndex = 0;
        
        // Function to clean text thoroughly
        function cleanText(text) {
            if (!text) return '';
            return text
                // Decode HTML entities
                .replace(/&nbsp;/g, ' ')
                .replace(/&quot;/g, '"')
                .replace(/&#39;/g, "'")
                .replace(/&amp;/g, '&')
                .replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>')
                // Remove multiple spaces
                .replace(/\s+/g, ' ')
                // Trim
                .trim();
        }
        
        // Function to get the main image source
        function getMainImageSrc() {
            if (!featuredResearchData || !featuredResearchData[currentGalleryIndex]) {
                return '';
            }
            const item = featuredResearchData[currentGalleryIndex];
            // Use thumbnail_photo first, fallback to featured_image
            return item.thumbnail_photo ? `/storage/${item.thumbnail_photo}` : (item.featured_image ? `/storage/${item.featured_image}` : '');
        }
        
        // Function to update featured research content when thumbnail is clicked
        function updateToResearch(index) {
            // Update thumbnail borders
            const thumbnails = document.querySelectorAll('#galleryThumbnails button');
            thumbnails.forEach((btn, idx) => {
                btn.style.borderColor = idx === index ? '#FCD34D' : 'rgba(255, 255, 255, 0.3)';
            });
            
            // Update Alpine component's currentGalleryImage
            const alpineEl = document.querySelector('[x-data*="currentGalleryImage"]');
            if (alpineEl && alpineEl.__x) {
                alpineEl.__x.$data.currentGalleryImage = index;
            }
            
            currentGalleryIndex = index;
            
            if (!featuredResearchData || !featuredResearchData[index]) return;
            
            const item = featuredResearchData[index];
            
            // Update main image (use thumbnail_photo first, fallback to featured_image)
            const mainImg = document.getElementById('mainFeatureImage');
            const gradient = document.getElementById('mainFeatureGradient');
            const fallbackText = document.getElementById('fallbackText');
            const imageUrl = item.thumbnail_photo ? `/storage/${item.thumbnail_photo}` : (item.featured_image ? `/storage/${item.featured_image}` : '');
            
            if (mainImg && imageUrl) {
                mainImg.src = imageUrl;
                mainImg.style.display = 'block';
                if (gradient) gradient.style.display = 'none';
            } else {
                if (mainImg) mainImg.style.display = 'none';
                if (gradient) gradient.style.display = 'flex';
                if (fallbackText) fallbackText.textContent = cleanText(item.name || 'Research Initiative');
            }
            
            // Update content fields with cleaned text
            const deptEl = document.getElementById('featureDept');
            const titleEl = document.getElementById('featureTitle');
            const descEl = document.getElementById('featureDesc');
            const emailEl = document.getElementById('featureEmail');
            
            if (deptEl) deptEl.textContent = cleanText(item.department?.name || 'Department');
            if (titleEl) titleEl.textContent = cleanText(item.name || 'Featured Research');
            
            // Use the pre-cleaned description from the model accessor
            const desc = item.clean_featured_description || item.clean_description || 'Research description';
            const cleanedDesc = desc.substring(0, 300);
            if (descEl) descEl.textContent = cleanedDesc;
            
            // Update researchers list
            const researchersEl = document.getElementById('featureResearchers');
            const researcherLabel = document.getElementById('researcherLabel');
            if (researchersEl) {
                const researchers = item.researchers || [];
                if (researchers.length > 0) {
                    const researcherNames = researchers.map(r => cleanText(r.name || '')).filter(n => n);
                    researchersEl.innerHTML = researcherNames.join('<br>');
                    // Update label based on count
                    if (researcherLabel) {
                        researcherLabel.textContent = researcherNames.length === 1 ? 'RESEARCHER' : 'RESEARCHERS';
                    }
                } else {
                    researchersEl.textContent = 'N/A';
                    if (researcherLabel) {
                        researcherLabel.textContent = 'RESEARCHERS';
                    }
                }
            }
            
            const emailEl2 = document.getElementById('featureEmail');
            if (emailEl2) emailEl2.textContent = cleanText(item.contact_email || 'N/A');
        }
        
        // Function to navigate to research detail page
        function exploreResearch(index) {
            if (!featuredResearchData || !featuredResearchData[index]) return;
            const slug = featuredResearchData[index].slug;
            if (slug) {
                window.location.href = `/research/${slug}`;
            }
        }

        // Initialize with first item on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (featuredResearchData && featuredResearchData.length > 0) {
                updateToResearch(0);
            }
        });
    </script>

    <!-- Accreditations Section -->
    <section class="py-20 sm:py-28 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16 sm:mb-20">
                <p class="text-sm font-bold text-maroon-600 uppercase tracking-wider mb-3">Quality Assurance</p>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4 leading-tight">
                    Accreditations
                </h2>
                <div class="w-16 h-1 bg-gradient-to-r from-maroon-600 to-primary-500 rounded-full mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Our programs are recognized and accredited by prestigious international and national bodies, ensuring excellence in engineering education and professional standards.
                </p>
            </div>

            <!-- Accreditation Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- ABET Accreditation -->
                <div class="group bg-white rounded-2xl border border-gray-200 p-8 hover:border-maroon-300 hover:shadow-xl transition-all duration-300 text-center">
                    <!-- Logo Placeholder -->
                    <div class="w-20 h-20 bg-gradient-to-br from-maroon-100 to-maroon-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:from-maroon-200 group-hover:to-maroon-100 transition-all duration-300 overflow-hidden">
                        <img src="" alt="ABET Logo" class="w-full h-full object-contain p-2" style="display: none;">
                        <span class="text-maroon-400 text-2xl font-bold">ABET</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">ABET</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Accreditation Board for Engineering and Technology</p>
                </div>

                <!-- PECE Accreditation -->
                <div class="group bg-white rounded-2xl border border-gray-200 p-8 hover:border-maroon-300 hover:shadow-xl transition-all duration-300 text-center">
                    <!-- Logo Placeholder -->
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:from-primary-200 group-hover:to-primary-100 transition-all duration-300 overflow-hidden">
                        <img src="" alt="PEC Logo" class="w-full h-full object-contain p-2" style="display: none;">
                        <span class="text-primary-400 text-2xl font-bold">PEC</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">PEC</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Professional Engineers Council of Philippines</p>
                </div>

                <!-- ISO Certification -->
                <div class="group bg-white rounded-2xl border border-gray-200 p-8 hover:border-maroon-300 hover:shadow-xl transition-all duration-300 text-center">
                    <!-- Logo Placeholder -->
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:from-blue-200 group-hover:to-blue-100 transition-all duration-300 overflow-hidden">
                        <img src="" alt="ISO Logo" class="w-full h-full object-contain p-2" style="display: none;">
                        <span class="text-blue-400 text-xl font-bold">ISO 9001</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">ISO 9001</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Quality Management System Certified</p>
                </div>

                <!-- AACSB Recognition -->
                <div class="group bg-white rounded-2xl border border-gray-200 p-8 hover:border-maroon-300 hover:shadow-xl transition-all duration-300 text-center">
                    <!-- Logo Placeholder -->
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:from-purple-200 group-hover:to-purple-100 transition-all duration-300 overflow-hidden">
                        <img src="" alt="AACSB Logo" class="w-full h-full object-contain p-2" style="display: none;">
                        <span class="text-purple-400 text-xl font-bold">AACSB</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">AACSB</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Association to Advance Collegiate Schools</p>
                </div>
            </div>

            <!-- Achievement Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 mt-16 sm:mt-20 pt-16 sm:pt-20 border-t border-gray-200">
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-black text-maroon-600 mb-2">15+</div>
                    <p class="text-sm text-gray-600 font-medium">Years Excellence</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-black text-primary-600 mb-2">95%</div>
                    <p class="text-sm text-gray-600 font-medium">Graduate Rate</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-black text-blue-600 mb-2">5000+</div>
                    <p class="text-sm text-gray-600 font-medium">Alumni Network</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-black text-purple-600 mb-2">8</div>
                    <p class="text-sm text-gray-600 font-medium">Program Degrees</p>
                </div>
            </div>
        </div>
    </section>

@endsection
