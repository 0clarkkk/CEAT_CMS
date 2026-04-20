@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <div class="h-12 w-1 bg-gradient-to-b from-indigo-500 to-indigo-600 rounded-full"></div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Browse Faculty Advisors</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">View available advisors and their consultation schedules</p>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8 border border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Search & Filter</h2>
            <form method="GET" action="{{ route('student.consultations.browse-advisors') }}" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" placeholder="Search by name or department..." value="{{ request('search') }}" class="flex-1 px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-indigo-500 focus:ring-indigo-500">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-all">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
            </form>
        </div>

        <!-- Advisors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($advisors as $advisor)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-indigo-600">
                    <h3 class="text-xl font-bold text-white">{{ $advisor->name }}</h3>
                    <p class="text-indigo-100 text-sm mt-1">Faculty Advisor</p>
                </div>

                <!-- Content -->
                <div class="p-6 space-y-4">
                    <!-- Email -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        </svg>
                        <a href="mailto:{{ $advisor->email }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">{{ $advisor->email }}</a>
                    </div>

                    <!-- Department -->
                    @if($advisor->facultyMember && $advisor->facultyMember->department)
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $advisor->facultyMember->department->name }}</span>
                    </div>
                    @endif

                    <!-- Available Slots Count -->
                    <div class="flex items-center gap-3 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-700">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
                        </svg>
                        <div>
                            <p class="text-xs font-semibold text-green-900 dark:text-green-200 uppercase">Available Slots</p>
                            <p class="text-sm font-bold text-green-900 dark:text-green-100">
                                {{ $advisor->availabilitySlots()->available()->count() }}
                            </p>
                        </div>
                    </div>

                    <!-- Bio/About (if available) -->
                    @if($advisor->facultyMember && $advisor->facultyMember->bio)
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">{{ $advisor->facultyMember->bio }}</p>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex gap-3">
                    <a href="{{ route('student.consultations.create') }}?advisor_id={{ $advisor->id }}" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-all text-center text-sm">
                        Request Consultation
                    </a>
                    <button onclick="showAdvisorSchedule({{ $advisor->id }}, '{{ $advisor->name }}')" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-500 transition-all text-sm">
                        View Schedule
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No advisors found</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">Try adjusting your search filters</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($advisors->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $advisors->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Schedule Modal -->
<div id="scheduleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-500 to-indigo-600 sticky top-0">
            <div class="flex items-center justify-between">
                <h3 id="scheduleModalTitle" class="text-xl font-bold text-white">Availability Schedule</h3>
                <button onclick="closeScheduleModal()" class="text-indigo-100 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="scheduleModalContent" class="p-6">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
            </div>
        </div>
    </div>
</div>

<script>
function showAdvisorSchedule(advisorId, advisorName) {
    document.getElementById('scheduleModal').classList.remove('hidden');
    document.getElementById('scheduleModalTitle').textContent = advisorName + "'s Schedule";

    // Fetch advisor's available slots
    fetch(`/api/advisor/${advisorId}/availability?days=14`)
        .then(response => response.json())
        .then(data => {
            let html = '';
            if (data.slots && data.slots.length > 0) {
                html = '<div class="space-y-2">';
                data.slots.forEach(slot => {
                    const startTime = new Date(slot.start_time).toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const endTime = new Date(slot.end_time).toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    html += `<div class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all cursor-pointer">
                        <p class="font-semibold text-gray-900 dark:text-white">${startTime} - ${endTime}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">${slot.location || 'Virtual'}</p>
                    </div>`;
                });
                html += '</div>';
            } else {
                html = '<p class="text-center text-gray-600 dark:text-gray-400">No available slots in the next 2 weeks</p>';
            }
            document.getElementById('scheduleModalContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('scheduleModalContent').innerHTML = '<p class="text-center text-red-600">Error loading schedule</p>';
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
</script>
@endsection
