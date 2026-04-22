{{-- Faculty Dashboard
     Main landing page for authenticated faculty members.
     Shows statistics (if advisor), upcoming consultations,
     recent activity, profile card, and monthly stats.
     Color scheme: tangerine (orange), white, slate.
--}}
@extends('layouts.faculty', [
    'title' => 'Faculty Dashboard',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Dashboard Overview']
    ]
])

@section('faculty_content')
    {{-- Profile setup prompt — shown when no faculty record exists --}}
    @if(!$faculty)
    <div class="bg-gradient-to-br from-tangerine-50 to-orange-50 border border-tangerine-200 rounded-2xl p-12 text-center shadow-lg">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-tangerine-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-slate-900 mb-2">Profile Setup Required</h2>
        <p class="text-slate-600 mb-8 max-w-md mx-auto">Your faculty profile hasn't been set up yet. Please complete your profile to access the full dashboard and manage your consultations.</p>
        <a href="{{ route('faculty.profile.edit') }}"
            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-tangerine-500 to-tangerine-600 text-white rounded-xl hover:shadow-lg hover:from-tangerine-600 hover:to-tangerine-700 transition-all duration-300 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
            Complete Your Profile
        </a>
    </div>
    @else

    {{-- Advisor Statistics Cards — only visible to faculty with advisor role --}}
    @if($faculty->is_advisor)
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        {{-- Pending Requests --}}
        <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-tangerine-50 to-orange-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6 border-t-4 border-tangerine-400">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-tangerine-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-slate-600 font-semibold">Pending Requests</p>
                <p class="text-4xl font-bold text-slate-900 mt-3">{{ $pendingConsultations }}</p>
                <a href="{{ route('faculty.consultations.index', ['status' => 'pending']) }}"
                    class="text-xs text-tangerine-600 hover:text-tangerine-700 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                    Review Now
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Upcoming Consultations --}}
        <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-slate-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6 border-t-4 border-slate-400">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-slate-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-slate-600 font-semibold">Upcoming (7 Days)</p>
                <p class="text-4xl font-bold text-slate-900 mt-3">{{ $upcomingConsultations->count() }}</p>
                <a href="{{ route('faculty.consultations.index') }}"
                    class="text-xs text-slate-600 hover:text-slate-800 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                    View Schedule
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Completed This Month --}}
        <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6 border-t-4 border-green-400">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-slate-600 font-semibold">Completed in {{ now()->format('M') }}</p>
                <p class="text-4xl font-bold text-slate-900 mt-3">{{ $completedThisMonth }}</p>
            </div>
        </div>

        {{-- Manage Availability --}}
        <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-tangerine-50 to-orange-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6 border-t-4 border-tangerine-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-tangerine-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-slate-600 font-semibold">Time Management</p>
                <p class="text-sm text-slate-700 mt-3">Set slots for students</p>
                <a href="{{ route('faculty.advisor-profile.show') }}"
                    class="text-xs text-tangerine-600 hover:text-tangerine-700 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                    Advisor Settings
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Content — 2/3 + 1/3 layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: list feeds --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Upcoming Consultations List (advisors only) --}}
            @if($faculty->is_advisor)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-shadow overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Upcoming Consultations</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ $upcomingConsultations->count() }} scheduled for the next 7 days</p>
                    </div>
                    <div class="bg-tangerine-100 rounded-xl p-2 hidden sm:block">
                        <svg class="w-5 h-5 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                @if($upcomingConsultations->isEmpty())
                <div class="px-6 py-16 text-center">
                    <p class="text-slate-600 font-semibold">No upcoming consultations</p>
                    <p class="text-sm text-slate-500 mt-1">When students request consultations, they'll appear here</p>
                </div>
                @else
                <div class="divide-y divide-slate-100">
                    @foreach($upcomingConsultations as $consultation)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-2 h-2 bg-tangerine-500 rounded-full mt-1"></div>
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $consultation->title }}</h3>
                                </div>
                                <div class="ml-5 space-y-1 text-sm">
                                    <p class="text-slate-600">
                                        <span class="text-slate-400">Student:</span>
                                        <span class="font-medium text-slate-800">{{ $consultation->student?->name ?? 'N/A' }}</span>
                                    </p>
                                    @if($consultation->category)
                                    <p class="text-slate-600">
                                        <span class="text-slate-400">Category:</span>
                                        <span class="capitalize font-medium text-slate-800">{{ $consultation->category }}</span>
                                    </p>
                                    @endif
                                    <div class="flex items-center text-slate-600 pt-1">
                                        <svg class="w-4 h-4 mr-2 text-tangerine-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $consultation->scheduled_at?->format('M d, Y \a\t h:i A') ?? 'Not scheduled' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-tangerine-100 text-tangerine-700">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                                <a href="{{ route('faculty.consultations.show', $consultation->id) }}"
                                    class="px-3 py-2 rounded-lg bg-tangerine-50 text-tangerine-600 hover:bg-tangerine-100 text-xs font-semibold transition-colors">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            {{-- Recent Activity feed --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-shadow overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Recent Activity</h2>
                        <p class="text-sm text-slate-500 mt-1">Latest consultation updates</p>
                    </div>
                </div>

                @if($recentActivity->isEmpty())
                <div class="px-6 py-16 text-center">
                    <p class="text-slate-600 font-semibold">No recent activity</p>
                </div>
                @else
                <div class="divide-y divide-slate-100">
                    @foreach($recentActivity->take(5) as $activity)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 flex items-start gap-3">
                                <div class="mt-0.5">
                                    @if($activity->status === 'pending')
                                    <span class="inline-block w-3 h-3 bg-tangerine-400 rounded-full"></span>
                                    @elseif($activity->status === 'approved')
                                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                                    @elseif($activity->status === 'completed')
                                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                                    @else
                                    <span class="inline-block w-3 h-3 bg-slate-300 rounded-full"></span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $activity->title }}</h3>
                                    <p class="text-sm text-slate-600 mt-1">
                                        <span class="text-slate-400">Student:</span>
                                        <span class="font-medium text-slate-800">{{ $activity->student?->name ?? 'Unknown' }}</span>
                                    </p>
                                    <p class="text-xs text-slate-500 mt-2">{{ $activity->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Right Column --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Profile Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="h-24 bg-gradient-to-r from-slate-800 to-slate-900"></div>
                <div class="px-6 py-6 text-center -mt-12 relative z-10">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl bg-white border border-slate-200 flex items-center justify-center shadow-sm">
                        <span class="text-tangerine-600 font-bold text-3xl">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-slate-600 mt-1">{{ $faculty->position ?? 'Faculty Member' }}</p>
                    @if($faculty->department)
                    <p class="text-xs text-slate-500 mt-2">{{ $faculty->department->name }}</p>
                    @endif
                    @if($faculty->is_advisor)
                    <div class="mt-4 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-green-50 text-green-700 border border-green-200">
                        Active Advisor
                    </div>
                    @endif
                </div>
                <div class="border-t border-slate-100 px-6 py-4 space-y-3 bg-slate-50 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Email</span>
                        <span class="text-slate-900 font-medium truncate ml-4">{{ auth()->user()->email }}</span>
                    </div>
                    @if($faculty->phone_number)
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Phone</span>
                        <span class="text-slate-900 font-medium">{{ $faculty->phone_number }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            {{-- Quick Stats (Advisors) --}}
            @if($faculty->is_advisor)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide mb-4">Quick Stats</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-500">This Month</span>
                            <span class="font-medium text-slate-900">{{ $completedThisMonth }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-tangerine-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-500">Pending</span>
                            <span class="font-medium text-slate-900">{{ $pendingConsultations }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-slate-400 h-2 rounded-full flex-shrink" style="width: {{ $pendingConsultations > 0 ? '100%' : '0%' }}"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
@endsection