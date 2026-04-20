<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.programs') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white font-medium text-sm transition-all duration-300 backdrop-blur-sm border border-white/20 hover:border-white/40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                <span>Back to Programs</span>
            </a>

            <div class="flex flex-wrap gap-3 mb-4 mt-8">
                <span class="badge bg-primary-500/20 text-primary-300 border border-primary-500/30">{{ ucfirst($program->degree_level) }}</span>
                <span class="badge bg-white/10 text-white border border-white/20">{{ $program->duration_years }} Years</span>
            </div>

            <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 animate-fade-in-up">{{ $program->name }}</h1>
            <p class="text-gray-300 animate-fade-in-up animation-delay-100">
                <a href="{{ route('view.departments.show', $program->department->slug) }}" class="hover:text-primary-300 transition-colors">
                    {{ $program->department->name }}
                </a>
            </p>
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
                        Program Overview
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e(strip_tags($program->description))) !!}
                    </div>
                </div>

                <!-- Objectives -->
                @if($program->objectives)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Program Objectives
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e(strip_tags($program->objectives))) !!}
                    </div>
                </div>
                @endif

                <!-- Career Opportunities -->
                @if($program->career_opportunities)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center text-primary-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        Career Opportunities
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e(strip_tags($program->career_opportunities))) !!}
                    </div>
                </div>
                @endif


            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Program Details -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Program Details
                    </h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Degree Level</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ ucfirst($program->degree_level) }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Duration</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $program->duration_years }} Years</p>
                        </div>
                        @if($program->short_name)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Short Name</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $program->short_name }}</p>
                        </div>
                        @endif
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Department</p>
                            <a href="{{ route('view.departments.show', $program->department->slug) }}" class="font-semibold text-maroon-600 text-sm mt-0.5 hover:text-maroon-700 transition-colors">
                                {{ $program->department->name }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-2xl p-6 text-white relative overflow-hidden animate-fade-in-right animation-delay-100">
                    <div class="absolute inset-0 hero-pattern opacity-20"></div>
                    <div class="relative">
                        <h3 class="font-bold text-lg mb-2">Apply Now</h3>
                        <p class="text-sm text-gray-200 mb-4 leading-relaxed">Interested in this program? Start your journey today.</p>
                        @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-maroon-900 rounded-xl font-bold text-sm hover:bg-primary-400 transition-all duration-300">
                            Register Now
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
