@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">← Back to Consultation</a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Reject Consultation Request</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">From: {{ $consultation->student->name }}</p>
            </div>

            <div class="px-6 py-6">
                <form method="POST" action="{{ route('advisor.consultations.reject', $consultation->id) }}" class="space-y-6">
                    @csrf

                    <!-- Consultation Title (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultation Title</label>
                        <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md">
                            <p class="text-sm text-gray-900 dark:text-white">{{ $consultation->title }}</p>
                        </div>
                    </div>

                    <!-- Rejection Reason -->
                    <div>
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason for Rejection *</label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="6" required minlength="10" maxlength="500" placeholder="Please provide a clear reason for rejecting this consultation request..." class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('rejection_reason') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 10 characters, maximum 500 characters</p>
                        @error('rejection_reason')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Important:</h3>
                        <ul class="mt-2 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                            <li>The student will be notified of the rejection and the reason provided</li>
                            <li>The student can submit a new consultation request after reviewing the feedback</li>
                            <li>This action cannot be undone</li>
                        </ul>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('advisor.consultations.show', $consultation->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-red-500">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
