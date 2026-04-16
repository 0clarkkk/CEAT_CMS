@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Request Consultation</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Submit a consultation request to a faculty advisor</p>
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

                <form method="POST" action="{{ route('student.consultations.store') }}" class="space-y-6">
                    @csrf

                    <!-- Advisor Selection -->
                    <div>
                        <label for="advisor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Faculty Advisor *</label>
                        <select id="advisor_id" name="advisor_id" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Select an advisor --</option>
                            @foreach($advisors as $advisor)
                                <option value="{{ $advisor->id }}" @selected(old('advisor_id') == $advisor->id)>{{ $advisor->name }}</option>
                            @endforeach
                        </select>
                        @error('advisor_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultation Title *</label>
                        <input type="text" id="title" name="title" required maxlength="255" value="{{ old('title') }}" placeholder="e.g., Course Registration Help" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultation Category *</label>
                        <select id="category" name="category" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Select a category --</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" @selected(old('category') == $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description *</label>
                        <textarea id="description" name="description" rows="6" required maxlength="1000" placeholder="Provide details about your consultation request..." class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 10 characters, maximum 1000 characters</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Notes (Optional) -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Additional Notes (Optional)</label>
                        <textarea id="notes" name="notes" rows="3" maxlength="500" placeholder="Any other information you'd like to provide..." class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maximum 500 characters</p>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('student.consultations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-indigo-500">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4">
            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">How it works:</h3>
            <ul class="mt-2 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                <li>Submit your consultation request with relevant details</li>
                <li>Your advisor will review and approve or reject the request</li>
                <li>Once approved, the advisor will schedule a time slot</li>
                <li>You'll be notified of the scheduled consultation</li>
                <li>You can cancel anytime before the consultation</li>
            </ul>
        </div>
    </div>
</div>
@endsection
