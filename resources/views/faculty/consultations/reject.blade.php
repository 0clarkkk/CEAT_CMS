@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Reject Consultation</h1>
                    <p class="mt-2 text-sm text-gray-600">Provide a reason for rejection</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-orange-50">
                <h2 class="text-lg font-semibold text-gray-900">Consultation: {{ $consultation->title }}</h2>
                <p class="text-sm text-gray-600 mt-1">Student: {{ $consultation->student?->name }}</p>
            </div>

            <form action="{{ route('faculty.consultations.reject', $consultation->id) }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="rejection_reason" class="block text-sm font-semibold text-gray-700 mb-2">Reason for Rejection</label>
                    <textarea 
                        id="rejection_reason" 
                        name="rejection_reason" 
                        rows="6"
                        placeholder="Please explain why you are rejecting this consultation request. Be professional and constructive."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                        required>{{ old('rejection_reason') }}</textarea>
                    @error('rejection_reason')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-900">
                        <strong>Note:</strong> The student will be notified of the rejection along with your reason. Be clear and helpful so they understand how to proceed.
                    </p>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('faculty.consultations.show', $consultation->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Reject Consultation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
