@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Edit Advisor Profile</h1>
            <p class="text-gray-600 dark:text-gray-400">Update your consultation information and availability</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-900 dark:border-red-700 dark:text-red-200">
                <strong>Please fix the following errors:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('faculty.advisor-profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Advisor Status Toggle -->
                <div class="pb-6 border-b border-gray-300 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-lg font-semibold text-gray-900 dark:text-white">Advisor Status</label>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                @if ($faculty->is_advisor)
                                    You are currently an active advisor
                                @else
                                    You are not currently an advisor
                                @endif
                            </p>
                        </div>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_advisor" value="1" 
                                {{ $faculty->is_advisor ? 'checked' : '' }}
                                class="w-6 h-6 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        </label>
                    </div>
                </div>

                <!-- Consultation Info -->
                <div>
                    <label for="consultation_info" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3">
                        Consultation Information <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Describe the types of consultation you offer, your expertise, and what students can expect.
                    </p>
                    <textarea name="consultation_info" id="consultation_info" rows="6"
                        placeholder="e.g., I offer guidance on database design, software architecture, and internship preparation. I have 10+ years of industry experience..."
                        class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('consultation_info') border-red-500 @enderror">{{ old('consultation_info', $faculty->consultation_info) }}</textarea>
                    @error('consultation_info')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Office Location -->
                <div>
                    <label for="office_location" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3">
                        Office Location <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="office_location" id="office_location"
                        placeholder="e.g., Building A, Room 305"
                        value="{{ old('office_location', $faculty->office_location) }}"
                        class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('office_location') border-red-500 @enderror">
                    @error('office_location')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Office Hours -->
                <div>
                    <label for="office_hours" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3">
                        Office Hours <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        When are you available for student consultations?
                    </p>
                    <input type="text" name="office_hours" id="office_hours"
                        placeholder="e.g., Monday & Wednesday 2:00 PM - 5:00 PM, Friday 10:00 AM - 12:00 PM"
                        value="{{ old('office_hours', $faculty->office_hours) }}"
                        class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('office_hours') border-red-500 @enderror">
                    @error('office_hours')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3">
                        Phone Number
                    </label>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Optional contact number for students to reach you
                    </p>
                    <input type="tel" name="phone_number" id="phone_number"
                        placeholder="e.g., +1 (555) 123-4567"
                        value="{{ old('phone_number', $faculty->phone_number) }}"
                        class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('phone_number') border-red-500 @enderror">
                    @error('phone_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-6 border-gray-300 dark:border-gray-700">

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                        Save Changes
                    </button>
                    <a href="{{ route('faculty.advisor-profile.show') }}" class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-900 rounded-lg font-semibold transition text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="{{ route('faculty.advisor-profile.show') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold">
                ← Back to Profile
            </a>
        </div>
    </div>
</div>

<script>
    // Toggle field requirements based on advisor status
    document.querySelector('input[name="is_advisor"]').addEventListener('change', function() {
        const isAdvisor = this.checked;
        document.querySelector('input[name="office_location"]').required = isAdvisor;
        document.querySelector('textarea[name="consultation_info"]').required = isAdvisor;
        document.querySelector('input[name="office_hours"]').required = isAdvisor;
    });

    // Initial state
    window.addEventListener('DOMContentLoaded', function() {
        const isAdvisor = document.querySelector('input[name="is_advisor"]').checked;
        document.querySelector('input[name="office_location"]').required = isAdvisor;
        document.querySelector('textarea[name="consultation_info"]').required = isAdvisor;
        document.querySelector('input[name="office_hours"]').required = isAdvisor;
    });
</script>
@endsection
