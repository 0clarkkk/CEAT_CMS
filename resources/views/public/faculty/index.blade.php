<x-public-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[500px] pt-32 pb-20 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200 mb-6">
                    <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                    <span class="text-sm font-semibold text-primary-700">Academic Leadership</span>
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Faculty Directory
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl leading-relaxed">
                    Meet our distinguished faculty members and academic experts dedicated to engineering excellence.
                </p>
            </div>
        </div>
    </section>

    <!-- Faculty Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($faculty as $index => $member)
                <a href="{{ route('view.faculty.show', $member) }}" class="group" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both">
                    <div class="card-premium h-full">
                        <div class="h-1.5 bg-gradient-to-r from-maroon-500 to-primary-500 rounded-t-2xl"></div>
                        <div class="p-6">
                            <div class="flex items-start gap-4 mb-4">
                                @if($member->getPhotoUrl())
                                    <img src="{{ $member->getPhotoUrl() }}" alt="{{ $member->first_name }} {{ $member->last_name }}" class="w-16 h-16 rounded-2xl object-cover shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-md">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-2xl flex items-center justify-center text-white text-lg font-bold shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-md">
                                        {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-maroon-600 transition-colors">{{ $member->first_name }} {{ $member->last_name }}</h3>
                                    <span class="badge badge-gold mt-1">{{ $member->position }}</span>
                                </div>
                            </div>

                            @if ($member->department)
                                <p class="text-sm text-gray-500 font-medium mb-3">{{ $member->department->name }}</p>
                            @endif

                            @if($member->specialization)
                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                                <span class="font-semibold text-gray-700">Specialization:</span> {{ $member->specialization }}
                            </p>
                            @endif

                            @if($member->email)
                            <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                                <svg class="w-4 h-4 text-maroon-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="truncate">{{ $member->email }}</span>
                            </div>
                            @endif

                            <div class="flex items-center justify-between text-maroon-600 font-semibold text-sm pt-4 border-t border-gray-100">
                                <span>View Profile</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">👤</div>
                    <p class="text-gray-500 text-lg font-medium">No faculty members found.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-public-layout>
