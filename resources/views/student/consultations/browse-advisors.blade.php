@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-slate-950">
    <!-- Header Section -->
    <div class="border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-slate-900 dark:text-white">Find Your Advisor</h1>
                    <p class="text-slate-600 dark:text-slate-400 mt-2">Browse available faculty members and request consultations</p>
                </div>
                <a href="{{ route('student.consultations.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l-7-7 7-7m8 0l7 7-7 7"></path>
                    </svg>
                    My Consultations
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Section -->
        <div class="mb-8">
            <form method="GET" action="{{ route('student.consultations.browse-advisors') }}" class="flex gap-2">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search advisors by name, email, or department..." 
                        value="{{ request('search') }}" 
                        class="w-full pl-12 pr-4 py-3 border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-900 transition-all"
                    >
                </div>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors"
                >
                    Search
                </button>
                @if(request('search'))
                <a 
                    href="{{ route('student.consultations.browse-advisors') }}" 
                    class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg font-medium hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors"
                >
                    Clear
                </a>
                @endif
            </form>
        </div>

        <!-- Results Info -->
        <div class="mb-8 flex items-center justify-between">
            <p class="text-slate-600 dark:text-slate-400">
                <span class="font-semibold text-slate-900 dark:text-white">{{ $advisors->total() }}</span> advisor(s) available
                @if(request('search'))
                    matching <span class="font-semibold">"{{ request('search') }}"</span>
                @endif
            </p>
        </div>

        <!-- Advisors Grid -->
        @if($advisors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($advisors as $advisor)
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md hover:shadow-xl transition-shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <!-- Header -->
                    <div class="h-24 bg-gradient-to-r from-indigo-500 to-blue-500"></div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Avatar -->
                        <div class="flex items-end gap-4 mb-4 -mt-10">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 border-4 border-white dark:border-slate-800 flex items-center justify-center text-white font-bold text-xl">
                                {{ strtoupper(substr($advisor->name, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Name -->
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $advisor->name }}</h3>
                        
                        <!-- Department -->
                        @if($advisor->facultyMember && $advisor->facultyMember->department)
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $advisor->facultyMember->department->name }}</p>
                        @endif

                        <!-- Email -->
                        <a href="mailto:{{ $advisor->email }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline block mt-2 truncate">{{ $advisor->email }}</a>

                        <!-- Availability -->
                        <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                            <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">{{ $advisor->availabilitySlots()->available()->count() }} Available Slots</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-6 py-3 bg-slate-50 dark:bg-slate-700/30 border-t border-slate-200 dark:border-slate-700 flex gap-2">
                        <a 
                            href="{{ route('student.consultations.create') }}?advisor_id={{ $advisor->id }}" 
                            class="flex-1 px-3 py-2 bg-indigo-600 text-white text-sm rounded-lg font-medium hover:bg-indigo-700 transition-colors text-center"
                        >
                            Request
                        </a>
                        <button 
                            onclick="showAdvisorSchedule({{ $advisor->id }}, '{{ addslashes($advisor->name) }}')" 
                            class="flex-1 px-3 py-2 bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 text-sm rounded-lg font-medium border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                        >
                            Schedule
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($advisors->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $advisors->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-16 text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">No advisors found</h3>
                <p class="text-slate-600 dark:text-slate-400 mb-6">Try adjusting your search filters or check back later</p>
                <a 
                    href="{{ route('student.consultations.browse-advisors') }}" 
                    class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all"
                >
                    View All Advisors
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Schedule Modal -->
<div id="scheduleModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto border border-slate-200 dark:border-slate-700">
        <!-- Modal Header -->
        <div class="sticky top-0 px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-gradient-to-r from-indigo-600 to-blue-600">
            <div class="flex items-center justify-between">
                <h3 id="scheduleModalTitle" class="text-xl font-bold text-white">Availability Schedule</h3>
                <button onclick="closeScheduleModal()" class="text-indigo-100 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div id="scheduleModalContent" class="p-6">
            <div class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-indigo-200 border-t-indigo-600"></div>
            </div>
        </div>
    </div>
</div>

<script>
function showAdvisorSchedule(advisorId, advisorName) {
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModalTitle').textContent = advisorName + "'s Availability";

    // Fetch advisor's available slots
    fetch(`/api/advisor/${advisorId}/availability?days=14`)
        .then(response => response.json())
        .then(data => {
            let html = '';
            if (data.slots && data.slots.length > 0) {
                html = '<div class="space-y-3">';
                data.slots.forEach(slot => {
                    const startDate = new Date(slot.start_time);
                    const endDate = new Date(slot.end_time);
                    const dateStr = startDate.toLocaleDateString('en-US', {
                        weekday: 'short',
                        month: 'short',
                        day: 'numeric'
                    });
                    const startTimeStr = startDate.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const endTimeStr = endDate.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    html += `
                        <div class="p-4 border-2 border-slate-200 dark:border-slate-600 rounded-xl hover:border-indigo-400 dark:hover:border-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/10 transition-all">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">${dateStr}</p>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">${startTimeStr} - ${endTimeStr}</p>
                                    ${slot.location ? `<p class="text-xs text-slate-500 dark:text-slate-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.307-.066l.003-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.758.433 8.13 8.13 0 00.281.14l.018.008.006.003zM10 12a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg>${slot.location}</p>` : ''}
                                </div>
                                <div class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-xs font-semibold">
                                    Available
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
            } else {
                html = `
                    <div class="py-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-slate-400 mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-slate-600 dark:text-slate-400 font-medium">No available slots in the next 2 weeks</p>
                        <p class="text-sm text-slate-500 mt-2">Please check back later or contact the advisor directly</p>
                    </div>
                `;
            }
            document.getElementById('scheduleModalContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('scheduleModalContent').innerHTML = `
                <div class="py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-red-400 mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-red-600 dark:text-red-400 font-medium">Unable to load schedule</p>
                    <p class="text-sm text-slate-500 mt-2">Please try again later</p>
                </div>
            `;
            console.error('Error:', error);
        });
}

function closeScheduleModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
}

// Close modal on outside click
document.getElementById('scheduleModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeScheduleModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeScheduleModal();
    }
});
</script>
@endsection
