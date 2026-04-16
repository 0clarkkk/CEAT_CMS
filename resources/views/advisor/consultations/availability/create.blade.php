@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('advisor.consultations.availability.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">← Back to Availability</a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Create Availability Slots</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Add time slots when you're available for consultations</p>
            </div>

            <div class="px-6 py-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                        <h4 class="text-sm font-medium text-red-800 dark:text-red-200">Please correct the following errors:</h4>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('advisor.consultations.availability.store') }}" id="availability-form" class="space-y-6">
                    @csrf

                    <!-- Slots Container -->
                    <div id="slots-container" class="space-y-6">
                        <div class="slot-card border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-gray-50 dark:bg-gray-700">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Slot 1</h3>
                                <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-700 text-sm font-medium" style="display: none;">Remove</button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Start Time -->
                                <div>
                                    <label for="slots[0][start_time]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time *</label>
                                    <input type="datetime-local" name="slots[0][start_time]" required value="{{ old('slots.0.start_time') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('slots.0.start_time')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- End Time -->
                                <div>
                                    <label for="slots[0][end_time]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time *</label>
                                    <input type="datetime-local" name="slots[0][end_time]" required value="{{ old('slots.0.end_time') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('slots.0.end_time')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="slots[0][location]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                    <input type="text" name="slots[0][location]" maxlength="255" value="{{ old('slots.0.location') }}" placeholder="e.g., Office A201" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('slots.0.location')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Notes -->
                                <div>
                                    <label for="slots[0][notes]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                    <input type="text" name="slots[0][notes]" maxlength="500" value="{{ old('slots.0.notes') }}" placeholder="Any additional notes..." class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('slots.0.notes')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add More Slots Button -->
                    <button type="button" onclick="addSlot()" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Another Slot
                    </button>

                    <!-- Info Box -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Tips:</h3>
                        <ul class="mt-2 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                            <li>Set realistic time slots for your availability</li>
                            <li>Use 24-hour format or let your browser convert to local time</li>
                            <li>You can create multiple slots at once</li>
                            <li>Make sure end time is after start time</li>
                            <li>The system will alert if there are scheduling conflicts</li>
                        </ul>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-indigo-500">
                            Create Slots
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let slotCount = 1;

    function addSlot() {
        const container = document.getElementById('slots-container');
        const newSlot = document.createElement('div');
        newSlot.className = 'slot-card border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-gray-50 dark:bg-gray-700';
        newSlot.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Slot ${slotCount + 1}</h3>
                <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-700 text-sm font-medium">Remove</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="slots[${slotCount}][start_time]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time *</label>
                    <input type="datetime-local" name="slots[${slotCount}][start_time]" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="slots[${slotCount}][end_time]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time *</label>
                    <input type="datetime-local" name="slots[${slotCount}][end_time]" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="slots[${slotCount}][location]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" name="slots[${slotCount}][location]" maxlength="255" placeholder="e.g., Office A201" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="slots[${slotCount}][notes]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                    <input type="text" name="slots[${slotCount}][notes]" maxlength="500" placeholder="Any additional notes..." class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
        `;
        container.appendChild(newSlot);
        slotCount++;
    }

    function removeSlot(button) {
        const card = button.closest('.slot-card');
        card.remove();
    }

    // Show remove button only if there's more than one slot
    function updateRemoveButtons() {
        const cards = document.querySelectorAll('.slot-card');
        cards.forEach(card => {
            const removeBtn = card.querySelector('button[type="button"]');
            if (removeBtn) {
                removeBtn.style.display = cards.length > 1 ? 'block' : 'none';
            }
        });
    }

    // Call on page load
    updateRemoveButtons();
</script>
@endsection
