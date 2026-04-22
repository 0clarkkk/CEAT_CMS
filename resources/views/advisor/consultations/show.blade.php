@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-start">
            <div>
                <a href="{{ route('advisor.consultations.index') }}"
                    class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">← Back to Requests</a>
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
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Request Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Student Name</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->student->name
                                }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Student Email</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                $consultation->student->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{
                                $consultation->category }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Requested on</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                $consultation->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @if($consultation->scheduled_at)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Scheduled For</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @endif
                        @if($consultation->location)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->location }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Request Description</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{
                        $consultation->description }}</p>
                </div>

                <!-- Notes -->
                @if($consultation->notes)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Student Notes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $consultation->notes }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
            <div class="flex flex-wrap gap-4">
                @if($consultation->isPending())
                <form action="{{ route('advisor.consultations.approve', $consultation->id) }}" method="POST"
                    class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Approve Request
                    </button>
                </form>

                <a href="{{ route('advisor.consultations.reject-form', $consultation->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 text-base font-medium rounded-md text-red-700 dark:text-red-300 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Reject Request
                </a>

                @elseif($consultation->isApproved())
                <a href="{{ route('advisor.consultations.schedule-form', $consultation->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Schedule Consultation
                </a>

                @elseif($consultation->isScheduled())
                <a href="{{ route('advisor.consultations.reschedule-form', $consultation->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Reschedule
                </a>

                <form action="{{ route('advisor.consultations.complete', $consultation->id) }}" method="POST"
                    class="inline" onsubmit="return confirm('Mark this consultation as completed?');">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mark Complete
                    </button>
                </form>
                @endif

                @if($consultation->canBeCancelled())
                <form action="{{ route('advisor.consultations.cancel', $consultation->id) }}" method="POST"
                    class="inline" onsubmit="return confirm('Are you sure you want to cancel this consultation?');">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection