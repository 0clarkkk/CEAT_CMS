@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-1 bg-gradient-to-b from-indigo-500 to-indigo-600 rounded-full"></div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">My Consultations</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your consultation requests and scheduled appointments</p>
                    </div>
                </div>
                <a href="{{ route('student.consultations.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Request
                </a>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-8 bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
            <nav class="flex flex-wrap md:flex-nowrap" aria-label="Tabs">
                <a href="{{ route('student.consultations.index') }}" class="flex-1 px-4 py-4 text-center @if(!$selectedStatus) border-b-4 border-indigo-500 text-indigo-600 dark:text-indigo-400 font-semibold @else border-b-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 @endif transition-all">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"></path></svg>
                        All
                    </span>
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'pending']) }}" class="flex-1 px-4 py-4 text-center @if($selectedStatus === 'pending') border-b-4 border-yellow-500 text-yellow-600 dark:text-yellow-400 font-semibold @else border-b-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 @endif transition-all">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Pending
                    </span>
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'approved']) }}" class="flex-1 px-4 py-4 text-center @if($selectedStatus === 'approved') border-b-4 border-blue-500 text-blue-600 dark:text-blue-400 font-semibold @else border-b-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 @endif transition-all">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Approved
                    </span>
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'scheduled']) }}" class="flex-1 px-4 py-4 text-center @if($selectedStatus === 'scheduled') border-b-4 border-green-500 text-green-600 dark:text-green-400 font-semibold @else border-b-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 @endif transition-all">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path></svg>
                        Scheduled
                    </span>
                </a>
                <a href="{{ route('student.consultations.index', ['status' => 'completed']) }}" class="flex-1 px-4 py-4 text-center @if($selectedStatus === 'completed') border-b-4 border-purple-500 text-purple-600 dark:text-purple-400 font-semibold @else border-b-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 @endif transition-all">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm9.172 6a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L16 9.586l-1.828-1.828z" clip-rule="evenodd"></path></svg>
                        Completed
                    </span>
                </a>
            </nav>
        </div>

        <!-- Consultations List -->
        <div class="space-y-4">
            @forelse($consultations as $consultation)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start gap-4">
                        <!-- Left Section -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-3">
                                <!-- Status Badge -->
                                <div class="flex-shrink-0 mt-1">
                                    <span class="inline-flex items-center justify-center h-2.5 w-2.5 rounded-full
                                        @switch($consultation->status)
                                            @case('pending')
                                                bg-yellow-500
                                                @break
                                            @case('approved')
                                                bg-blue-500
                                                @break
                                            @case('scheduled')
                                                bg-green-500
                                                @break
                                            @case('completed')
                                                bg-purple-500
                                                @break
                                            @case('rejected')
                                                bg-red-500
                                                @break
                                            @default
                                                bg-gray-500
                                        @endswitch
                                    "></span>
                                </div>
                                <!-- Title and Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-3 flex-wrap">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $consultation->title }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                            @switch($consultation->status)
                                                @case('pending')
                                                    bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200
                                                    @break
                                                @case('approved')
                                                    bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200
                                                    @break
                                                @case('scheduled')
                                                    bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200
                                                    @break
                                                @case('completed')
                                                    bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200
                                                    @break
                                                @case('rejected')
                                                    bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200
                                                    @break
                                                @default
                                                    bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                            @endswitch
                                        ">
                                            {{ ucfirst($consultation->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">{{ $consultation->description }}</p>
                                </div>
                            </div>

                            <!-- Details Grid -->
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Advisor</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->advisor->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 6a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5z"></path></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Category</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $consultation->category }}</p>
                                    </div>
                                </div>
                                @if($consultation->scheduled_at)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Scheduled</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($consultation->location)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $consultation->location }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Rejection Reason -->
                            @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                            <div class="mt-4 p-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded">
                                <p class="text-xs font-semibold text-red-800 dark:text-red-200">Rejection Reason:</p>
                                <p class="text-sm text-red-700 dark:text-red-300 mt-1">{{ $consultation->rejection_reason }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2 ml-4">
                            <a href="{{ route('student.consultations.show', $consultation->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 rounded-lg font-medium hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-all whitespace-nowrap">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                View
                            </a>
                            @if($consultation->canBeCancelled())
                            <button onclick="if(confirm('Are you sure you want to cancel this consultation?')) { document.getElementById('cancel-form-{{ $consultation->id }}').submit(); }" class="inline-flex items-center justify-center px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg font-medium hover:bg-red-100 dark:hover:bg-red-900/40 transition-all whitespace-nowrap">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Cancel
                            </button>
                            <form id="cancel-form-{{ $consultation->id }}" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                                @csrf
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-12 text-center">
                <div class="flex justify-center mb-4">
                    <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-full">
                        <svg class="h-12 w-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">No consultations found</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">You haven't requested any consultations yet.</p>
                <div class="mt-6">
                    <a href="{{ route('student.consultations.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Request Your First Consultation
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($consultations->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $consultations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
