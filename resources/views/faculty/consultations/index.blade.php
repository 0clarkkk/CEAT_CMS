@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Consultations</h1>
                    <p class="mt-2 text-sm text-gray-600">Manage your consultation requests and schedule</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filter Tabs -->
        <div class="bg-white rounded-lg shadow mb-6 border-b border-gray-200">
            <div class="flex flex-wrap">
                <a href="{{ route('faculty.consultations.index') }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ !request('status') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    All
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">{{ $stats['total'] ?? 0 }}</span>
                </a>
                <a href="{{ route('faculty.consultations.index', ['status' => 'pending']) }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-600 text-yellow-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Pending
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">{{ $stats['pending'] ?? 0 }}</span>
                </a>
                <a href="{{ route('faculty.consultations.index', ['status' => 'approved']) }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Approved
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ $stats['approved'] ?? 0 }}</span>
                </a>
                <a href="{{ route('faculty.consultations.index', ['status' => 'scheduled']) }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ request('status') === 'scheduled' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Scheduled
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">{{ $stats['scheduled'] ?? 0 }}</span>
                </a>
                <a href="{{ route('faculty.consultations.index', ['status' => 'completed']) }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ request('status') === 'completed' ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Completed
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">{{ $stats['completed'] ?? 0 }}</span>
                </a>
                <a href="{{ route('faculty.consultations.index', ['status' => 'rejected']) }}" 
                   class="px-6 py-4 border-b-2 font-medium text-sm {{ request('status') === 'rejected' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }}">
                    Rejected
                    <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">{{ $stats['rejected'] ?? 0 }}</span>
                </a>
            </div>
        </div>

        <!-- Consultations List -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($consultations->isEmpty())
                <div class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No consultations found</h3>
                    <p class="text-gray-600">When students request consultations, they will appear here.</p>
                </div>
            @else
                <div class="divide-y divide-gray-200">
                    @foreach($consultations as $consultation)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $consultation->title }}</h3>
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
                                    
                                    <div class="grid grid-cols-2 gap-4 mt-3 text-sm">
                                        <div>
                                            <p class="text-gray-600">
                                                <span class="font-medium">Student:</span> {{ $consultation->student?->name ?? 'N/A' }}
                                            </p>
                                            <p class="text-gray-600 mt-1">
                                                <span class="font-medium">Email:</span> {{ $consultation->student?->email ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div>
                                            @if($consultation->category)
                                                <p class="text-gray-600">
                                                    <span class="font-medium">Category:</span> <span class="capitalize">{{ $consultation->category }}</span>
                                                </p>
                                            @endif
                                            @if($consultation->scheduled_at)
                                                <p class="text-gray-600 mt-1">
                                                    <span class="font-medium">Scheduled:</span> {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mt-3">{{ $consultation->description }}</p>

                                    @if($consultation->location)
                                        <p class="text-sm text-gray-600 mt-2">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <strong>Location:</strong> {{ $consultation->location }}
                                        </p>
                                    @endif

                                    <p class="text-xs text-gray-500 mt-3">
                                        Requested: {{ $consultation->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <div class="ml-4 flex gap-2">
                                    <a href="{{ route('faculty.consultations.show', $consultation->id) }}" 
                                       class="inline-flex items-center px-3 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($consultations->hasPages())
            <div class="mt-6">
                {{ $consultations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
