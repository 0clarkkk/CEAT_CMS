@extends('layouts.public')

@section('title', 'College History')

@section('content')
<style>
    .history-card {
        @apply opacity-0 animate-fadeIn;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.7s ease-out forwards;
    }

    .year-badge {
        @apply font-black bg-gradient-to-br bg-clip-text text-transparent;
        font-size: 40px;
        line-height: 1;
    }
</style>

<div class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-20 text-center">
            <h1 class="text-5xl sm:text-6xl font-black text-gray-900 mb-4 leading-tight">Our Journey Through Time</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Decades of innovation, excellence, and commitment to engineering education
            </p>
            <div class="flex justify-center mt-8">
                <div class="h-1 w-32 bg-gradient-to-r from-maroon-600 via-primary-500 to-maroon-600 rounded-full"></div>
            </div>
        </div>

        <!-- Modern Stepped Timeline -->
        <div class="space-y-8 relative" style="padding-left: 80px;">
            <!-- Timeline Vertical Line -->
            <div class="absolute top-0 bottom-0 w-1 bg-gradient-to-b from-maroon-600 via-primary-500 to-maroon-600" style="left: 22px; z-index: 0;"></div>

            <!-- Timeline Items -->
            <div class="space-y-16 relative" style="z-index: 10;">
                <!-- 1975 -->
                <div class="history-card" style="animation-delay: 0.1s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-maroon-600 to-maroon-700 mb-1">1975</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Foundation</h3>
                            <p class="text-gray-600 leading-relaxed max-w-2xl">
                                The University of Perpetual Help System DALTA was established, laying the foundation for future academic colleges, including engineering and technology programs.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 1990s -->
                <div class="history-card" style="animation-delay: 0.2s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-primary-500 to-primary-600 mb-1">1990s</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Early Development</h3>
                            <p class="text-gray-600 leading-relaxed max-w-2xl">
                                Engineering programs were gradually introduced to meet the growing demand for technical professionals in the Philippines. The College of Engineering was formally organized.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Early 2000s -->
                <div class="history-card" style="animation-delay: 0.3s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-maroon-600 to-maroon-700 mb-1">Early 2000s</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Expansion</h3>
                            <p class="text-gray-600 leading-relaxed max-w-2xl">
                                The college expanded its offerings to include Civil, Mechanical, and Electronics Engineering. Facilities and laboratories were improved to support hands-on learning.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Mid-Late 2000s -->
                <div class="history-card" style="animation-delay: 0.4s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-primary-500 to-primary-600 mb-1">2000s (Mid-Late)</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Multidisciplinary Growth</h3>
                            <p class="text-gray-600 leading-relaxed max-w-2xl">
                                Architecture and technology-related programs were introduced, reflecting industry trends and innovation. The college began transitioning into a more multidisciplinary institution.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2010s -->
                <div class="history-card" style="animation-delay: 0.5s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-maroon-600 to-maroon-700 mb-1">2010s</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Official Recognition</h3>
                            <p class="text-gray-600 leading-relaxed max-w-2xl">
                                The college was officially recognized as the College of Engineering, Architecture and Technology (CEAT). Focus included research, industry partnerships, and outcome-based education.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2020s -->
                <div class="history-card" style="animation-delay: 0.6s;">
                    <div class="flex items-start gap-6 relative">
                        <div class="absolute w-5 h-5 bg-maroon-600 rounded-full border-4 border-white shadow-lg" style="left: 12px; top: 3px; z-index: 20;"></div>
                        <div class="pt-1" style="margin-left: 50px;">
                            <div class="year-badge from-primary-600 to-maroon-600 mb-1">2020s – Present</div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Modern Era</h3>
                            <p class="text-gray-600 leading-relaxed mb-3 max-w-2xl">
                                CEAT continues to modernize its curriculum by integrating emerging technologies, strengthening internship and industry linkages, and supporting innovation and student research.
                            </p>
                            <p class="font-semibold text-maroon-700 italic" style="font-size: 25px;">
                                "Character Building is Nation Building"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>
@endsection
