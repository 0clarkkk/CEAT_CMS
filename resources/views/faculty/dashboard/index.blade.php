@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Faculty Dashboard</h1>
                    <p class="mt-2 text-sm text-gray-600">Welcome back, {{ auth()->user()->name }}! • {{ now()->format('l, F j, Y') }}</p>
                </div>
                <div class="flex gap-3">
                    @if($faculty && $faculty->is_advisor)
                        <a href="{{ route('advisor.consultations.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Consultation Hub
                        </a>
                    @endif
                    <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(!$faculty)
            <!-- No Faculty Member Setup -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="text-2xl font-semibold text-blue-900 mb-2">Profile Setup Required</h2>
                <p class="text-blue-700 mb-6">Your faculty profile hasn't been set up yet. Please complete your profile to access the full dashboard.</p>
                <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Complete Your Profile
                </a>
            </div>
        @else
            <!-- Statistics Cards - Only for Advisors -->
            @if($faculty->is_advisor)
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <!-- Pending Requests Card -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Pending Requests</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingConsultations }}</p>
                            <a href="{{ route('advisor.consultations.index') }}?status=pending" class="text-xs text-yellow-600 hover:text-yellow-700 mt-2 inline-flex items-center">
                                View All →
                            </a>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Consultations Card -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Upcoming (7 Days)</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $upcomingConsultations->count() }}</p>
                            <a href="{{ route('advisor.consultations.dashboard') }}" class="text-xs text-blue-600 hover:text-blue-700 mt-2 inline-flex items-center">
                                View Schedule →
                            </a>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed This Month Card -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Completed (This Month)</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completedThisMonth }}</p>
                            <p class="text-xs text-green-600 mt-2">{{ now()->format('F Y') }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Availability Card -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Manage Your Time</p>
                            <p class="text-sm text-gray-700 font-semibold mt-3">Set availability slots for students</p>
                            <a href="{{ route('advisor.consultations.availability.index') }}" class="text-xs text-purple-600 hover:text-purple-700 mt-2 inline-flex items-center">
                                Manage Slots →
                            </a>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    @if($faculty->is_advisor)
                        <!-- Upcoming Consultations List -->
                        <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                                <h2 class="text-lg font-semibold text-gray-900">Upcoming Consultations</h2>
                                <p class="text-sm text-gray-600 mt-1">Next 7 days • {{ $upcomingConsultations->count() }} scheduled</p>
                            </div>
                            @if($upcomingConsultations->isEmpty())
                                <div class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">No upcoming consultations</p>
                                    <p class="text-sm text-gray-500 mt-1">When students request consultations, they'll appear here</p>
                                </div>
                            @else
                                <div class="divide-y divide-gray-200">
                                    @foreach($upcomingConsultations as $consultation)
                                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h3 class="text-sm font-semibold text-gray-900">{{ $consultation->title }}</h3>
                                                    <div class="mt-2 space-y-1 text-sm">
                                                        <p class="text-gray-600">
                                                            <span class="font-medium">Student:</span> {{ $consultation->student?->name ?? 'N/A' }}
                                                        </p>
                                                        @if($consultation->category)
                                                            <p class="text-gray-600">
                                                                <span class="font-medium">Category:</span> 
                                                                <span class="capitalize">{{ $consultation->category }}</span>
                                                            </p>
                                                        @endif
                                                        <p class="text-gray-600">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            {{ $consultation->scheduled_at?->format('M d, Y \a\t h:i A') ?? 'Not scheduled' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ ucfirst($consultation->status) }}
                                                    </span>
                                                    <a href="{{ route('advisor.consultations.show', $consultation->id) }}" 
                                                       class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                                        View →
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                            <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                            <p class="text-sm text-gray-600 mt-1">Latest consultation updates</p>
                        </div>
                        @if($recentActivity->isEmpty())
                            <div class="px-6 py-12 text-center">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 font-medium">No recent activity</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-200">
                                @foreach($recentActivity->take(5) as $activity)
                                    <div class="px-6 py-4 hover:bg-gray-50 transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center">
                                                    @if($activity->status === 'pending')
                                                        <span class="inline-block w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>
                                                    @elseif($activity->status === 'approved')
                                                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                                    @elseif($activity->status === 'completed')
                                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                                    @else
                                                        <span class="inline-block w-2 h-2 bg-gray-400 rounded-full mr-3"></span>
                                                    @endif
                                                    <h3 class="text-sm font-medium text-gray-900">{{ $activity->title }}</h3>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Student: <span class="font-medium">{{ $activity->student?->name ?? 'Unknown' }}</span>
                                                </p>
                                                <p class="text-xs text-gray-500 mt-2">{{ $activity->updated_at->diffForHumans() }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst($activity->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-20"></div>
                        <div class="px-6 py-6 text-center -mt-10 relative z-10">
                            <div class="w-20 h-20 mx-auto mb-3 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $faculty->position ?? 'Faculty Member' }}</p>
                            @if($faculty->department)
                                <p class="text-xs text-gray-500 mt-1">{{ $faculty->department->name }}</p>
                            @endif
                            @if($faculty->is_advisor)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-3">
                                    ✓ Active Advisor
                                </span>
                            @endif
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4 space-y-2">
                            <div>
                                <p class="text-xs text-gray-500 font-medium">EMAIL</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->email }}</p>
                            </div>
                            @if($faculty->phone_number)
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">PHONE</p>
                                    <p class="text-sm text-gray-900">{{ $faculty->phone_number }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Links Card -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900">Quick Links</h3>
                        </div>
                        <div class="px-6 py-3 space-y-2">
                            <a href="{{ route('faculty.profile.edit') }}" 
                               class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit My Profile
                            </a>
                            <a href="{{ route('faculty.advisor-profile.show') }}" 
                               class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                View Advisor Profile
                            </a>
                            @if($faculty->is_advisor)
                                <a href="{{ route('advisor.consultations.availability.index') }}" 
                                   class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Manage Availability
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-indigo-200">
                            <h3 class="text-sm font-semibold text-gray-900">This Month</h3>
                        </div>
                        <div class="px-6 py-4 space-y-3">
                            @if($faculty->is_advisor)
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Total Consultations</p>
                                    <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $completedThisMonth }}</p>
                                </div>
                                <div class="pt-2 border-t border-indigo-200">
                                    <p class="text-xs text-gray-600">Completed in {{ now()->format('F Y') }}</p>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-600">Not an active advisor</p>
                                    <a href="{{ route('faculty.advisor-profile.edit') }}" class="text-xs text-indigo-600 hover:text-indigo-700 mt-2 inline-flex items-center">
                                        Enable Advisor Role →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Faculty Dashboard</h1>
                    <p class="mt-2 text-sm text-gray-600">Welcome back, {{ auth()->user()->name }}! • {{ now()->format('l, F j, Y') }}</p>
                </div>
                <div class="flex gap-3">
                    @if($faculty && $faculty->is_advisor)
                        <a href="{{ route('advisor.consultations.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Consultation Hub
                        </a>
                    @endif
                    <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(!$faculty)
            <!-- No Faculty Member Setup -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="text-2xl font-semibold text-blue-900 mb-2">Profile Setup Required</h2>
                <p class="text-blue-700 mb-6">Your faculty profile hasn't been set up yet. Please complete your profile to access the full dashboard.</p>
                <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Complete Your Profile
                </a>
            </div>
        @else
            <!-- Statistics Cards -->

        @if($faculty->is_advisor)
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Pending Requests Card -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingConsultations }}</p>
                        <a href="{{ route('advisor.consultations.index') }}?status=pending" class="text-xs text-yellow-600 hover:text-yellow-700 mt-2 inline-flex items-center">
                            View All →
                        </a>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upcoming Consultations Card -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Upcoming (7 Days)</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $upcomingConsultations->count() }}</p>
                        <a href="{{ route('advisor.consultations.dashboard') }}" class="text-xs text-blue-600 hover:text-blue-700 mt-2 inline-flex items-center">
                            View Schedule →
                        </a>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed This Month Card -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Completed (This Month)</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completedThisMonth }}</p>
                        <p class="text-xs text-green-600 mt-2">{{ now()->format('F Y') }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Availability Card -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Manage Your Time</p>
                        <p class="text-sm text-gray-700 font-semibold mt-3">Set availability slots for students to book consultations</p>
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="text-xs text-purple-600 hover:text-purple-700 mt-2 inline-flex items-center">
                            Manage Slots →
                        </a>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                @if($faculty->is_advisor)
                    <!-- Upcoming Consultations List -->
                    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <h2 class="text-lg font-semibold text-gray-900">Upcoming Consultations</h2>
                            <p class="text-sm text-gray-600 mt-1">Next 7 days • {{ $upcomingConsultations->count() }} scheduled</p>
                        </div>
                        @if($upcomingConsultations->isEmpty())
                            <div class="px-6 py-12 text-center">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 font-medium">No upcoming consultations</p>
                                <p class="text-sm text-gray-500 mt-1">When students request consultations, they'll appear here</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-200">
                                @foreach($upcomingConsultations as $consultation)
                                    <div class="px-6 py-4 hover:bg-gray-50 transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-sm font-semibold text-gray-900">{{ $consultation->title }}</h3>
                                                <div class="mt-2 space-y-1 text-sm">
                                                    <p class="text-gray-600">
                                                        <span class="font-medium">Student:</span> {{ $consultation->student?->name ?? 'N/A' }}
                                                    </p>
                                                    @if($consultation->category)
                                                        <p class="text-gray-600">
                                                            <span class="font-medium">Category:</span> 
                                                            <span class="capitalize">{{ $consultation->category }}</span>
                                                        </p>
                                                    @endif
                                                    <p class="text-gray-600">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $consultation->scheduled_at?->format('M d, Y \a\t h:i A') ?? 'Not scheduled' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ ucfirst($consultation->status) }}
                                                </span>
                                                <a href="{{ route('advisor.consultations.show', $consultation->id) }}" 
                                                   class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                                    View →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                        <p class="text-sm text-gray-600 mt-1">Latest consultation updates</p>
                    </div>
                    @if($recentActivity->isEmpty())
                        <div class="px-6 py-12 text-center">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">No recent activity</p>
                        </div>
                    @else
                        <div class="divide-y divide-gray-200">
                            @foreach($recentActivity->take(5) as $activity)
                                <div class="px-6 py-4 hover:bg-gray-50 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center">
                                                @if($activity->status === 'pending')
                                                    <span class="inline-block w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>
                                                @elseif($activity->status === 'approved')
                                                    <span class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                                @elseif($activity->status === 'completed')
                                                    <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                                @else
                                                    <span class="inline-block w-2 h-2 bg-gray-400 rounded-full mr-3"></span>
                                                @endif
                                                <h3 class="text-sm font-medium text-gray-900">{{ $activity->title }}</h3>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Student: <span class="font-medium">{{ $activity->student?->name ?? 'Unknown' }}</span>
                                            </p>
                                            <p class="text-xs text-gray-500 mt-2">{{ $activity->updated_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($activity->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-20"></div>
                    <div class="px-6 py-6 text-center -mt-10 relative z-10">
                        <div class="w-20 h-20 mx-auto mb-3 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $faculty->position ?? 'Faculty Member' }}</p>
                        @if($faculty->department)
                            <p class="text-xs text-gray-500 mt-1">{{ $faculty->department->name }}</p>
                        @endif
                        @if($faculty->is_advisor)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-3">
                                ✓ Active Advisor
                            </span>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4 space-y-2">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">EMAIL</p>
                            <p class="text-sm text-gray-900">{{ auth()->user()->email }}</p>
                        </div>
                        @if($faculty->phone_number)
                            <div>
                                <p class="text-xs text-gray-500 font-medium">PHONE</p>
                                <p class="text-sm text-gray-900">{{ $faculty->phone_number }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Links Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900">Quick Links</h3>
                    </div>
                    <div class="px-6 py-3 space-y-2">
                        <a href="{{ route('faculty.profile.edit') }}" 
                           class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit My Profile
                        </a>
                        <a href="{{ route('faculty.advisor-profile.show') }}" 
                           class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            View Advisor Profile
                        </a>
                        @if($faculty->is_advisor)
                            <a href="{{ route('advisor.consultations.availability.index') }}" 
                               class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Manage Availability
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-indigo-200">
                        <h3 class="text-sm font-semibold text-gray-900">This Month</h3>
                    </div>
                    <div class="px-6 py-4 space-y-3">
                        @if($faculty->is_advisor)
                            <div>
                                <p class="text-xs text-gray-600 font-medium">Total Consultations</p>
                                <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $completedThisMonth }}</p>
                            </div>
                            <div class="pt-2 border-t border-indigo-200">
                                <p class="text-xs text-gray-600">Completed in {{ now()->format('F Y') }}</p>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-600">Not an active advisor</p>
                                <a href="{{ route('faculty.advisor-profile.edit') }}" class="text-xs text-indigo-600 hover:text-indigo-700 mt-2 inline-flex items-center">
                                    Enable Advisor Role →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
