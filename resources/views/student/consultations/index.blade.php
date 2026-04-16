@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Consultations</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">View all your consultation requests</p>
                </div>
                <a href="{{ route('student.consultations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Request
                </a>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-8" aria-label="Tabs">
                <a href="{{ route('student.consultations.index') }}" class="@if(!$selectedStatus) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    All
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'pending']) }}" class="@if($selectedStatus === 'pending') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Pending
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'approved']) }}" class="@if($selectedStatus === 'approved') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Approved
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'scheduled']) }}" class="@if($selectedStatus === 'scheduled') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Scheduled
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'completed']) }}" class="@if($selectedStatus === 'completed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
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
                        <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">{{ $consultation->description }}</p>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Advisor</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->advisor->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $consultation->category }}</p>
                            </div>
                            @if($consultation->scheduled_at)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Scheduled</p>
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

                @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                    <p class="text-sm font-medium text-red-800 dark:text-red-200">Rejection Reason:</p>
                    <p class="text-sm text-red-700 dark:text-red-300 mt-1">{{ $consultation->rejection_reason }}</p>
                </div>
                @endif

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('student.consultations.show', $consultation->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        View Details
                    </a>
                    @if($consultation->canBeCancelled())
                    <button onclick="if(confirm('Are you sure you want to cancel this consultation?')) { document.getElementById('cancel-form-{{ $consultation->id }}').submit(); }" class="inline-flex items-center px-3 py-2 border border-red-300 dark:border-red-600 rounded-md text-sm font-medium text-red-700 dark:text-red-300 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20">
                        Cancel
                    </button>
                    <form id="cancel-form-{{ $consultation->id }}" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No consultations</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Start by requesting a consultation with a faculty advisor.</p>
                <div class="mt-6">
                    <a href="{{ route('student.consultations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Request Consultation
                    </a>
                </div>
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
