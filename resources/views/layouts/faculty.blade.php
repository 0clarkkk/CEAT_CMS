@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full block lg:flex gap-8 items-start">
    <!-- Overlay for mobile sidebar (optional, could be added later) -->
    
    <!-- Sidebar -->
    <aside class="hidden lg:block w-72 flex-shrink-0">
        <div class="sticky top-24 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-tangerine-100 text-tangerine-600 flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-900 truncate">{{ auth()->user()->name }}</h2>
                        <p class="text-xs text-slate-500 font-medium tracking-wide uppercase">Faculty Portal</p>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <nav class="space-y-1.5">
                    @php
                        $navItems = [
                            [
                                'label' => 'Dashboard Overview', 
                                'route' => 'faculty.dashboard',
                                'activeConfig' => 'faculty.dashboard*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>'
                            ],
                            [
                                'label' => 'Consultations', 
                                'route' => 'faculty.consultations.index',
                                'activeConfig' => 'faculty.consultations.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>'
                            ],
                            [
                                'label' => 'Profile Settings', 
                                'route' => 'faculty.profile.preview', // Main landing for profile
                                'activeConfig' => 'faculty.profile.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>'
                            ],
                            [
                                'label' => 'Advisor Tools', 
                                'route' => 'faculty.advisor-profile.show',
                                'activeConfig' => 'faculty.advisor-profile.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.956 11.956 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>'
                            ]
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        @php
                            $isActive = request()->routeIs($item['activeConfig']);
                        @endphp
                        <a href="{{ route($item['route']) }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 {{ $isActive ? 'bg-tangerine-50 text-tangerine-600 shadow-sm border border-tangerine-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-transparent' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isActive ? 'text-tangerine-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                {!! $item['icon'] !!}
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
            
            <div class="p-4 border-t border-slate-100 bg-slate-50/30">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-slate-500 rounded-lg hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-red-500 rounded-lg hover:text-red-700 hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 min-w-0">
        <!-- Optional Breadcrumbs -->
        @if(isset($breadcrumbs))
            <div class="mb-4">
                <x-breadcrumbs :items="$breadcrumbs" />
            </div>
        @endif
        
        <!-- Page Title & Actions -->
        @if(isset($title) || isset($actions))
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                @if(isset($title))
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $title }}</h1>
                @endif
                @if(isset($actions))
                    <div class="flex items-center gap-3">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        @endif

        <!-- Local Errors/Success Alerts -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start gap-3">
                <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-green-800 text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 flex items-start gap-3">
                <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-red-800 text-sm font-medium">{{ session('error') }}</div>
            </div>
        @endif

        <!-- Yield main workspace content -->
        <div class="space-y-6">
            @yield('faculty_content')
        </div>
    </main>
</div>
@endsection
