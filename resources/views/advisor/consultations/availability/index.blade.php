@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Availability Slots</h1>
                <p class="text-gray-600 mt-2">Manage when you're available for student consultations</p>
            </div>
            <a href="{{ route('advisor.consultations.availability.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:from-maroon-700 hover:to-maroon-800">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Slot
            </a>
        </div>

        @if($slots->count() > 0)
            <!-- Slots Grid -->
            <div class="grid grid-cols-1 gap-6 mb-8">
                @php
                    // Group recurring slots by their recurrence pattern
                    $groupedSlots = [];
                    $recurringGroups = [];
                    
                    foreach($slots as $slot) {
                        if($slot->is_recurring && $slot->recurrence_pattern) {
                            $groupKey = $slot->advisor_id . '_' . $slot->recurrence_pattern . '_' . implode('_', $slot->recurrence_days ?? []);
                            if(!isset($recurringGroups[$groupKey])) {
                                $recurringGroups[$groupKey] = [
                                    'first' => $slot,
                                    'occurrences' => []
                                ];
                            }
                            $recurringGroups[$groupKey]['occurrences'][] = $slot;
                        } else {
                            $groupedSlots[] = $slot;
                        }
                    }
                @endphp

                <!-- Display Individual Slots -->
                @foreach($groupedSlots as $slot)
                    <div class="group relative bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 hover:border-maroon-300">
                        <!-- Status indicator bar -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r
                            @if($slot->status === 'available')
                                from-green-400 to-green-500
                            @elseif($slot->status === 'booked')
                                from-blue-400 to-blue-500
                            @else
                                from-gray-400 to-gray-500
                            @endif
                        "></div>

                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <!-- Date & Time -->
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="flex-shrink-0 bg-maroon-100 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">{{ $slot->start_time->format('l, F j, Y') }}</p>
                                            <p class="text-lg font-bold text-gray-900">{{ $slot->start_time->format('g:i A') }} – {{ $slot->end_time->format('g:i A') }}</p>
                                        </div>
                                    </div>

                                    <!-- Details Grid -->
                                    <div class="grid grid-cols-3 gap-4 mt-4">
                                        <!-- Duration -->
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Duration</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">{{ $slot->getFormattedDuration() }}</p>
                                        </div>

                                        <!-- Location -->
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Location</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">{{ $slot->location ?? 'TBA' }}</p>
                                        </div>

                                        <!-- Status -->
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Status</p>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($slot->status === 'available')
                                                    bg-green-100 text-green-700
                                                @elseif($slot->status === 'booked')
                                                    bg-blue-100 text-blue-700
                                                @else
                                                    bg-gray-100 text-gray-700
                                                @endif
                                            ">
                                                {{ ucfirst($slot->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Notes (if any) -->
                                    @if($slot->notes)
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Notes</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $slot->notes }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 ml-4 flex-shrink-0">
                                    <a href="{{ route('advisor.consultations.availability.edit', $slot->id) }}" class="inline-flex items-center justify-center p-2 text-maroon-600 hover:bg-maroon-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    @if(!$slot->isBooked())
                                        <button onclick="if(confirm('Are you sure you want to delete this slot?')) { document.getElementById('delete-form-{{ $slot->id }}').submit(); }" class="inline-flex items-center justify-center p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                        <form id="delete-form-{{ $slot->id }}" action="{{ route('advisor.consultations.availability.delete', $slot->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <div class="inline-flex items-center justify-center p-2 text-gray-400 cursor-not-allowed rounded-lg" title="Cannot delete booked slots">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Display Recurring Slot Groups -->
                @foreach($recurringGroups as $groupKey => $group)
                    @php $firstSlot = $group['first']; @endphp
                    <div class="group relative bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border-2 border-purple-300 hover:border-purple-500 bg-gradient-to-br from-white to-purple-50">
                        <!-- Status indicator bar -->
                        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-purple-400 to-purple-500"></div>

                        <div class="p-6 pt-8">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <!-- Recurring Badge Header -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                            </svg>
                                            Recurring Weekly Pattern
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                            {{ count($group['occurrences']) }} occurrences
                                        </span>
                                    </div>

                                    <!-- Time & Details -->
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Repeating Pattern</p>
                                            <p class="text-lg font-bold text-gray-900">{{ $firstSlot->start_time->format('g:i A') }} – {{ $firstSlot->end_time->format('g:i A') }}</p>
                                        </div>
                                    </div>

                                    <!-- Pattern Details Grid -->
                                    <div class="grid grid-cols-3 gap-4 mt-4">
                                        <!-- Duration -->
                                        <div class="bg-purple-50 rounded-lg p-3 border border-purple-100">
                                            <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Duration</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">{{ $firstSlot->getFormattedDuration() }}</p>
                                        </div>

                                        <!-- Days -->
                                        <div class="bg-purple-50 rounded-lg p-3 border border-purple-100">
                                            <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Days</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">{{ implode(', ', array_slice($firstSlot->recurrence_days ?? [], 0, 2)) }}{{ count($firstSlot->recurrence_days ?? []) > 2 ? '...' : '' }}</p>
                                        </div>

                                        <!-- Location -->
                                        <div class="bg-purple-50 rounded-lg p-3 border border-purple-100">
                                            <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Location</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">{{ $firstSlot->location ?? 'TBA' }}</p>
                                        </div>
                                    </div>

                                    <!-- Full Pattern Info -->
                                    <div class="mt-4 pt-4 border-t border-purple-200 bg-purple-50 rounded-lg p-3">
                                        <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide mb-2">Recurrence Details</p>
                                        <div class="space-y-2">
                                            <p class="text-sm text-gray-700">
                                                <strong class="text-purple-700">Days:</strong> {{ implode(', ', $firstSlot->recurrence_days ?? []) }}
                                            </p>
                                            <p class="text-sm text-gray-700">
                                                <strong class="text-purple-700">Duration:</strong> {{ $firstSlot->recurrence_end_weeks }} weeks
                                            </p>
                                            <p class="text-sm text-gray-700">
                                                <strong class="text-purple-700">Period:</strong> {{ $group['occurrences'][0]->start_time->format('M d') }} – {{ $group['occurrences'][count($group['occurrences']) - 1]->start_time->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Notes (if any) -->
                                    @if($firstSlot->notes)
                                        <div class="mt-3 pt-3 border-t border-purple-200">
                                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Notes</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $firstSlot->notes }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col gap-2 ml-4 flex-shrink-0">
                                    <button class="inline-flex items-center justify-center p-2 text-gray-400 cursor-not-allowed rounded-lg" title="Recurring slots cannot be edited individually">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <div class="inline-flex items-center justify-center p-2 text-gray-400 cursor-not-allowed rounded-lg" title="Cannot delete recurring slot patterns">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Occurrences List (Collapsible) -->
                            <div class="mt-4 pt-4 border-t border-purple-200">
                                <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="flex items-center gap-2 text-sm font-semibold text-purple-700 hover:text-purple-900">
                                    <svg class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    View All Occurrences ({{ count($group['occurrences']) }})
                                </button>
                                <div class="hidden mt-3 max-h-60 overflow-y-auto">
                                    <div class="space-y-2">
                                        @foreach($group['occurrences'] as $occurrence)
                                            <div class="flex items-center justify-between p-2 bg-white border border-purple-100 rounded text-sm">
                                                <span class="text-gray-700">{{ $occurrence->start_time->format('l, M d \a\t g:i A') }}</span>
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                                    @if($occurrence->status === 'available')
                                                        bg-green-100 text-green-700
                                                    @elseif($occurrence->status === 'booked')
                                                        bg-blue-100 text-blue-700
                                                    @else
                                                        bg-gray-100 text-gray-700
                                                    @endif
                                                ">
                                                    {{ ucfirst($occurrence->status) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($slots->hasPages())
                <div class="mt-8">
                    {{ $slots->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200 p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mt-4">No availability slots yet</h3>
                <p class="text-gray-600 mt-2 max-w-md mx-auto">Create your first availability slot to let students know when you're available for consultations.</p>
                <div class="mt-8">
                    <a href="{{ route('advisor.consultations.availability.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:from-maroon-700 hover:to-maroon-800">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Your First Slot
                    </a>
                </div>
            </div>
        @endif

        <!-- Info Box -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-blue-900">How Availability Works</h3>
                    <ul class="mt-3 space-y-2 text-sm text-blue-800">
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                            Create time slots when you're available for consultations
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                            Students can book available slots for consultations
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                            Booked slots are automatically marked and cannot be deleted
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                            Edit or delete only available (unbooked) slots
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
