<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight">Superadmin Dashboard</h2>
                    <p class="text-sm text-gray-500">System administration and oversight</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg">👤</span>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Users</span>
                    </div>
                    <div class="text-2xl font-extrabold text-maroon-600">{{ $stats['total_users'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg">🎓</span>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Students</span>
                    </div>
                    <div class="text-2xl font-extrabold text-maroon-600">{{ $stats['students'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg">🛡️</span>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Admins</span>
                    </div>
                    <div class="text-2xl font-extrabold text-maroon-600">{{ $stats['admins'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg">🏛️</span>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Departments</span>
                    </div>
                    <div class="text-2xl font-extrabold text-maroon-600">{{ $stats['departments'] ?? 0 }}</div>
                </div>
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg">✅</span>
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Active</span>
                    </div>
                    <div class="text-2xl font-extrabold text-emerald-600">{{ $stats['active_users'] ?? 0 }}</div>
                </div>
            </div>

            <!-- Main Controls -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- User Management -->
                <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 bg-maroon-50 rounded-lg flex items-center justify-center text-sm">👥</span>
                        User Management
                    </h3>
                    <div class="space-y-2">
                        @foreach([
                            ['route' => 'users.index', 'icon' => '👤', 'label' => 'Manage All Users', 'bg' => 'bg-maroon-100'],
                            ['route' => 'admins.index', 'icon' => '🛡️', 'label' => 'Manage Administrators', 'bg' => 'bg-primary-100'],
                            ['route' => 'roles.index', 'icon' => '🔑', 'label' => 'Manage Roles', 'bg' => 'bg-violet-100'],
                            ['route' => 'permissions.index', 'icon' => '🔒', 'label' => 'Manage Permissions', 'bg' => 'bg-emerald-100'],
                        ] as $item)
                        <a href="{{ route($item['route']) ?? '#' }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-maroon-50/50 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">{{ $item['label'] }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Content Management -->
                <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-sm">📋</span>
                        Content Management
                    </h3>
                    <div class="space-y-2">
                        @foreach([
                            ['route' => 'view.departments', 'icon' => '🏛️', 'label' => 'Departments', 'bg' => 'bg-maroon-100'],
                            ['route' => 'view.programs', 'icon' => '🎓', 'label' => 'Programs', 'bg' => 'bg-primary-100'],
                            ['route' => 'view.faculty', 'icon' => '👥', 'label' => 'Faculty Members', 'bg' => 'bg-emerald-100'],
                            ['route' => 'view.news', 'icon' => '📰', 'label' => 'News & Events', 'bg' => 'bg-sky-100'],
                        ] as $item)
                        <a href="{{ route($item['route']) ?? '#' }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-maroon-50/50 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">{{ $item['label'] }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- System Settings -->
                <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-sm">⚙️</span>
                        System Settings
                    </h3>
                    <div class="space-y-2">
                        @foreach([
                            ['route' => 'settings.index', 'icon' => '⚙️', 'label' => 'Global Settings', 'bg' => 'bg-gray-100'],
                            ['route' => 'backups.index', 'icon' => '💾', 'label' => 'Database Backups', 'bg' => 'bg-emerald-100'],
                            ['route' => 'logs.index', 'icon' => '📝', 'label' => 'System Logs', 'bg' => 'bg-amber-100'],
                            ['route' => 'audit.index', 'icon' => '🔍', 'label' => 'Audit Trail', 'bg' => 'bg-violet-100'],
                        ] as $item)
                        <a href="{{ route($item['route']) ?? '#' }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-maroon-50/50 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">{{ $item['label'] }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-sm">💚</span>
                    System Health
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach([
                        ['label' => 'Database Status', 'status' => 'Connected', 'color' => 'emerald'],
                        ['label' => 'Cache Status', 'status' => 'Active', 'color' => 'emerald'],
                        ['label' => 'Queue Status', 'status' => 'Running', 'color' => 'emerald'],
                    ] as $health)
                    <div class="flex items-center gap-3 p-4 bg-{{ $health['color'] }}-50/50 rounded-xl border border-{{ $health['color'] }}-100">
                        <span class="w-3 h-3 bg-{{ $health['color'] }}-500 rounded-full animate-pulse"></span>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">{{ $health['label'] }}</p>
                            <p class="text-sm font-bold text-{{ $health['color'] }}-700">✓ {{ $health['status'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
