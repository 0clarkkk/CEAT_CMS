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
                        @php
                            $userMgmtLinks = [
                                ['url' => url('/admin/users'),           'icon' => '👤', 'label' => 'Manage All Users',       'bg' => 'bg-maroon-100', 'active' => true],
                                ['url' => url('/admin/administrators'),   'icon' => '🛡️', 'label' => 'Manage Administrators',   'bg' => 'bg-primary-100', 'active' => true],
                                ['url' => '#',                           'icon' => '🔑', 'label' => 'Manage Roles',            'bg' => 'bg-violet-100', 'active' => false],
                                ['url' => '#',                           'icon' => '🔒', 'label' => 'Manage Permissions',      'bg' => 'bg-emerald-100', 'active' => false],
                            ];
                        @endphp
                        @foreach($userMgmtLinks as $item)
                        @if($item['active'])
                        <a href="{{ $item['url'] }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-maroon-50/50 transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-maroon-600 transition-colors">{{ $item['label'] }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-maroon-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @else
                        <div class="flex items-center justify-between p-3 rounded-xl opacity-50 cursor-not-allowed">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-400">{{ $item['label'] }} <span class="text-xs">(Coming Soon)</span></span>
                            </div>
                        </div>
                        @endif
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
                            ['route' => 'departments.index', 'icon' => '🏛️', 'label' => 'Departments', 'bg' => 'bg-maroon-100'],
                            ['route' => 'programs.index', 'icon' => '🎓', 'label' => 'Programs', 'bg' => 'bg-primary-100'],
                            ['route' => 'faculty.index', 'icon' => '👥', 'label' => 'Faculty Members', 'bg' => 'bg-emerald-100'],
                            ['route' => 'news.index', 'icon' => '📰', 'label' => 'News & Events', 'bg' => 'bg-sky-100'],
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
                        @php
                            $systemLinks = [
                                ['url' => '#', 'icon' => '⚙️', 'label' => 'Global Settings',   'bg' => 'bg-gray-100',    'active' => false],
                                ['url' => '#', 'icon' => '💾', 'label' => 'Database Backups',   'bg' => 'bg-emerald-100', 'active' => false],
                                ['url' => '#', 'icon' => '📝', 'label' => 'System Logs',         'bg' => 'bg-amber-100',   'active' => false],
                                ['url' => '#', 'icon' => '🔍', 'label' => 'Audit Trail',         'bg' => 'bg-violet-100',  'active' => false],
                            ];
                        @endphp
                        @foreach($systemLinks as $item)
                        <div class="flex items-center justify-between p-3 rounded-xl opacity-50 cursor-not-allowed">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 {{ $item['bg'] }} rounded-lg flex items-center justify-center text-xs">{{ $item['icon'] }}</span>
                                <span class="text-sm font-medium text-gray-400">{{ $item['label'] }} <span class="text-xs">(Coming Soon)</span></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Administrators -->
            <div class="bg-white rounded-2xl shadow-card p-6 border border-gray-100 mb-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-sm">🛡️</span>
                        Recent Administrators
                    </h3>
                    <a href="{{ url('/admin/administrators') }}"
                       class="text-xs font-semibold text-maroon-600 hover:text-maroon-800 hover:underline transition-colors">
                        View all →
                    </a>
                </div>

                @if(isset($recentAdmins) && $recentAdmins->count())
                    <div class="divide-y divide-gray-50">
                        @foreach($recentAdmins as $admin)
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $admin->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $admin->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($admin->is_active)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span> Inactive
                                    </span>
                                @endif
                                <a href="{{ url('/admin/administrators/' . $admin->id . '/edit') }}"
                                   class="p-1.5 rounded-lg hover:bg-maroon-50 text-gray-400 hover:text-maroon-600 transition-colors"
                                   title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3 text-xl">🛡️</div>
                        <p class="text-sm text-gray-400">No administrators yet.</p>
                        <a href="{{ url('/admin/administrators/create') }}"
                           class="mt-2 inline-block text-xs font-semibold text-maroon-600 hover:underline">Create the first admin →</a>
                    </div>
                @endif
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
                    <div class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">{{ $health['label'] }}</p>
                            <p class="text-sm font-bold text-emerald-700">✓ {{ $health['status'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
