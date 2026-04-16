@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-start">
            <div>
                <a href="{{ route('student.consultations.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">← Back to Consultations</a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $consultation->title }}</h1>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @switch($consultation->status)
                    @case('pending')
                        bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100
                        @break
                    @case('approved')
                        bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100
                        @break
                    @case('scheduled')
                        bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100
                        @break
                    @case('completed')
                        bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-100
                        @break
                    @case('rejected')
                        bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100
                        @break
                    @case('cancelled')
                        bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100
                        @break
                @endswitch
            ">
                {{ ucfirst($consultation->status) }}
            </span>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
            <!-- Consultation Details -->
            <div class="space-y-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Consultation Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $consultation->category }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Faculty Advisor</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->advisor->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Requested on</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @if($consultation->scheduled_at)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Scheduled For</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @endif
                        @if($consultation->location)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->location }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $consultation->description }}</p>
                </div>

                <!-- Notes -->
                @if($consultation->notes)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Your Notes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $consultation->notes }}</p>
                </div>
                @endif

                <!-- Rejection Reason -->
                @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                    <h3 class="text-sm font-semibold text-red-800 dark:text-red-200">Reason for Rejection</h3>
                    <p class="text-sm text-red-700 dark:text-red-300 mt-2 whitespace-pre-wrap">{{ $consultation->rejection_reason }}</p>
                    <p class="text-xs text-red-600 dark:text-red-400 mt-2">
                        Rejected on {{ $consultation->rejected_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        @if($consultation->canBeCancelled())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
            <button onclick="if(confirm('Are you sure you want to cancel this consultation? This action cannot be undone.')) { document.getElementById('cancel-form').submit(); }" class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 rounded-md text-sm font-medium text-red-700 dark:text-red-300 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Cancel Consultation
            </button>
            <form id="cancel-form" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
        @endif

        <!-- Status Timeline -->
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Timeline</h3>
            <div class="space-y-4">
                <!-- Requested -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-600">
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Consultation Requested</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $consultation->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Approved -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full @if(in_array($consultation->status, ['approved', 'scheduled', 'completed'])) bg-green-600 @else bg-gray-300 @endif">
                            @if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Request Approved</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            @if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))
                                Approved
                            @elseif($consultation->status === 'rejected')
                                Rejected
                            @else
                                Pending approval
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Scheduled -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full @if(in_array($consultation->status, ['scheduled', 'completed'])) bg-green-600 @else bg-gray-300 @endif">
                            @if(in_array($consultation->status, ['scheduled', 'completed']))
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Consultation Scheduled</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            @if($consultation->scheduled_at)
                                {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}
                            @else
                                Awaiting scheduler
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Completed -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full @if($consultation->status === 'completed') bg-green-600 @else bg-gray-300 @endif">
                            @if($consultation->status === 'completed')
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Consultation Completed</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            @if($consultation->status === 'completed')
                                Completed
                            @else
                                Not yet completed
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
