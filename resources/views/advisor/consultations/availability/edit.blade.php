@extends('layouts.app')

@section('content')
<div class="py-12 pt-32">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <a href="{{ route('advisor.consultations.availability.index') }}" class="text-maroon-600 hover:text-maroon-700 text-sm font-medium">← Back to Availability</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Availability Slot</h1>
            </div>

            <div class="px-6 py-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                        <h4 class="text-sm font-medium text-red-800">Please correct the following errors:</h4>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('advisor.consultations.availability.update', $slot->id) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time *</label>
                        <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time', $slot->start_time->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time *</label>
                        <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time', $slot->end_time->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                            <option value="available" @selected(old('status', $slot->status) === 'available')>Available</option>
                            <option value="blocked" @selected(old('status', $slot->status) === 'blocked')>Blocked</option>
                            @if($slot->isBooked())
                            <option value="booked" @selected(old('status', $slot->status) === 'booked')>Booked</option>
                            @endif
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" id="location" name="location" maxlength="255" value="{{ old('location', $slot->location) }}" placeholder="e.g., Office A201" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" name="notes" rows="3" maxlength="500" placeholder="Any additional notes..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">{{ old('notes', $slot->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-md">
                        <h3 class="text-sm font-medium text-blue-800">Information:</h3>
                        <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                            <li><strong>Available:</strong> Open for students to book consultations</li>
                            <li><strong>Blocked:</strong> You're not available (conflicts, meetings, etc.)</li>
                            @if($slot->isBooked())
                            <li><strong>Booked:</strong> Already has a scheduled consultation</li>
                            @endif
                            <li>Booked slots can only be rescheduled through consultation management</li>
                        </ul>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-maroon-600 hover:bg-maroon-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-maroon-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
