@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Advisor Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Manage consultation requests and availability</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Requests</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $stats['total_requests'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pending Approval</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $stats['pending'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Upcoming</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $stats['upcoming'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Completed</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $stats['completed'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('advisor.consultations.availability.create') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Availability</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Create new time slots</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('advisor.consultations.availability.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Availability</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">View & edit your slots</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('advisor.consultations.index', ['status' => 'pending']) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pending Requests</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Review & approve</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pending Consultations -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Pending Requests</h2>
                @if($pendingConsultations->count() > 0)
                <div class="space-y-4">
                    @foreach($pendingConsultations as $consultation)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $consultation->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">From: {{ $consultation->student->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Category: <span class="capitalize">{{ $consultation->category }}</span></p>
                        <div class="mt-3">
                            <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">Review Request →</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 dark:text-gray-400">No pending requests</p>
                @endif
            </div>

            <!-- Upcoming Consultations -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Upcoming Consultations</h2>
                @if($upcomingConsultations->count() > 0)
                <div class="space-y-4">
                    @foreach($upcomingConsultations as $consultation)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $consultation->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Student: {{ $consultation->student->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Scheduled: {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}</p>
                        <div class="mt-3">
                            <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 dark:text-gray-400">No upcoming consultations</p>
                @endif
            </div>

            <!-- Today's Slots -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Today's Availability</h2>
                @if($todaySlots->count() > 0)
                <div class="space-y-3">
                    @foreach($todaySlots as $slot)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $slot->start_time->format('h:i A') }} - {{ $slot->end_time->format('h:i A') }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="capitalize inline-block px-2 py-1 rounded text-xs font-medium
                                    @if($slot->status === 'available')
                                        bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100
                                    @elseif($slot->status === 'booked')
                                        bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100
                                    @else
                                        bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100
                                    @endif
                                ">
                                    {{ $slot->status }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 dark:text-gray-400">No slots scheduled for today</p>
                @endif
            </div>

            <!-- Statistics Summary -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Summary</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Approved</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $stats['approved'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Scheduled</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $stats['scheduled'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Rejected</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $stats['rejected'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Cancelled</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $stats['cancelled'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
