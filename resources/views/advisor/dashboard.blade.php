@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Consultation Management</h1>
                    <p class="mt-2 text-sm text-gray-600">Manage all your consultations and availability</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('faculty.dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l-7-7 7-7"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    <a href="{{ route('advisor.consultations.availability.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Manage Availability
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filter Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <div class="flex gap-1 -mb-px">
                <a href="{{ route('advisor.consultations.dashboard') }}" 
                   class="px-4 py-2 border-b-2 font-medium text-sm {{ Request::is('advisor/consultations/dashboard') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Overview
                </a>
                <a href="{{ route('advisor.consultations.index') }}" 
                   class="px-4 py-2 border-b-2 font-medium text-sm {{ Request::is('advisor/consultations') && !Request::has('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    All Consultations
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'pending']) }}" 
                   class="px-4 py-2 border-b-2 font-medium text-sm {{ Request::get('status') === 'pending' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Pending Requests
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'approved']) }}" 
                   class="px-4 py-2 border-b-2 font-medium text-sm {{ Request::get('status') === 'approved' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Scheduled
                </a>
                <a href="{{ route('advisor.consultations.index', ['status' => 'completed']) }}" 
                   class="px-4 py-2 border-b-2 font-medium text-sm {{ Request::get('status') === 'completed' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Completed
                </a>
            </div>
        </div>

        <!-- Statistics Row -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5 mb-8">
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
                <p class="text-xs text-gray-600 font-medium">PENDING</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pending'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
                <p class="text-xs text-gray-600 font-medium">SCHEDULED</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['approved'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
                <p class="text-xs text-gray-600 font-medium">COMPLETED</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['completed'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
                <p class="text-xs text-gray-600 font-medium">REJECTED</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['rejected'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-purple-500">
                <p class="text-xs text-gray-600 font-medium">TOTAL</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total'] ?? 0 }}</p>
            </div>
        </div>

        <!-- Slot Information -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-8">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-indigo-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-indigo-900">Current Availability</h3>
                    <p class="text-sm text-indigo-700 mt-1">
                        You have <span class="font-semibold">{{ $upcomingSlots ?? 0 }}</span> available slots in the next 7 days.
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="font-medium underline hover:no-underline">Manage your slots →</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Placeholder -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-8 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <p class="text-gray-500 font-medium">Consultation Dashboard</p>
                <p class="text-sm text-gray-500 mt-1">Navigate to different sections using the tabs above</p>
            </div>
        </div>
    </div>
</div>
@endsection
