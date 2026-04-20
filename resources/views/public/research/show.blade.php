<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.academics.research') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white font-medium text-sm transition-all duration-300 backdrop-blur-sm border border-white/20 hover:border-white/40 mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                <span>Back to Research Centers</span>
            </a>

            <div class="flex flex-wrap gap-3 mb-4">
                <a href="{{ route('view.departments.show', $researchCenter->department) }}" class="badge bg-primary-500/20 text-primary-300 border border-primary-500/30 hover:bg-primary-500/30 transition-colors">
                    {{ $researchCenter->department->name }}
                </a>
            </div>

            <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 animate-fade-in-up">{{ $researchCenter->name }}</h1>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <div class="card-premium p-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        About This Center
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e(strip_tags($researchCenter->description))) !!}
                    </div>
                </div>

                <!-- Research Areas -->
                @php
                    $researchAreas = $researchCenter->research_areas ?? [];
                    // Filter out empty rows for display
                    $researchAreas = array_filter($researchAreas, function($item) {
                        return is_array($item) ? !empty($item['area'] ?? '') : !empty($item);
                    });
                @endphp
                @if (!empty($researchAreas) && count($researchAreas) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        Research Areas
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($researchAreas as $item)
                        <div class="flex items-start gap-3 p-4 rounded-xl border-l-4 border-maroon-500">
                            <span class="w-2 h-2 rounded-full bg-maroon-500 shrink-0 mt-1"></span>
                            <div>
                                <p class="text-gray-900 font-semibold text-sm">{{ is_array($item) ? ($item['area'] ?? '') : $item }}</p>
                                @if (is_array($item) && isset($item['description']) && $item['description'])
                                    <p class="text-gray-600 text-xs mt-1">{{ $item['description'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Facilities -->
                @if ($researchCenter->facilities)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        Facilities & Equipment
                    </h2>
                    <div class="bg-gray-50 rounded-2xl p-6">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $researchCenter->facilities }}</p>
                    </div>
                </div>
                @endif

                <!-- Researchers Section -->
                @if ($researchCenter->researchers->isNotEmpty())
                <div class="card-premium p-8 animate-fade-in-up animation-delay-300">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center text-primary-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </span>
                        {{ $researchCenter->researchers->count() === 1 ? 'Researcher' : 'Researchers' }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($researchCenter->researchers as $researcher)
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-start gap-4">
                                    @if ($researcher->photo)
                                        <img src="/storage/{{ $researcher->photo }}" alt="{{ $researcher->name }}" class="w-24 h-24 rounded-xl object-cover border-2 border-maroon-100">
                                    @else
                                        <div class="w-24 h-24 rounded-xl bg-gradient-to-br from-maroon-400 to-maroon-600 border-2 border-maroon-100">
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900">{{ $researcher->name }}</h3>
                                        @if ($researcher->email)
                                            <p class="text-sm text-maroon-600 font-medium">{{ $researcher->email }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if ($researcher->email)
                                <div class="mt-4 flex gap-3 pt-4 border-t border-gray-200">
                                    <a href="mailto:{{ $researcher->email }}" title="Email" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-maroon-50 text-maroon-600 text-sm font-medium rounded-lg hover:bg-maroon-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        Email
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Gallery Section -->
                @php
                    $gallery = $researchCenter->gallery ?? [];
                    $gallery = array_filter($gallery, function($item) {
                        return !empty(trim((string)$item));
                    });
                @endphp
                @if (!empty($gallery) && count($gallery) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-400">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center text-primary-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        Gallery
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($gallery as $item)
                            @php
                                $photoExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'tif', 'tiff', 'bmp', 'svg'];
                                $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'];
                                $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                                $isVideo = in_array($extension, $videoExtensions);
                                $isPhoto = in_array($extension, $photoExtensions);
                            @endphp
                            
                            <div class="relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group h-64 bg-gray-100">
                                @if($isPhoto)
                                    <a href="/storage/{{ $item }}" class="group relative overflow-hidden rounded-xl w-full h-full block" data-fancybox="gallery">
                                        <img src="/storage/{{ $item }}" alt="Gallery photo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                                    </a>
                                @elseif($isVideo)
                                    <a href="/storage/{{ $item }}" class="group relative overflow-hidden w-full h-full block bg-black" data-fancybox="gallery">
                                        <video class="w-full h-full object-cover">
                                            <source src="/storage/{{ $item }}" type="video/{{ $extension }}">
                                        </video>
                                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                        <div class="absolute top-2 right-2 bg-maroon-600 text-white px-2 py-1 rounded text-xs font-semibold">
                                            VIDEO
                                        </div>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Details Card -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Details
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Department -->
                        @if ($researchCenter->department)
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Department</p>
                            <p class="text-sm font-semibold text-maroon-600">{{ $researchCenter->department->name }}</p>
                        </div>
                        @endif

                        <!-- Published Date -->
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Published</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $researchCenter->published_at?->format('M d, Y') ?? $researchCenter->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Contact Information
                    </h3>
                    @if ($researchCenter->contact_email)
                    <div class="space-y-4">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                            <a href="mailto:{{ $researchCenter->contact_email }}" class="font-semibold text-maroon-600 text-sm break-all hover:text-maroon-700">{{ $researchCenter->contact_email }}</a>
                        </div>
                    </div>
                    @else
                    <p class="text-gray-500 text-sm">No contact information available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

<style>
    /* FancyBox Custom Styling */
    .fancybox__container .fancybox__button {
        background: transparent !important;
        color: white !important;
        opacity: 0.4 !important;
        transition: all 0.3s ease !important;
    }

    .fancybox__container .fancybox__button:hover {
        opacity: 1 !important;
        background: #933336 !important;
    }

    /* Slide buttons - Arrow left and right */
    .fancybox__button[aria-label*="previous"],
    .fancybox__button[aria-label*="next"],
    .fancybox__button--arrow_left,
    .fancybox__button--arrow_right {
        background: transparent !important;
        width: 50px !important;
        height: 50px !important;
        border-radius: 50% !important;
        border: none !important;
        cursor: pointer !important;
        opacity: 0.4 !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 1000 !important;
    }

    .fancybox__button[aria-label*="previous"]:hover,
    .fancybox__button[aria-label*="next"]:hover,
    .fancybox__button--arrow_left:hover,
    .fancybox__button--arrow_right:hover {
        opacity: 1 !important;
        background: #933336 !important;
    }

    .fancybox__button svg {
        stroke: white !important;
        stroke-width: 2 !important;
    }

    /* Modal background */
    .fancybox__backdrop {
        background: rgba(0, 0, 0, 0.9) !important;
    }
</style>

<script>
    // Initialize FancyBox with custom configuration
    jQuery(document).ready(function($) {
        if (typeof $.fancybox !== 'undefined') {
            $.fancybox.defaults.transitionEffect = 'fade';
            $.fancybox.defaults.autoSize = true;
            $.fancybox.defaults.buttons = ['slideShow', 'fullScreen', 'close'];
        }
    });
</script>
