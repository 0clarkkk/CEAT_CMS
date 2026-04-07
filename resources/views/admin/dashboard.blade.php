<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight">Admin Dashboard</h2>
                    <p class="text-sm text-gray-500">Manage your content and resources</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-maroon-50 rounded-xl flex items-center justify-center">🏛️</div>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Departments</span>
                    </div>
                    <div class="text-3xl font-extrabold text-maroon-600">{{ $stats['departments'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center">🎓</div>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Programs</span>
                    </div>
                    <div class="text-3xl font-extrabold text-maroon-600">{{ $stats['programs'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">👥</div>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Faculty</span>
                    </div>
                    <div class="text-3xl font-extrabold text-maroon-600">{{ $stats['faculty'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center">👤</div>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Users</span>
                    </div>
                    <div class="text-3xl font-extrabold text-maroon-600">{{ $stats['users'] ?? 0 }}</div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Content Management -->
                <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 bg-maroon-50 rounded-lg flex items-center justify-center text-sm">📋</span>
                        Content Management
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('view.departments') ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-maroon-100 rounded-lg flex items-center justify-center text-sm">🏛️</span>
                                <span class="font-medium text-gray-900 group-hover:text-maroon-600 transition-colors">Manage Departments</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('view.programs') ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center text-sm">🎓</span>
                                <span class="font-medium text-gray-900 group-hover:text-maroon-600 transition-colors">Manage Programs</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('view.faculty') ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-sm">👥</span>
                                <span class="font-medium text-gray-900 group-hover:text-maroon-600 transition-colors">Manage Faculty</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('view.news') ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center text-sm">📰</span>
                                <span class="font-medium text-gray-900 group-hover:text-maroon-600 transition-colors">Manage News & Events</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-sm">⚡</span>
                        Quick Actions
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('view.research') ?? '#' }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-maroon-200 hover:bg-maroon-50/30 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-sm">🔬</span>
                        <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-sm">📊</span>
                                <span class="font-medium text-gray-400">View Reports <span class="text-xs">(Coming Soon)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
