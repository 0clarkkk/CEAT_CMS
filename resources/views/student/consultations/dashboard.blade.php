@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Consultation Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your consultation requests with faculty advisors</p>
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
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pending</dt>
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
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Scheduled</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $stats['scheduled'] }}</dd>
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

        <!-- Quick Action Cards -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Request Consultation Card -->
            <a href="{{ route('student.consultations.create') }}" class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold mb-2">Request Consultation</h3>
                        <p class="text-indigo-100 text-sm">Submit a new consultation request to an advisor</p>
                    </div>
                    <svg class="h-12 w-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
            </a>

            <!-- Browse Advisors Card -->
            <a href="{{ route('student.consultations.browse-advisors') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold mb-2">Browse Advisors</h3>
                        <p class="text-purple-100 text-sm">View available advisors and their schedules</p>
                    </div>
                    <svg class="h-12 w-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"></path>
                    </svg>
                </div>
            </a>
        </div>

        <!-- Upcoming Consultations -->
        @if($upcomingConsultations->count() > 0)
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Upcoming Consultations</h2>
            <div class="grid grid-cols-1 gap-6">
                @foreach($upcomingConsultations as $consultation)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $consultation->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Advisor:</strong> {{ $consultation->advisor->name }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">
                                <strong>Scheduled:</strong> {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}
                            </p>
                            @if($consultation->location)
                            <p class="text-gray-600 dark:text-gray-400">
                                <strong>Location:</strong> {{ $consultation->location }}
                            </p>
                            @endif
                            <p class="text-gray-600 dark:text-gray-400">
                                <strong>Category:</strong> <span class="capitalize">{{ $consultation->category }}</span>
                            </p>
                        </div>
                        <div class="ml-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100">
                                Scheduled
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('student.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View Details</a>
                        <button onclick="if(confirm('Cancel this consultation?')) { document.getElementById('cancel-form-{{ $consultation->id }}').submit(); }" class="text-red-600 hover:text-red-700 text-sm font-medium">Cancel</button>
                        <form id="cancel-form-{{ $consultation->id }}" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recent Consultations -->
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Recent Consultations</h2>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Advisor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($consultations as $consultation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $consultation->advisor->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                <span class="capitalize">{{ $consultation->category }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @switch($consultation->status)
                                    @case('pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100">Pending</span>
                                        @break
                                    @case('approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100">Approved</span>
                                        @break
                                    @case('scheduled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100">Scheduled</span>
                                        @break
                                    @case('completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-100">Completed</span>
                                        @break
                                    @case('rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100">Rejected</span>
                                        @break
                                    @case('cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">Cancelled</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $consultation->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('student.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No consultations yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($consultations->hasPages())
            <div class="mt-4">
                {{ $consultations->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
