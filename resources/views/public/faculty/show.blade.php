<x-public-layout>
    <!-- Hero Header -->
    <section class="relative bg-gradient-hero text-white py-20 lg:py-28 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('view.faculty') }}" class="inline-flex items-center gap-2 text-primary-300 hover:text-primary-200 mb-6 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Faculty Directory
            </a>

            <div class="flex items-start gap-6">
                @if($faculty->getPhotoUrl())
                    <img src="{{ $faculty->getPhotoUrl() }}" alt="{{ $faculty->first_name }} {{ $faculty->last_name }}" class="w-20 h-20 rounded-2xl object-cover shrink-0 shadow-xl animate-scale-in">
                @else
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center text-maroon-900 text-2xl font-bold shrink-0 shadow-xl animate-scale-in">
                        {{ strtoupper(substr($faculty->first_name, 0, 1) . substr($faculty->last_name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold mb-2 animate-fade-in-up">{{ $faculty->first_name }} {{ $faculty->last_name }}</h1>
                    <div class="flex flex-wrap gap-3 animate-fade-in-up animation-delay-100">
                        <span class="badge bg-primary-500/20 text-primary-300 border border-primary-500/30">{{ $faculty->position }}</span>
                        <a href="{{ route('view.departments.show', $faculty->department->slug) }}" class="text-gray-300 hover:text-primary-300 transition-colors text-sm">
                            {{ $faculty->department->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Biography -->
                @if($faculty->biography)
                <div class="card-premium p-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Biography
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e(strip_tags($faculty->biography))) !!}
                    </div>
                </div>
                @endif

                <!-- Education -->
                @if($faculty->education && is_array($faculty->education) && count($faculty->education) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">◼</span>
                        Education
                    </h2>
                    <div class="space-y-4">
                        @foreach($faculty->education as $edu)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-3 h-3 rounded-full bg-maroon-500 mt-1.5 shrink-0"></div>
                            <p class="text-gray-700 font-medium">{{ is_array($edu) ? implode(' - ', $edu) : $edu }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Research Interests -->
                @if($faculty->research_interests && is_array($faculty->research_interests) && count($faculty->research_interests) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center text-primary-700">⬢</span>
                        Research Interests
                    </h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($faculty->research_interests as $interest)
                        <span class="px-4 py-2 bg-maroon-50 text-maroon-700 rounded-xl text-sm font-medium border border-maroon-100">
                            {{ is_array($interest) ? implode(', ', $interest) : $interest }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Publications -->
                @if($faculty->publications && is_array($faculty->publications) && count($faculty->publications) > 0)
                <div class="card-premium p-8 animate-fade-in-up animation-delay-300">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600">▬</span>
                        Publications
                    </h2>
                    <div class="space-y-3">
                        @foreach($faculty->publications as $pub)
                        <div class="p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/20 transition-all duration-300">
                            <p class="text-gray-700 text-sm leading-relaxed">{{ is_array($pub) ? implode(', ', $pub) : $pub }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact -->
                <div class="card-premium p-6 animate-fade-in-right">
                    <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Contact
                    </h3>
                    <div class="space-y-4">
                        @if($faculty->email)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                            <a href="mailto:{{ $faculty->email }}" class="font-semibold text-maroon-600 text-sm mt-0.5 break-all hover:text-maroon-700">{{ $faculty->email }}</a>
                        </div>
                        @endif
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Department</p>
                            <a href="{{ route('view.departments.show', $faculty->department->slug) }}" class="font-semibold text-maroon-600 text-sm mt-0.5 hover:text-maroon-700">{{ $faculty->department->name }}</a>
                        </div>
                        @if($faculty->specialization)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Specialization</p>
                            <p class="font-semibold text-gray-900 text-sm mt-0.5">{{ $faculty->specialization }}</p>
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
                        <a href="{{ route('view.departments.show', $faculty->department->slug) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-maroon-50 transition-colors group">
                            <span class="w-8 h-8 bg-maroon-100 rounded-lg flex items-center justify-center text-maroon-600 text-sm">◆</span>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">Department Page</span>
                        </a>
                        <a href="{{ route('view.faculty') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-maroon-50 transition-colors group">
                            <span class="w-8 h-8 bg-maroon-100 rounded-lg flex items-center justify-center text-maroon-600 text-sm">◉</span>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">All Faculty</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
