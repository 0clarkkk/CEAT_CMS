@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">← Back to Consultation</a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Reschedule Consultation</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Student: {{ $consultation->student->name }}</p>
            </div>

            <div class="px-6 py-6">
                <form method="POST" action="{{ route('advisor.consultations.reschedule', $consultation->id) }}" class="space-y-6">
                    @csrf
                    @method('POST')

                    <!-- Current Schedule -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Current Schedule</h3>
                        <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                            <strong>Date & Time:</strong> {{ $consultation->scheduled_at->format('M d, Y \a\t h:i A') }}
                        </p>
                        @if($consultation->location)
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            <strong>Location:</strong> {{ $consultation->location }}
                        </p>
                        @endif
                    </div>

                    <!-- Available Slots -->
                    <div>
                        <label for="slot_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select New Time Slot *</label>
                        <select id="slot_id" name="slot_id" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Select a time slot --</option>
                            @foreach($availableSlots as $slot)
                                <option value="{{ $slot->id }}" @selected(old('slot_id') == $slot->id)>
                                    {{ $slot->start_time->format('M d, Y \a\t h:i A') }} - {{ $slot->end_time->format('h:i A') }}
                                    @if($slot->location)
                                        ({{ $slot->location }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('slot_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        @if($availableSlots->count() === 0)
                            <p class="mt-2 text-sm text-yellow-600 dark:text-yellow-400">
                                <strong>No available slots found.</strong> Please create more availability slots first.
                            </p>
                            <a href="{{ route('advisor.consultations.availability.create') }}" class="mt-2 inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">
                                Create Availability Slots
                            </a>
                        @endif
                    </div>

                    <!-- Location (Optional) -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meeting Location (Optional)</label>
                        <input type="text" id="location" name="location" maxlength="255" placeholder="e.g., Office A201, Building C" value="{{ old('location', $consultation->location) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to use the default location from the selected slot</p>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Important:</h3>
                        <ul class="mt-2 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                            <li>The student will be notified of the new schedule</li>
                            <li>The old time slot will be released and available again</li>
                            <li>The new slot will be marked as booked</li>
                        </ul>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        @if($availableSlots->count() > 0)
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-indigo-500">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reschedule Consultation
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
