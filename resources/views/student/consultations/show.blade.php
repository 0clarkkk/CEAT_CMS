@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Navigation -->
        <div class="mb-8">
            <a href="{{ route('student.consultations.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to My Consultations
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 via-indigo-600 to-purple-600">
                        <h1 class="text-3xl font-bold text-white">{{ $consultation->title }}</h1>
                        <p class="text-indigo-100 text-sm mt-2 max-w-2xl">{{ $consultation->description }}</p>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Consultation Information</h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Basic Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 6a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-blue-900 dark:text-blue-200 uppercase">Category</p>
                                </div>
                                <p class="text-lg font-semibold text-blue-900 dark:text-blue-100 capitalize">{{ $consultation->category }}</p>
                            </div>

                            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-purple-900 dark:text-purple-200 uppercase">Advisor</p>
                                </div>
                                <p class="text-lg font-semibold text-purple-900 dark:text-purple-100">{{ $consultation->advisor->name }}</p>
                            </div>

                            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-green-900 dark:text-green-200 uppercase">Requested</p>
                                </div>
                                <p class="text-lg font-semibold text-green-900 dark:text-green-100">{{ $consultation->created_at->format('M d, Y') }}</p>
                                <p class="text-sm text-green-700 dark:text-green-300 mt-1">{{ $consultation->created_at->format('h:i A') }}</p>
                            </div>

                            @if($consultation->scheduled_at)
                            <div class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-orange-900 dark:text-orange-200 uppercase">Scheduled</p>
                                </div>
                                <p class="text-lg font-semibold text-orange-900 dark:text-orange-100">{{ $consultation->scheduled_at->format('M d, Y') }}</p>
                                <p class="text-sm text-orange-700 dark:text-orange-300 mt-1">{{ $consultation->scheduled_at->format('h:i A') }}</p>
                            </div>
                            @endif

                            @if($consultation->location)
                            <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800 md:col-span-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-red-900 dark:text-red-200 uppercase">Location</p>
                                </div>
                                <p class="text-lg font-semibold text-red-900 dark:text-red-100">{{ $consultation->location }}</p>
                            </div>
                            @endif
                        </div>

                        @if($consultation->notes)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Your Notes</h3>
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">{{ $consultation->notes }}</p>
                        </div>
                        @endif

                        @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <h3 class="font-semibold text-red-900 dark:text-red-200 mb-3">Reason for Rejection</h3>
                            <p class="text-red-800 dark:text-red-200 whitespace-pre-wrap mb-3">{{ $consultation->rejection_reason }}</p>
                            <p class="text-xs text-red-700 dark:text-red-300">Rejected on {{ $consultation->rejected_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Status Timeline</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-500">
                                        <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="w-0.5 h-12 bg-gray-300 dark:bg-gray-600 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-gray-900 dark:text-white">Consultation Requested</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $consultation->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if(in_array($consultation->status, ['approved', 'scheduled', 'completed'])) bg-green-500 @else bg-gray-300 dark:bg-gray-600 @endif">
                                        @if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))
                                        <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="w-0.5 h-12 bg-gray-300 dark:bg-gray-600 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-gray-900 dark:text-white">Request Approval</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">@if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))Approved @elseif($consultation->status === 'rejected')Rejected @else Pending review @endif</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if(in_array($consultation->status, ['scheduled', 'completed'])) bg-green-500 @else bg-gray-300 dark:bg-gray-600 @endif">
                                        @if(in_array($consultation->status, ['scheduled', 'completed']))
                                        <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="w-0.5 h-12 bg-gray-300 dark:bg-gray-600 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-gray-900 dark:text-white">Consultation Scheduled</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">@if($consultation->scheduled_at){{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}@else Awaiting scheduler @endif</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if($consultation->status === 'completed') bg-green-500 @else bg-gray-300 dark:bg-gray-600 @endif">
                                        @if($consultation->status === 'completed')
                                        <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-gray-900 dark:text-white">Consultation Completed</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">@if($consultation->status === 'completed')Completed @else Pending @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Current Status</h3>
                    <div class="p-4 rounded-lg @switch($consultation->status)
                        @case('pending')
                            bg-yellow-50 dark:bg-yellow-900/20
                            @break
                        @case('approved')
                            bg-blue-50 dark:bg-blue-900/20
                            @break
                        @case('scheduled')
                            bg-green-50 dark:bg-green-900/20
                            @break
                        @case('completed')
                            bg-purple-50 dark:bg-purple-900/20
                            @break
                        @case('rejected')
                            bg-red-50 dark:bg-red-900/20
                            @break
                    @endswitch">
                        <p class="text-xs font-bold uppercase tracking-wide @switch($consultation->status)
                            @case('pending')
                                text-yellow-700 dark:text-yellow-300
                                @break
                            @case('approved')
                                text-blue-700 dark:text-blue-300
                                @break
                            @case('scheduled')
                                text-green-700 dark:text-green-300
                                @break
                            @case('completed')
                                text-purple-700 dark:text-purple-300
                                @break
                            @case('rejected')
                                text-red-700 dark:text-red-300
                                @break
                        @endswitch">{{ ucfirst($consultation->status) }}</p>
                        <p class="text-sm font-medium @switch($consultation->status)
                            @case('pending')
                                text-yellow-900 dark:text-yellow-100
                                @break
                            @case('approved')
                                text-blue-900 dark:text-blue-100
                                @break
                            @case('scheduled')
                                text-green-900 dark:text-green-100
                                @break
                            @case('completed')
                                text-purple-900 dark:text-purple-100
                                @break
                            @case('rejected')
                                text-red-900 dark:text-red-100
                                @break
                        @endswitch mt-2">
                            @switch($consultation->status)
                                @case('pending')
                                    Being reviewed
                                    @break
                                @case('approved')
                                    Ready to schedule
                                    @break
                                @case('scheduled')
                                    Scheduled
                                    @break
                                @case('completed')
                                    Completed
                                    @break
                                @case('rejected')
                                    Rejected
                                    @break
                            @endswitch
                        </p>
                    </div>
                </div>

                @if($consultation->canBeCancelled())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
                    <button onclick="if(confirm('Are you sure you want to cancel this consultation?')) { document.getElementById('cancel-form').submit(); }" class="w-full px-4 py-3 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border-2 border-red-300 dark:border-red-700 rounded-lg font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-all">
                        <svg class="h-4 w-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Cancel Consultation
                    </button>
                    <form id="cancel-form" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
                @endif

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Advisor</h3>
                    <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-700">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $consultation->advisor->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $consultation->advisor->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
