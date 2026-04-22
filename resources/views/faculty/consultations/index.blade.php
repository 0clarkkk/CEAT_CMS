@extends('layouts.faculty', [
    'title' => 'My Consultations',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Consultations', 'url' => route('faculty.consultations.index')],
        ['label' => 'All Requests']
    ]
])

@section('faculty_content')
<div class="space-y-6">
    <!-- Filter Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="flex flex-wrap overflow-x-auto">
            <a href="{{ route('faculty.consultations.index') }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ !request('status') ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                All
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                    {{ $stats['total'] ?? 0 }}
                </span>
            </a>
            <a href="{{ route('faculty.consultations.index', ['status' => 'pending']) }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ request('status') === 'pending' ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                Pending
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ request('status') === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $stats['pending'] ?? 0 }}
                </span>
            </a>
            <a href="{{ route('faculty.consultations.index', ['status' => 'approved']) }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ request('status') === 'approved' ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                Approved
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ request('status') === 'approved' ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $stats['approved'] ?? 0 }}
                </span>
            </a>
            <a href="{{ route('faculty.consultations.index', ['status' => 'scheduled']) }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ request('status') === 'scheduled' ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                Scheduled
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ request('status') === 'scheduled' ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $stats['scheduled'] ?? 0 }}
                </span>
            </a>
            <a href="{{ route('faculty.consultations.index', ['status' => 'completed']) }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ request('status') === 'completed' ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                Completed
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ request('status') === 'completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $stats['completed'] ?? 0 }}
                </span>
            </a>
            <a href="{{ route('faculty.consultations.index', ['status' => 'rejected']) }}"
                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap {{ request('status') === 'rejected' ? 'border-tangerine-600 text-tangerine-600 bg-tangerine-50/50' : 'border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                Rejected
                <span class="ml-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ request('status') === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-slate-100 text-slate-700' }}">
                    {{ $stats['rejected'] ?? 0 }}
                </span>
            </a>
        </div>
    </div>

    <!-- Consultations List -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @if($consultations->isEmpty())
        <div class="px-6 py-16 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-slate-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-1">No consultations found</h3>
            <p class="text-slate-500 text-sm">When students request consultations matching this filter, they will appear here.</p>
        </div>
        @else
        <div class="divide-y divide-slate-100">
            @foreach($consultations as $consultation)
            <div class="px-6 py-5 hover:bg-slate-50 transition-colors duration-150">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-slate-900 truncate">{{ $consultation->title }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider
                                        @if($consultation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($consultation->status === 'approved') bg-blue-100 text-blue-800
                                        @elseif($consultation->status === 'scheduled') bg-green-100 text-green-800
                                        @elseif($consultation->status === 'completed') bg-emerald-100 text-emerald-800
                                        @elseif($consultation->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-slate-100 text-slate-800
                                        @endif">
                                {{ ucfirst($consultation->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3 text-sm">
                            <div class="space-y-1.5">
                                <p class="text-slate-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="font-medium text-slate-900 mr-1">Student:</span> {{ $consultation->student?->name ?? 'N/A' }}
                                </p>
                                <p class="text-slate-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $consultation->student?->email ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="space-y-1.5">
                                @if($consultation->category)
                                <p class="text-slate-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    <span class="capitalize">{{ $consultation->category }}</span>
                                </p>
                                @endif
                                @if($consultation->scheduled_at)
                                <p class="text-slate-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}
                                </p>
                                @endif
                                @if($consultation->location)
                                <p class="text-slate-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $consultation->location }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 bg-slate-50 p-3 rounded-lg border border-slate-100">
                            <p class="text-sm text-slate-700 line-clamp-2 leading-relaxed">{{ $consultation->description }}</p>
                        </div>

                        <p class="text-[11px] font-medium text-slate-400 mt-4 uppercase tracking-wider">
                            Requested {{ $consultation->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div class="mt-4 md:mt-0 md:ml-4 flex-shrink-0">
                        <a href="{{ route('faculty.consultations.show', $consultation->id) }}"
                            class="inline-flex items-center justify-center w-full md:w-auto px-5 py-2.5 rounded-xl bg-tangerine-50 text-tangerine-600 hover:bg-tangerine-100 transition-colors text-sm font-bold border border-tangerine-100 hover:border-tangerine-200">
                            View Details
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
@endsection