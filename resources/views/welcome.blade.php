{{-- Landing Page
     The primary public entry point for CEAT.
     Features a hero carousel, recent news, featured research, and a CTA section.
     Themed with tangerine, white, and gray.
--}}
@extends('layouts.public')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    [x-cloak] { display: none !important; }
    
    .gradient-mesh {
        /* Tangerine tinted mesh background */
        background: linear-gradient(-45deg, rgba(255, 107, 0, 0.05), rgba(204, 82, 0, 0.05), rgba(255, 138, 51, 0.03));
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
        @apply absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-tangerine-400 to-tangerine-600 transition-all duration-500 group-hover:w-full;
        content: '';
    }
</style>

@section('content')

    <!-- Video Hero Section -->
    <section class="relative w-full bg-black" style="margin-top: 0; padding: 0;">
        <div style="position: relative; width: 100%; height: 700px; display: flex; align-items: center; justify-content: center;">
            <!-- Video Background -->
            <video 
                autoplay 
                muted 
                loop 
                playsinline
                controls
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;">
                <source src="{{ asset('videos/ceat-vid.mp4') }}" type="video/mp4">
                <p>Your browser doesn't support HTML5 video. Here is a <a href="{{ asset('videos/ceat-vid.mp4') }}">link to the video</a> instead.</p>
            </video>
            
            <!-- Overlay Gradient -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.3), transparent); z-index: 10;"></div>
            
            <!-- Content Overlay -->
            <div style="position: relative; z-index: 20; text-align: center; color: white;">
                <h1 style="font-size: 3.75rem; font-weight: 900; margin-bottom: 1rem;">Welcome to CEAT</h1>
                <p style="font-size: 1.5rem; color: rgba(255,255,255,0.9); margin: 0 auto; max-width: 42rem;">Center of Excellence in Advanced Technology</p>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        {{-- Decorative Blob --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-tangerine-500/5 rounded-full blur-3xl"></div>

        <!-- Dark background positioned left, extending 70% to right -->
        <div class="absolute left-0" style="background-color: rgba(0, 1, 4, 0.9); border-radius:0 30px 30px 0; width: 70%; height: 350px; top: 180px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Title - Centered Full Width -->
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900">
                    Recent News
                </h2>
            </div>
        </div>

        <!-- News Cards Section - Outside the centered container to align left -->
        <div class="relative z-10 pl-12 sm:pl-16 lg:pl-20 pt-8 pr-4 sm:pr-6 lg:pr-8"> 
            <div class="flex gap-8 items-start" style="width: 100%; max-width: none;">
                <!-- Recent News Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3" style="width: 75%; gap: 60px;">
                @if($newsCards->isNotEmpty())
                    @foreach($newsCards->take(3) as $index => $news)
                        <a href="{{ route('view.news.show', $news) }}" class="group block h-full">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 hover:border-tangerine-200 flex flex-col" style="border-right: 4px solid #FF6B00; border-top-left-radius: 12px; border-top-right-radius: 12px; height: 280px; width: 260px;">
                                <!-- Image Section -->
                                @if($news->getFeaturedImageUrl())
                                    <div class="h-24 overflow-hidden relative bg-gray-900 flex items-center justify-center">
                                        <img src="{{ $news->getFeaturedImageUrl() }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="h-24 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                        <div class="text-4xl text-white/30">◈</div>
                                    </div>
                                @endif
                                <!-- Content Section -->
                                <div class="p-4 flex-grow flex flex-col">
                                    <div class="text-gray-600 text-sm font-semibold mb-2">
                                        {{ $news->published_at?->format('F d, Y') }}
                                    </div>
                                    <h4 class="text-base font-bold text-gray-900 hover:text-tangerine-600 transition-colors line-clamp-2">{{ $news->title }}</h4>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center md:col-span-3">
                        <p class="text-gray-500 text-sm">Check back soon for latest updates</p>
                    </div>
                @endif
                </div>

                <!-- Archived News Section (Right Gap) -->
@if($archivedNews->isNotEmpty())
    <div style="width: 25%; flex-shrink: 0; margin-top: -50px;">
        
        <!-- Single Container -->
        <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden" style="border-top: 6px solid #FF6B00;">
            
            @foreach($archivedNews as $index => $news)
                <a href="{{ route('view.news.show', $news) }}" class="block group">
                    
                    <div class="p-6">
                        <!-- Date -->
                        <div class="text-orange-400 text-sm italic mb-3">
                            {{ $news->published_at?->format('F d, Y') }}
                        </div>

                        <!-- Title -->
                        <h5 class="text-base font-bold text-gray-900 leading-snug group-hover:text-orange-600 transition-colors">
                            {{ $news->title }}
                        </h5>

                        <!-- Read More -->
                        <div class="mt-3 text-orange-500 text-sm font-semibold tracking-wide">
                            READ MORE →
                        </div>
                    </div>

                    <!-- Divider (except last item) -->
                    @if(!$loop->last)
                        <div class="border-t border-gray-300 mx-6"></div>
                    @endif

                </a>
            @endforeach

        </div>
    </div>
@endif
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" style="margin-top: 1rem;">
                {{-- View All News CTA — swaps to tangerine when hovered --}}
                <a href="{{ route('view.news') }}" class="inline-flex items-center px-8 py-3 font-bold rounded-xl transition-all duration-300" style="background-color: transparent; border: 2px solid #000000; color: #000000; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#FF6B00'; this.style.borderColor='#FF6B00'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#000000'; this.style.color='#000000';">
                    View All News →
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Research Section -->
    <section class="py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 relative overflow-hidden">
        <!-- Modern Gradient Overlays -->
        <div class="absolute top-0 right-0 w-1/3 h-96 bg-gradient-to-b from-tangerine-500/20 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-1/3 h-96 bg-gradient-to-t from-white/10 to-transparent rounded-full blur-3xl"></div>
        
        <!-- Animated Grid Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ 
            currentGalleryImage: 0,
            featuredItems: @json($allFeaturedResearch),
            debug: true
        }" x-cloak>
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
                                {{ Str::limit(html_entity_decode(strip_tags($featuredResearch->featured_description)), 300) }}
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
                                     src=""
                                     alt="Featured Research"
                                     class="w-full h-full object-cover transition-transform duration-700"
                                     onerror="this.style.display='none'">
                                
                                <!-- Fallback Gradient -->
                                <div id="mainFeatureGradient" class="absolute inset-0 w-full h-full bg-gradient-to-br from-tangerine-500 to-gray-800 flex items-center justify-center relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    <div class="text-center relative z-10">
                                        <div class="text-7xl mb-4 animate-bounce">⚗️</div>
                                        <p class="text-white/80 font-medium text-lg" id="fallbackText">Research Initiative</p>
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
                                                style="border-color: {{ $index === 0 ? '#FF6B00' : 'rgba(255, 255, 255, 0.3)' }}">
                                            @if($research->featured_image)
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
                            <div class="w-3 h-3 bg-gradient-to-r from-tangerine-400 to-tangerine-500 rounded-full"></div>
                            <span class="text-sm font-bold text-tangerine-300 uppercase tracking-widest" 
                                  id="featureDept">
                                @if($featuredResearch?->department)
                                    {{ $featuredResearch->department->name }}
                                @else
                                    Department
                                @endif
                            </span>
                            <div class="flex-grow flex gap-1">
                                <div class="w-1 h-1 bg-tangerine-400 rounded-full"></div>
                                <div class="w-1 h-1 bg-tangerine-400 rounded-full opacity-50"></div>
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
                                    {{ Str::limit(Str::squish(html_entity_decode(strip_tags($featuredResearch->featured_description))), 300) }}
                                @else
                                    {{ Str::limit(Str::squish(html_entity_decode(strip_tags($featuredResearch->description))), 300) }}
                                @endif
                            @else
                                Research description
                            @endif
                        </p>

                        <!-- Modern Info Cards -->
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 hover:border-tangerine-400/50 transition-all duration-300">
                                <div class="text-xs font-bold text-tangerine-300 mb-2 uppercase tracking-wider">Director</div>
                                <p class="text-sm text-white font-semibold truncate" id="featureDirector">
                                    {{ $featuredResearch?->director ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 hover:border-tangerine-400/50 transition-all duration-300">
                                <div class="text-xs font-bold text-tangerine-300 mb-2 uppercase tracking-wider">Email</div>
                                <p class="text-sm text-white font-semibold truncate" id="featureEmail">
                                    {{ $featuredResearch?->contact_email ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <!-- CTA Buttons - Modern Design -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            <a href="javascript:void(0)" onclick="exploreResearch(currentGalleryImage)" class="px-8 py-4 bg-gradient-to-r from-tangerine-500 to-tangerine-600 text-white font-bold rounded-2xl hover:shadow-2xl hover:shadow-tangerine-500/40 hover:scale-105 transition-all duration-300 text-center border border-tangerine-400/50 group relative overflow-hidden cursor-pointer">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Explore Research
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('view.research.all') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-2xl hover:bg-white/20 hover:scale-105 transition-all duration-300 border border-white/30 hover:border-white/50 text-center">
                                View All Research
                            </a>
                        </div>

                        <!-- Accent Line -->
                        <div class="h-1 w-16 bg-gradient-to-r from-tangerine-500 to-transparent rounded-full mt-4"></div>
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
        
        // Function to update featured research content when thumbnail is clicked
        function updateToResearch(index) {
            // Update thumbnail borders
            const thumbnails = document.querySelectorAll('#galleryThumbnails button');
            thumbnails.forEach((btn, idx) => {
                btn.style.borderColor = idx === index ? '#FF6B00' : 'rgba(255, 255, 255, 0.3)';
            });
            
            // Update Alpine component's currentGalleryImage
            const alpineEl = document.querySelector('[x-data*="currentGalleryImage"]');
            if (alpineEl && alpineEl.__x) {
                alpineEl.__x.$data.currentGalleryImage = index;
            }
            
            currentGalleryIndex = index;
            
            if (!featuredResearchData || !featuredResearchData[index]) return;
            
            const item = featuredResearchData[index];
            
            // Update main image
            const mainImg = document.getElementById('mainFeatureImage');
            const gradient = document.getElementById('mainFeatureGradient');
            if (mainImg && item.featured_image) {
                mainImg.src = `/storage/${item.featured_image}`;
                mainImg.style.display = 'block';
                if (gradient) gradient.style.display = 'none';
            } else {
                if (mainImg) mainImg.style.display = 'none';
                if (gradient) gradient.style.display = 'flex';
                if (gradient) document.getElementById('fallbackText').textContent = item.name || 'Research Initiative';
            }
            
            // Update content fields with cleaned text
            const deptEl = document.getElementById('featureDept');
            const titleEl = document.getElementById('featureTitle');
            const descEl = document.getElementById('featureDesc');
            const directorEl = document.getElementById('featureDirector');
            const emailEl = document.getElementById('featureEmail');
            
            if (deptEl) deptEl.textContent = cleanText(item.department?.name || 'Department');
            if (titleEl) titleEl.textContent = cleanText(item.name || 'Featured Research');
            
            // Use the pre-cleaned description from the model accessor
            const desc = item.clean_featured_description || item.clean_description || 'Research description';
            const cleanedDesc = desc.substring(0, 300);
            if (descEl) descEl.textContent = cleanedDesc;
            
            if (directorEl) directorEl.textContent = cleanText(item.director || 'N/A');
            if (emailEl) emailEl.textContent = cleanText(item.contact_email || 'N/A');
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

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-tangerine-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-black text-white mb-6 leading-tight">
                Begin Your Engineering Excellence Journey
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Join our community of innovators and become part of UPHSD DALTA's College of Engineering, Architecture, and Technology legacy.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                {{-- CTA Enroll button uses bold tangerine style --}}
                <a href="{{ route('register') }}" style="padding: 14px 32px; background: #FF6B00; color: white; font-weight: 600; border-radius: 8px; text-decoration: none; display: inline-block; transition: all 0.3s ease; border: none; cursor: pointer; box-shadow: 0 5px 15px rgba(255, 107, 0, 0.2);" onmouseover="this.style.background='#E55D00'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(255, 107, 0, 0.3)';" onmouseout="this.style.background='#FF6B00'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(255, 107, 0, 0.2)';">
                    Enroll Now
                </a>
                <a href="{{ route('view.programs') }}" class="px-8 py-4 bg-white/10 text-white font-bold rounded-xl hover:bg-white/30 hover:shadow-2xl hover:shadow-white/20 transition-all duration-300 border border-white/30 hover:border-white hover:scale-110">
                    Learn More
                </a>
            </div>
        </div>
    </section>

@endsection
