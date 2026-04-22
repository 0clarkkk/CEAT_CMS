@extends('layouts.faculty', [
    'title' => 'Consultation Details',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Consultations', 'url' => route('faculty.consultations.index')],
        ['label' => 'View Details']
    ]
])

@section('faculty_content')
<div class="space-y-6">
    <!-- Status Alert -->
    @if($consultation->status === 'rejected')
    <div class="bg-red-50 border border-red-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-red-600 mt-0.5 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="font-bold text-red-900 text-lg">Consultation Rejected</h3>
                <p class="text-red-700 mt-2">{{ $consultation->rejection_reason }}</p>
                <p class="text-xs text-red-600 mt-3 font-semibold uppercase tracking-wider">Rejected on: {{ $consultation->rejected_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center gap-3">
                    <svg class="w-5 h-5 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h2 class="text-lg font-bold text-slate-900">Request Information</h2>
                </div>
                <div class="px-6 py-6 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Title</label>
                        <p class="mt-1 text-slate-900 text-lg font-medium">{{ $consultation->title }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Description</label>
                        <div class="mt-2 bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-slate-700 whitespace-pre-wrap leading-relaxed">{{ $consultation->description }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Category</label>
                            <p class="mt-1 text-slate-900 capitalize font-medium">{{ $consultation->category ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Status</label>
                            <div class="mt-1.5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    @if($consultation->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                    @elseif($consultation->status === 'approved') bg-blue-100 text-blue-800 border border-blue-200
                                    @elseif($consultation->status === 'scheduled') bg-green-100 text-green-800 border border-green-200
                                    @elseif($consultation->status === 'completed') bg-emerald-100 text-emerald-800 border border-emerald-200
                                    @elseif($consultation->status === 'rejected') bg-red-100 text-red-800 border border-red-200
                                    @else bg-slate-100 text-slate-800 border border-slate-200
                                    @endif">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Location</label>
                        <p class="mt-1 text-slate-900 font-medium flex items-center">
                            @if($consultation->location)
                            <svg class="w-4 h-4 mr-2 text-tangerine-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            @endif
                            {{ $consultation->location ?? 'Not specified' }}
                        </p>
                    </div>

                    @if($consultation->scheduled_at)
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Scheduled Date & Time</label>
                        <p class="mt-1 text-slate-900 text-lg font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2 text-tangerine-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $consultation->scheduled_at->format('l, F d, Y \a\t h:i A') }}
                        </p>
                    </div>
                    @endif

                    <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                        <span>Created: {{ $consultation->created_at->format('M d, Y h:i A') }}</span>
                        <span class="mt-1 sm:mt-0">Last Updated: {{ $consultation->updated_at->format('M d, Y h:i A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Student Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center gap-3">
                    <svg class="w-5 h-5 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <h2 class="text-lg font-bold text-slate-900">Student Profile</h2>
                </div>
                <div class="px-6 py-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-bold text-2xl text-slate-400 shadow-sm">
                            {{ $consultation->student ? strtoupper(substr($consultation->student->name, 0, 1)) : '?' }}
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Name</label>
                            <p class="mt-1 text-slate-900 text-xl font-bold">{{ $consultation->student?->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email Contact</label>
                            <a href="mailto:{{ $consultation->student?->email }}" class="mt-1 text-tangerine-600 hover:text-tangerine-700 font-medium">{{ $consultation->student?->email ?? 'N/A' }}</a>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Student ID Number</label>
                            <p class="mt-1 text-slate-900 font-medium">{{ $consultation->student?->student_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-1 space-y-6">
            @if($consultation->status === 'pending' || $consultation->status === 'approved' || $consultation->status === 'scheduled')
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-5">Available Actions</h3>
                <div class="space-y-3">
                    @if($consultation->status === 'pending')
                        <form action="{{ route('faculty.consultations.approve', $consultation->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-3 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Approve Request
                            </button>
                        </form>

                        <a href="{{ route('faculty.consultations.reject-form', $consultation->id) }}"
                            class="w-full px-4 py-3 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Reject Request
                        </a>
                    @elseif($consultation->status === 'approved')
                        <a href="{{ route('faculty.consultations.schedule-form', $consultation->id) }}"
                            class="w-full px-4 py-3 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Schedule Time
                        </a>

                        <a href="{{ route('faculty.consultations.reject-form', $consultation->id) }}"
                            class="w-full px-4 py-3 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Decline & Reject
                        </a>
                    @elseif($consultation->status === 'scheduled')
                        <a href="{{ route('faculty.consultations.reschedule-form', $consultation->id) }}"
                            class="w-full px-4 py-3 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Reschedule
                        </a>

                        <form action="{{ route('faculty.consultations.complete', $consultation->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-3 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-xl transition-colors font-bold flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Mark as Completed
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endif

            <!-- Info Card -->
            <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-slate-200 rounded-full mb-4">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-slate-900 mb-2">Notice</h3>
                <p class="text-sm text-slate-600 leading-relaxed mb-4">Students receive automatic notification emails whenever you change the status of this consultation request.</p>
            </div>
        </div>
    </div>
</div>
@endsection