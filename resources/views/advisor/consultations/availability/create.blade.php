@extends('layouts.app')

@section('content')
<div class="py-12 pt-32">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <a href="{{ route('advisor.consultations.availability.index') }}" class="text-maroon-600 hover:text-maroon-700 text-sm font-medium">← Back to Availability</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Create Availability Slots</h1>
                <p class="text-gray-600 mt-1">Add time slots when you're available for consultations</p>
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

                <form method="POST" action="{{ route('advisor.consultations.availability.store') }}" id="availability-form" class="space-y-6" onsubmit="return validateForm()">
                    @csrf

                    <!-- Recurring Slots Option -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="use-recurring" name="use_recurring" value="1" class="w-5 h-5 text-maroon-600 rounded focus:ring-maroon-500" onchange="toggleRecurringForm()">
                            <label for="use-recurring" class="ml-3 text-sm font-semibold text-gray-900">
                                Create Recurring Slots (e.g., Every Monday & Wednesday 12-2 PM)
                            </label>
                        </div>

                        <div id="recurring-form" class="space-y-4" style="display: none;">
                            <p class="text-sm text-gray-600">Set up recurring availability slots that repeat weekly for a specified number of weeks.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Start Date -->
                                <div>
                                    <label for="recurring_start_date" class="block text-sm font-medium text-gray-700">Start Date *</label>
                                    <input type="date" name="recurring_start_date" id="recurring_start_date" value="{{ old('recurring_start_date', now()->format('Y-m-d')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>

                                <!-- Start Time -->
                                <div>
                                    <label for="recurring_start_time" class="block text-sm font-medium text-gray-700">Start Time *</label>
                                    <input type="time" name="recurring_start_time" id="recurring_start_time" value="{{ old('recurring_start_time', '09:00') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>

                                <!-- End Time -->
                                <div>
                                    <label for="recurring_end_time" class="block text-sm font-medium text-gray-700">End Time *</label>
                                    <input type="time" name="recurring_end_time" id="recurring_end_time" value="{{ old('recurring_end_time', '10:00') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>

                                <!-- Number of Weeks -->
                                <div>
                                    <label for="recurring_weeks" class="block text-sm font-medium text-gray-700">Number of Weeks *</label>
                                    <input type="number" name="recurring_weeks" id="recurring_weeks" min="1" max="52" value="{{ old('recurring_weeks', 12) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>
                            </div>

                            <!-- Days of Week -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Days of Week *</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="recurring_days[]" value="{{ $day }}" class="w-4 h-4 text-maroon-600 rounded focus:ring-maroon-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Location -->
                                <div>
                                    <label for="recurring_location" class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="recurring_location" id="recurring_location" maxlength="255" value="{{ old('recurring_location') }}" placeholder="e.g., Office A201" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>

                                <!-- Notes -->
                                <div>
                                    <label for="recurring_notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <input type="text" name="recurring_notes" id="recurring_notes" maxlength="500" value="{{ old('recurring_notes') }}" placeholder="Any additional notes..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Slots Section -->
                    <div id="individual-slots-section">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Individual Time Slots</h3>

                        <!-- Slots Container -->
                        <div id="slots-container" class="space-y-6">
                            <div class="slot-card border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-sm font-semibold text-gray-900">Slot 1</h3>
                                    <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-700 text-sm font-medium" style="display: none;">Remove</button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Start Time -->
                                    <div>
                                        <label for="slots[0][start_time]" class="block text-sm font-medium text-gray-700">Start Time *</label>
                                        <input type="datetime-local" name="slots[0][start_time]" required value="{{ old('slots.0.start_time', now()->format('Y-m-d\T09:00')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                        @error('slots.0.start_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- End Time -->
                                    <div>
                                        <label for="slots[0][end_time]" class="block text-sm font-medium text-gray-700">End Time *</label>
                                        <input type="datetime-local" name="slots[0][end_time]" required value="{{ old('slots.0.end_time', now()->format('Y-m-d\T10:00')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                        @error('slots.0.end_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div>
                                        <label for="slots[0][location]" class="block text-sm font-medium text-gray-700">Location</label>
                                        <input type="text" name="slots[0][location]" maxlength="255" value="{{ old('slots.0.location') }}" placeholder="e.g., Office A201" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                        @error('slots.0.location')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Notes -->
                                    <div>
                                        <label for="slots[0][notes]" class="block text-sm font-medium text-gray-700">Notes</label>
                                        <input type="text" name="slots[0][notes]" maxlength="500" value="{{ old('slots.0.notes') }}" placeholder="Any additional notes..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                                        @error('slots.0.notes')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add More Slots Button -->
                        <button type="button" onclick="addSlot()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors mt-4">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Another Slot
                        </button>
                    </div>

                    <!-- Info Box -->
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900">Tips for Creating Slots</h3>
                                <ul class="mt-3 space-y-2 text-sm text-blue-800">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                        Set realistic time slots for your availability
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                        End time must be after start time
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                        You can create multiple slots at once
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                        Use location field to specify where consultations will be held
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-maroon-600 to-maroon-700 text-white text-sm font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:from-maroon-700 hover:to-maroon-800" id="submit-btn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
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

    function toggleRecurringForm() {
        const checkbox = document.getElementById('use-recurring');
        const recurringForm = document.getElementById('recurring-form');
        const individualSlotsSection = document.getElementById('individual-slots-section');
        
        console.log('Toggling recurring form:', checkbox.checked);
        
        if (checkbox.checked) {
            recurringForm.style.display = 'block';
            individualSlotsSection.style.display = 'none';
        } else {
            recurringForm.style.display = 'none';
            individualSlotsSection.style.display = 'block';
        }
    }

    function validateForm() {
        const checkbox = document.getElementById('use-recurring');
        
        try {
            if (checkbox.checked) {
                // Validate recurring form
                const startDate = document.getElementById('recurring_start_date').value;
                const startTime = document.getElementById('recurring_start_time').value;
                const endTime = document.getElementById('recurring_end_time').value;
                const weeks = document.getElementById('recurring_weeks').value;
                const daysCheckboxes = document.querySelectorAll('input[name="recurring_days[]"]:checked');
                
                console.log('Recurring validation:', { startDate, startTime, endTime, weeks, daysCount: daysCheckboxes.length });
                
                if (!startDate || !startTime || !endTime || !weeks) {
                    alert('Please fill in all required recurring fields');
                    return false;
                }
                
                if (daysCheckboxes.length === 0) {
                    alert('Please select at least one day of the week');
                    return false;
                }
                
                if (startTime >= endTime) {
                    alert('End time must be after start time');
                    return false;
                }
            } else {
                // Validate individual slots
                const startTimeInputs = document.querySelectorAll('input[name*="[start_time]"]');
                const endTimeInputs = document.querySelectorAll('input[name*="[end_time]"]');
                
                console.log('Individual slots validation:', { slotCount: startTimeInputs.length });
                
                if (startTimeInputs.length === 0) {
                    alert('Please add at least one slot');
                    return false;
                }
                
                for (let i = 0; i < startTimeInputs.length; i++) {
                    if (!startTimeInputs[i].value || !endTimeInputs[i].value) {
                        alert('Please fill in all start and end times');
                        return false;
                    }
                    
                    if (startTimeInputs[i].value >= endTimeInputs[i].value) {
                        alert('End time must be after start time for each slot');
                        return false;
                    }
                }
            }
            
            console.log('Form validation passed');
            return true;
        } catch (error) {
            console.error('Validation error:', error);
            return true; // Allow submission if validation fails unexpectedly
        }
    }

    function addSlot() {
        const container = document.getElementById('slots-container');
        const newSlot = document.createElement('div');
        newSlot.className = 'slot-card border border-gray-200 rounded-lg p-6 bg-gray-50';
        
        // Generate default datetime values
        const today = new Date();
        const dateStr = today.toISOString().slice(0, 10);
        const startTime = dateStr + 'T09:00';
        const endTime = dateStr + 'T10:00';
        
        newSlot.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-semibold text-gray-900">Slot ${slotCount + 1}</h3>
                <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-700 text-sm font-medium">Remove</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="slots[${slotCount}][start_time]" class="block text-sm font-medium text-gray-700">Start Time *</label>
                    <input type="datetime-local" name="slots[${slotCount}][start_time]" required value="${startTime}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                </div>

                <div>
                    <label for="slots[${slotCount}][end_time]" class="block text-sm font-medium text-gray-700">End Time *</label>
                    <input type="datetime-local" name="slots[${slotCount}][end_time]" required value="${endTime}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                </div>

                <div>
                    <label for="slots[${slotCount}][location]" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="slots[${slotCount}][location]" maxlength="255" placeholder="e.g., Office A201" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                </div>

                <div>
                    <label for="slots[${slotCount}][notes]" class="block text-sm font-medium text-gray-700">Notes</label>
                    <input type="text" name="slots[${slotCount}][notes]" maxlength="500" placeholder="Any additional notes..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-maroon-500 focus:ring-maroon-500 text-gray-900">
                </div>
            </div>
        `;
        container.appendChild(newSlot);
        slotCount++;
        updateRemoveButtons();
    }

    function removeSlot(button) {
        const card = button.closest('.slot-card');
        card.remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const cards = document.querySelectorAll('.slot-card');
        cards.forEach(card => {
            const removeBtn = card.querySelector('button[type="button"]');
            if (removeBtn && removeBtn.textContent.includes('Remove')) {
                removeBtn.style.display = cards.length > 1 ? 'block' : 'none';
            }
        });
    }

    // Call on page load
    updateRemoveButtons();
</script>
@endsection
