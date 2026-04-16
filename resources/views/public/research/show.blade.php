<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.research') }}" class="inline-flex items-center gap-2 text-primary-300 hover:text-primary-200 mb-6 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Research Centers
            </a>

            <div class="flex flex-wrap gap-3 mb-4">
                @if ($researchCenter->department?->slug)
                    <a href="{{ route('view.departments.show', $researchCenter->department->slug) }}" class="badge bg-primary-500/20 text-primary-300 border border-primary-500/30 hover:bg-primary-500/30 transition-colors">
                        {{ $researchCenter->department->name }}
                    </a>
                @endif
            </div>

            <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 animate-fade-in-up">{{ $researchCenter->name }}</h1>

            @if ($researchCenter->director)
            <p class="text-gray-300 flex items-center gap-2 animate-fade-in-up animation-delay-100">
                <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <strong>Director:</strong> {{ $researchCenter->director }}
            </p>
            @endif
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
                    $researchAreas = is_array($researchCenter->research_areas) ? $researchCenter->research_areas : (is_string($researchCenter->research_areas) ? json_decode($researchCenter->research_areas, true) : []);
                @endphp
                @if (!empty($researchAreas) && count($researchAreas) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center text-primary-700">🔬</span>
                        Research Areas
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($researchAreas as $area)
                        <div class="flex items-center gap-3 p-4 bg-gradient-to-r from-maroon-50 to-maroon-50/50 rounded-xl border-l-4 border-maroon-500">
                            <span class="w-2 h-2 rounded-full bg-maroon-500 shrink-0"></span>
                            <p class="text-gray-800 font-medium text-sm">{{ is_array($area) ? implode(', ', $area) : $area }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Facilities -->
                @if ($researchCenter->facilities)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">◼</span>
                        Facilities & Equipment
                    </h2>
                    <div class="bg-gray-50 rounded-2xl p-6">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $researchCenter->facilities }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Contact Information
                    </h3>
                    <div class="space-y-4">
                        @if ($researchCenter->contact_email)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                            <a href="mailto:{{ $researchCenter->contact_email }}" class="font-semibold text-maroon-600 text-sm break-all hover:text-maroon-700">{{ $researchCenter->contact_email }}</a>
                        </div>
                        @endif
                        @if ($researchCenter->department->contact_phone)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Phone</p>
                            <a href="tel:{{ $researchCenter->department->contact_phone }}" class="font-semibold text-maroon-600 text-sm hover:text-maroon-700">{{ $researchCenter->department->contact_phone }}</a>
                        </div>
                        @endif
                        @if ($researchCenter->department->location)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Location</p>
                            <p class="font-semibold text-gray-900 text-sm">{{ $researchCenter->department->location }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related Links -->
                <div class="card-premium p-6 animate-fade-in-right animation-delay-100">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        Related
                    </h3>
                    <div class="space-y-2">
                        @if ($researchCenter->department?->slug)
                            <a href="{{ route('view.departments.show', $researchCenter->department->slug) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-maroon-50 transition-colors group">
                                <span class="w-8 h-8 bg-maroon-100 rounded-lg flex items-center justify-center text-maroon-600 text-sm">◆</span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">Department</span>
                            </a>
                        @endif
                        <a href="{{ route('view.research') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-maroon-50 transition-colors group">
                            <span class="w-8 h-8 bg-maroon-100 rounded-lg flex items-center justify-center text-maroon-600 text-sm">⬢</span>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">All Research Centers</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
