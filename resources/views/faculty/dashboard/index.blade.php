@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Faculty Dashboard</h1>
                    <p class="mt-2 text-gray-600">Welcome back, {{ $faculty->full_name }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profile
                    </a>
                    @if($faculty->is_advisor)
                        <a href="{{ route('faculty.advisor-profile.show') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Advisor Settings
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Profile Status</dt>
                            <dd class="text-lg font-medium text-gray-900">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            @if($faculty->is_advisor)
                <!-- Pending Requests -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Requests</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $pendingConsultations }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Consultations -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Upcoming (7 days)</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $upcomingConsultations->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Completed This Month -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Completed (This Month)</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $completedThisMonth }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Quick Actions -->
                @if($faculty->is_advisor)
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
                    </div>
                    <div class="px-6 py-6 grid grid-cols-2 gap-4">
                        <a href="#pending" class="flex items-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium text-gray-700">View Pending</span>
                        </a>
                        <a href="#upcoming" class="flex items-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="font-medium text-gray-700">View Calendar</span>
                        </a>
                    </div>
                </div>

                <!-- Upcoming Consultations List -->
                @if($upcomingConsultations->isNotEmpty())
                <div class="bg-white rounded-lg shadow" id="upcoming">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Upcoming Consultations (Next 7 Days)</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($upcomingConsultations as $consultation)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $consultation->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">Student: {{ $consultation->student->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ $consultation->consultation_date->format('M d, Y - h:i A') }}</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Scheduled
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6" id="upcoming">
                    <div class="flex">
                        <svg class="h-5 w-5 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-blue-700">No upcoming consultations in the next 7 days.</p>
                    </div>
                </div>
                @endif
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Profile Info -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="text-center">
                        @if($faculty->getPhotoUrl())
                        <img src="{{ $faculty->getPhotoUrl() }}" alt="{{ $faculty->full_name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        @else
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900">{{ $faculty->full_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $faculty->position }}</p>
                        <p class="text-xs text-gray-500 mt-2">{{ $faculty->department?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('faculty.profile.edit') }}" class="block w-full text-center px-4 py-2 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @forelse($recentActivity->take(5) as $activity)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 rounded-full bg-blue-600 mt-2"></div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    @if($activity->status === 'pending')
                                        New consultation request
                                    @elseif($activity->status === 'approved')
                                        Consultation approved
                                    @elseif($activity->status === 'completed')
                                        Consultation completed
                                    @else
                                        {{ ucfirst($activity->status) }}
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">No recent activity</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
