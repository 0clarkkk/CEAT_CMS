<x-public-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[500px] pt-32 pb-20 overflow-hidden gradient-mesh">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-maroon-500/10 rounded-full blur-3xl translate-y-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full border border-primary-200 mb-6">
                    <span class="w-2 h-2 bg-primary-600 rounded-full"></span>
                    <span class="text-sm font-semibold text-primary-700">Academic Excellence</span>
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Engineering Departments
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl leading-relaxed">
                    Explore our comprehensive range of engineering disciplines designed to prepare the next generation of innovators and leaders.
                </p>
            </div>
        </div>
    </section>

    <!-- Departments Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($departments as $index => $dept)
                <a href="{{ route('view.departments.show', $dept->slug) }}" class="group card-hover bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-maroon-600 h-full">
                    <div class="h-1.5 bg-gradient-to-r from-maroon-500 to-primary-500 rounded-t-2xl absolute top-0 left-0 right-0 -mt-6"></div>
                    <div class="flex items-start justify-between mb-4">
                        <div class="text-4xl">◆</div>
                        <span class="px-3 py-1 bg-maroon-50 text-maroon-700 text-xs font-bold rounded-full">{{ $dept->code }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-maroon-700 transition-colors">{{ $dept->name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-6 leading-relaxed">
                        {{ strip_tags($dept->description) ?? 'No description available' }}
                    </p>
                    <div class="flex gap-4 text-sm text-gray-500 pt-6 border-t border-gray-100">
                        <span class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-maroon-500 rounded-full"></span>
                            {{ $dept->programs()->count() }} Programs
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                            {{ $dept->facultyMembers()->count() }} Faculty
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-6xl mb-4">◆</div>
                    <p class="text-gray-500 text-lg font-medium">No departments found.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 text-maroon-700 font-bold border-2 border-maroon-600 rounded-xl hover:bg-maroon-50 transition-colors duration-300">
                ← Back to Home
            </a>
        </div>
    </section>
</x-public-layout>
