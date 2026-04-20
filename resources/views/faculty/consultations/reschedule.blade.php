@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Reschedule Consultation</h1>
                <p class="mt-2 text-sm text-gray-600">Update the date and time for this consultation</p>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-900">Consultation: {{ $consultation->title }}</h2>
                <p class="text-sm text-gray-600 mt-1">Student: {{ $consultation->student?->name }}</p>
            </div>

            <div class="px-6 py-4 bg-blue-50 border-b border-blue-200">
                <p class="text-sm text-blue-900">
                    <strong>Current Schedule:</strong> {{ $consultation->scheduled_at?->format('l, F d, Y \a\t h:i A') ?? 'Not scheduled' }}
                </p>
            </div>

            <form action="{{ route('faculty.consultations.reschedule', $consultation->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="scheduled_date" class="block text-sm font-semibold text-gray-700 mb-2">New Date</label>
                    <input 
                        type="date" 
                        id="scheduled_date" 
                        name="scheduled_date"
                        value="{{ old('scheduled_date', $consultation->scheduled_at?->format('Y-m-d')) }}"
                        min="{{ now()->format('Y-m-d') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    @error('scheduled_date')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="scheduled_time" class="block text-sm font-semibold text-gray-700 mb-2">New Time</label>
                    <input 
                        type="time" 
                        id="scheduled_time" 
                        name="scheduled_time"
                        value="{{ old('scheduled_time', $consultation->scheduled_at?->format('H:i')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    @error('scheduled_time')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location"
                        placeholder="e.g., Office 305, Conference Room B, Virtual (Zoom link)"
                        value="{{ old('location', $consultation->location) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    @error('location')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reschedule_reason" class="block text-sm font-semibold text-gray-700 mb-2">Reason for Reschedule (Optional)</label>
                    <textarea 
                        id="reschedule_reason" 
                        name="reschedule_reason" 
                        rows="4"
                        placeholder="Briefly explain why you're rescheduling. The student will be notified of the change and reason."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none">{{ old('reschedule_reason') }}</textarea>
                    @error('reschedule_reason')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-900">
                        <strong>Note:</strong> The student will be notified of the reschedule with the new date, time, location, and your reason. This is important for maintaining good communication.
                    </p>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('faculty.consultations.show', $consultation->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Reschedule Consultation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
