@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen" style="margin-top: 2rem;">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Navigation -->
        <div class="mb-8">
            <a href="{{ route('student.consultations.index') }}"
                class="inline-flex items-center text-tangerine-600 hover:text-tangerine-700 text-sm font-medium mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z"
                        clip-rule="evenodd" />
                </svg>
                Back to My Consultations
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden relative">
                    <!-- Accent bar -->
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-tangerine-400 to-tangerine-600"></div>
                    <div class="px-6 py-6 pb-5 mt-1">
                        <h1 class="text-3xl font-bold text-slate-900">{{ $consultation->title }}</h1>
                        <p class="text-slate-600 text-sm mt-3 max-w-2xl leading-relaxed">{{ $consultation->description }}</p>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h2 class="text-lg font-bold text-slate-900">Consultation Information</h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Basic Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500 uppercase">Category</p>
                                </div>
                                <p class="text-lg font-semibold text-slate-800 capitalize">{{ $consultation->category }}</p>
                            </div>

                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500 uppercase">Advisor</p>
                                </div>
                                <p class="text-lg font-semibold text-slate-800">{{ $consultation->advisor->name }}</p>
                            </div>

                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500 uppercase">Requested</p>
                                </div>
                                <p class="text-lg font-semibold text-slate-800">{{ $consultation->created_at->format('M d, Y') }}</p>
                                <p class="text-sm text-slate-500 mt-1">{{ $consultation->created_at->format('h:i A') }}</p>
                            </div>

                            @if($consultation->scheduled_at)
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500 uppercase">Scheduled</p>
                                </div>
                                <p class="text-lg font-semibold text-slate-800">{{ $consultation->scheduled_at->format('M d, Y') }}</p>
                                <p class="text-sm text-slate-500 mt-1">{{ $consultation->scheduled_at->format('h:i A') }}</p>
                            </div>
                            @endif

                            @if($consultation->location)
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 md:col-span-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500 uppercase">Location</p>
                                </div>
                                <p class="text-lg font-semibold text-slate-800">{{ $consultation->location }}</p>
                            </div>
                            @endif
                        </div>

                        @if($consultation->notes)
                        <div class="pt-6 border-t border-slate-200">
                            <h3 class="font-semibold text-slate-900 mb-3">Your Notes</h3>
                            <p class="text-slate-700 whitespace-pre-wrap bg-slate-50 p-4 rounded-lg border border-slate-100">{{ $consultation->notes }}</p>
                        </div>
                        @endif

                        @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                        <div class="pt-6 border-t border-slate-200 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <h3 class="font-semibold text-red-800 mb-3">Reason for Rejection</h3>
                            <p class="text-red-700 whitespace-pre-wrap mb-3 text-sm">{{ $consultation->rejection_reason }}</p>
                            <p class="text-xs text-red-600">Rejected on {{ $consultation->rejected_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden relative">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h2 class="text-lg font-bold text-slate-900">Status Timeline</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Requested -->
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-tangerine-500">
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="w-0.5 h-12 bg-slate-200 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-slate-900">Consultation Requested</p>
                                    <p class="text-sm text-slate-500">{{ $consultation->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>

                            <!-- Approved -->
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if(in_array($consultation->status, ['approved', 'scheduled', 'completed'])) bg-tangerine-500 @else bg-slate-200 @endif border-2 border-white">
                                        @if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="w-0.5 h-12 bg-slate-200 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-slate-900">Request Approval</p>
                                    <p class="text-sm text-slate-500">@if(in_array($consultation->status, ['approved', 'scheduled', 'completed']))Approved @elseif($consultation->status === 'rejected')Rejected @else Pending review @endif</p>
                                </div>
                            </div>

                            <!-- Scheduled -->
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if(in_array($consultation->status, ['scheduled', 'completed'])) bg-tangerine-500 @else bg-slate-200 @endif border-2 border-white">
                                        @if(in_array($consultation->status, ['scheduled', 'completed']))
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="w-0.5 h-12 bg-slate-200 mt-2"></div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-slate-900">Consultation Scheduled</p>
                                    <p class="text-sm text-slate-500">@if($consultation->scheduled_at){{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}@else Awaiting scheduler @endif</p>
                                </div>
                            </div>

                            <!-- Completed -->
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full @if($consultation->status === 'completed') bg-tangerine-500 @else bg-slate-200 @endif border-2 border-white">
                                        @if($consultation->status === 'completed')
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="font-semibold text-slate-900">Consultation Completed</p>
                                    <p class="text-sm text-slate-500">@if($consultation->status === 'completed')Completed @else Pending @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6 relative overflow-hidden">
                    <h3 class="font-semibold text-slate-900 mb-4">Current Status</h3>

                    {{-- Neutral or lightly tinted background for status --}}
                    <div class="p-4 rounded-lg relative overflow-hidden border @if($consultation->status === 'completed') bg-green-50 border-green-100 @elseif($consultation->status === 'rejected') bg-red-50 border-red-100 @else bg-slate-50 border-slate-100 @endif">
                        <p class="text-xs font-bold uppercase tracking-wider @switch($consultation->status)
                            @case('completed') text-green-700 @break
                            @case('rejected') text-red-700 @break
                            @default text-tangerine-600
                        @endswitch">
                            {{ ucfirst($consultation->status) }}
                        </p>
                        <p class="text-sm font-medium mt-1 text-slate-700">
                            @switch($consultation->status)
                            @case('pending')
                                Being reviewed by faculty
                                @break
                            @case('approved')
                                Ready to schedule
                                @break
                            @case('scheduled')
                                Your meeting is locked in
                                @break
                            @case('completed')
                                Meeting concluded successfully
                                @break
                            @case('rejected')
                                Request was declined
                                @break
                            @endswitch
                        </p>
                    </div>
                </div>

                <!-- Advisor Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4">Advisor assigned</h3>
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-slate-100 rounded-full flex items-center justify-center text-tangerine-600 font-bold border border-slate-200 shadow-sm">
                            {{ strtoupper(substr($consultation->advisor->name, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-900">{{ $consultation->advisor->name }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $consultation->advisor->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                @if($consultation->canBeCancelled())
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4">Actions</h3>
                    <button onclick="if(confirm('Are you sure you want to cancel this consultation?')) { document.getElementById('cancel-form').submit(); }"
                        class="w-full px-4 py-2.5 bg-white border-2 border-red-200 text-red-600 rounded-lg text-sm font-bold hover:bg-red-50 active:scale-[0.98] transition-all">
                        Cancel Consultation
                    </button>
                    <form id="cancel-form" action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection