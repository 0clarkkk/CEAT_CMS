@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Consultation Details</h1>
                    <p class="mt-2 text-sm text-gray-600">View and manage this consultation request</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('faculty.consultations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Consultations
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Status Alert -->
        @if($consultation->status === 'rejected')
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-red-900">Consultation Rejected</h3>
                        <p class="text-red-700 mt-1">{{ $consultation->rejection_reason }}</p>
                        <p class="text-sm text-red-600 mt-2">Rejected on: {{ $consultation->rejected_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h2 class="text-lg font-semibold text-gray-900">Request Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Title</label>
                                <p class="mt-1 text-gray-900 text-lg font-medium">{{ $consultation->title }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Description</label>
                                <p class="mt-1 text-gray-700 whitespace-pre-wrap">{{ $consultation->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Category</label>
                                    <p class="mt-1 text-gray-900 capitalize">{{ $consultation->category ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            @if($consultation->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($consultation->status === 'approved') bg-blue-100 text-blue-800
                                            @elseif($consultation->status === 'scheduled') bg-green-100 text-green-800
                                            @elseif($consultation->status === 'completed') bg-emerald-100 text-emerald-800
                                            @elseif($consultation->status === 'rejected') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($consultation->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Location</label>
                                <p class="mt-1 text-gray-900">{{ $consultation->location ?? 'Not specified' }}</p>
                            </div>

                            @if($consultation->scheduled_at)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Scheduled Date & Time</label>
                                    <p class="mt-1 text-gray-900 text-lg font-medium">{{ $consultation->scheduled_at->format('l, F d, Y \a\t h:i A') }}</p>
                                </div>
                            @endif

                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-xs text-gray-500">
                                    <strong>Created:</strong> {{ $consultation->created_at->format('M d, Y h:i A') }}<br>
                                    <strong>Last Updated:</strong> {{ $consultation->updated_at->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Information -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <h2 class="text-lg font-semibold text-gray-900">Student Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Name</label>
                                <p class="mt-1 text-gray-900 text-lg">{{ $consultation->student?->name ?? 'N/A' }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Email</label>
                                    <p class="mt-1 text-gray-900">{{ $consultation->student?->email ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Student ID</label>
                                    <p class="mt-1 text-gray-900">{{ $consultation->student?->student_id ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="lg:col-span-1">
                <!-- Action Buttons -->
                @if($consultation->status === 'pending')
                    <div class="bg-white rounded-lg shadow p-6 space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                        
                        <form action="{{ route('faculty.consultations.approve', $consultation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Approve Request
                            </button>
                        </form>

                        <a href="{{ route('faculty.consultations.reject-form', $consultation->id) }}" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Reject Request
                        </a>
                    </div>
                @elseif($consultation->status === 'approved')
                    <div class="bg-white rounded-lg shadow p-6 space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Schedule Consultation</h3>
                        
                        <a href="{{ route('faculty.consultations.schedule-form', $consultation->id) }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Schedule Date & Time
                        </a>

                        <a href="{{ route('faculty.consultations.reject-form', $consultation->id) }}" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Reject Request
                        </a>
                    </div>
                @elseif($consultation->status === 'scheduled')
                    <div class="bg-white rounded-lg shadow p-6 space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Scheduled</h3>
                        
                        <a href="{{ route('faculty.consultations.reschedule-form', $consultation->id) }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Reschedule
                        </a>

                        <form action="{{ route('faculty.consultations.complete', $consultation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Mark as Completed
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Sidebar Info Card -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg shadow p-6 border border-indigo-200 mt-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Need Help?</h3>
                    <p class="text-sm text-gray-700 mb-3">For more information about managing consultations, visit the help section or contact support.</p>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View Help Documentation →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
