@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Consultation Requests</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Review and manage all consultation requests</p>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-8 overflow-x-auto" aria-label="Tabs">
                <a href="{{ route('advisor.consultations.index') }}"
                    class="@if(!$selectedStatus) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    All
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'pending']) }}"
                    class="@if($selectedStatus === 'pending') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Pending
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'approved']) }}"
                    class="@if($selectedStatus === 'approved') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Approved
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'scheduled']) }}"
                    class="@if($selectedStatus === 'scheduled') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Scheduled
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'completed']) }}"
                    class="@if($selectedStatus === 'completed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Completed
                </a>
            </nav>
        </div>

        <!-- Consultations List -->
        <div class="space-y-6">
            @forelse($consultations as $consultation)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $consultation->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">{{ $consultation->description }}
                        </p>

                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Student</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                    $consultation->student->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{
                                    $consultation->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Requested</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                    $consultation->created_at->format('M d, Y') }}</p>
                            </div>
                            @if($consultation->scheduled_at)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Scheduled</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                    $consultation->scheduled_at->format('M d, Y h:i A') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
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
                </div>

                <!-- Actions -->
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('advisor.consultations.show', $consultation->id) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        View Details
                    </a>

                    @if($consultation->isPending())
                    <form action="{{ route('advisor.consultations.approve', $consultation->id) }}" method="POST"
                        class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve
                        </button>
                    </form>
                    <a href="{{ route('advisor.consultations.reject-form', $consultation->id) }}"
                        class="inline-flex items-center px-3 py-2 border border-red-300 dark:border-red-600 rounded-md text-sm font-medium text-red-700 dark:text-red-300 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reject
                    </a>
                    @elseif($consultation->isApproved())
                    <a href="{{ route('advisor.consultations.schedule-form', $consultation->id) }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Schedule
                    </a>
                    @elseif($consultation->isScheduled())
                    <a href="{{ route('advisor.consultations.reschedule-form', $consultation->id) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reschedule
                    </a>
                    <form action="{{ route('advisor.consultations.complete', $consultation->id) }}" method="POST"
                        class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Complete
                        </button>
                    </form>
                    @endif

                    @if($consultation->canBeCancelled())
                    <form action="{{ route('advisor.consultations.cancel', $consultation->id) }}" method="POST"
                        class="inline" onsubmit="return confirm('Cancel this consultation?');">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No consultations</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No consultations found for the selected status.
                </p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($consultations->hasPages())
        <div class="mt-8">
            {{ $consultations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection