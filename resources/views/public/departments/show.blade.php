<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.departments') }}" class="inline-flex items-center gap-2 text-primary-300 hover:text-primary-200 mb-6 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Departments
            </a>

            <div class="flex flex-wrap items-center gap-4 mb-4">
                <span class="px-4 py-1.5 bg-white/15 backdrop-blur-sm text-white text-sm font-mono font-bold rounded-lg border border-white/20">
                    {{ $department->code }}
                </span>
                @if($department->is_center_of_excellence)
                    <span class="badge bg-primary-500/20 text-primary-300 border border-primary-500/30">
                        ★ Center of Excellence
                    </span>
                @endif
            </div>

            <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 animate-fade-in-up">{{ $department->name }}</h1>

            @if($department->building_name || $department->location)
            <p class="text-gray-300 flex items-center gap-2 animate-fade-in-up animation-delay-100">
                <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $department->building_name ?? '' }}{{ $department->building_name && $department->location ? ' · ' : '' }}{{ $department->location ?? 'CEAT Campus' }}
            </p>
            @endif
        </div>
    </section>

    <!-- Quick Stats Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card text-center">
                <div class="text-3xl font-extrabold text-maroon-600">{{ $department->programs->count() }}</div>
                <p class="text-sm text-gray-500 mt-1 font-medium">Programs</p>
            </div>
            <div class="stat-card text-center">
                <div class="text-3xl font-extrabold text-maroon-600">{{ $department->facultyMembers->count() }}</div>
                <p class="text-sm text-gray-500 mt-1 font-medium">Faculty</p>
            </div>
            <div class="stat-card text-center">
                <div class="text-3xl font-extrabold text-maroon-600">{{ $department->researchCenters->count() }}</div>
                <p class="text-sm text-gray-500 mt-1 font-medium">Research Centers</p>
            </div>
            <div class="stat-card text-center">
                <div class="text-3xl font-extrabold text-maroon-600">{{ $department->is_center_of_excellence ? '★' : '—' }}</div>
                <p class="text-sm text-gray-500 mt-1 font-medium">CoE Status</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <div class="card-premium p-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        About This Department
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($department->description)) !!}
                    </div>

                    @if($department->mission)
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Mission</h3>
                        <div class="bg-gradient-to-r from-maroon-50 to-maroon-50/50 rounded-2xl p-6 border-l-4 border-maroon-500">
                            <p class="text-gray-700 leading-relaxed">{{ strip_tags($department->mission) }}</p>
                        </div>
                    </div>
                    @endif

                    @if($department->vision)
                    <div class="mt-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Vision</h3>
                        <div class="bg-gradient-to-r from-primary-50 to-primary-50/50 rounded-2xl p-6 border-l-4 border-primary-500">
                            <p class="text-gray-700 leading-relaxed">{{ strip_tags($department->vision) }}</p>
                        </div>
                    </div>
                    @endif

                    @if($department->contact_email || $department->contact_phone)
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($department->contact_email)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-maroon-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                    <a href="mailto:{{ $department->contact_email }}" class="text-maroon-600 hover:text-maroon-700 font-semibold text-sm break-all">{{ $department->contact_email }}</a>
                                </div>
                            </div>
                            @endif
                            @if($department->contact_phone)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Phone</p>
                                    <a href="tel:{{ $department->contact_phone }}" class="text-maroon-600 hover:text-maroon-700 font-semibold text-sm">{{ $department->contact_phone }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Programs -->
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                        Academic Programs
                    </h2>

                    @if($department->programs->count() > 0)
                    <div class="space-y-4">
                        @foreach($department->programs as $program)
                        <a href="{{ route('view.programs.show', $program->slug) }}" class="block group">
                            <div class="p-5 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 group-hover:text-maroon-600 transition-colors">{{ $program->name }}</h3>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span class="badge badge-maroon">{{ ucfirst($program->degree_level) }}</span>
                                            @if($program->short_name)
                                            <span class="badge badge-gold">{{ $program->short_name }}</span>
                                            @endif
                                        </div>
                                        @if($program->description)
                                        <p class="text-sm text-gray-500 mt-3 line-clamp-2">{{ Str::limit(strip_tags($program->description), 150) }}</p>
                                        @endif
                                    </div>
                                    <svg class="w-5 h-5 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-8">No programs available at this time.</p>
                    @endif
                </div>

                <!-- Faculty -->
                <div class="card-premium p-8 animate-fade-in-up animation-delay-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                        Faculty Members
                    </h2>

                    @if($department->facultyMembers->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($department->facultyMembers as $member)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300">
                            <div class="w-12 h-12 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-sm font-bold shrink-0">
                                {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $member->first_name }} {{ $member->last_name }}</h3>
                                <p class="text-xs text-maroon-600 font-medium">{{ $member->position }}</p>
                                @if($member->email)
                                <a href="mailto:{{ $member->email }}" class="text-xs text-gray-400 hover:text-maroon-500 transition-colors truncate block">{{ $member->email }}</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-8">No faculty members listed at this time.</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Info -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Quick Info
                    </h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Building</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $department->building_name ?? 'N/A' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Location</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $department->location ?? 'CEAT Campus' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Department Code</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5 font-mono">{{ $department->code }}</p>
                        </div>
                    </div>
                </div>

                <!-- Research Centers -->
                @if($department->researchCenters->count() > 0)
                <div class="card-premium p-6 animate-fade-in-right animation-delay-100">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        Research Centers
                    </h3>
                    <div class="space-y-3">
                        @foreach($department->researchCenters as $center)
                        <a href="{{ route('view.research.show', $center) }}" class="block p-3 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <p class="font-semibold text-gray-900 text-sm group-hover:text-maroon-600 transition-colors">{{ $center->name }}</p>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit(strip_tags($center->description), 80) }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- CTA -->
                <div class="bg-gradient-to-br from-maroon-500 to-maroon-700 rounded-2xl p-6 text-white relative overflow-hidden animate-fade-in-right animation-delay-200">
                    <div class="absolute inset-0 hero-pattern opacity-20"></div>
                    <div class="relative">
                        <h3 class="font-bold text-lg mb-2">Interested?</h3>
                        <p class="text-sm text-gray-200 mb-4 leading-relaxed">Learn more about our programs and how to apply.</p>
                        <a href="{{ route('view.programs') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-maroon-900 rounded-xl font-bold text-sm hover:bg-primary-400 transition-all duration-300">
                            View Programs
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
