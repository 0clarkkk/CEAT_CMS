@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Advisor Profile</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your advisor status and consultation information</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-900 dark:border-red-700 dark:text-red-200">
                <strong>Error!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-900 dark:border-red-700 dark:text-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- Advisor Status Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $faculty->full_name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $faculty->position ?? 'Faculty Member' }}</p>
                </div>
                <div>
                    @if ($faculty->is_advisor)
                        <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold dark:bg-green-900 dark:text-green-200">
                            ✓ Active Advisor
                        </span>
                    @else
                        <span class="inline-block px-4 py-2 bg-gray-100 text-gray-800 rounded-full font-semibold dark:bg-gray-700 dark:text-gray-300">
                            Inactive Advisor
                        </span>
                    @endif
                </div>
            </div>

            <hr class="my-6 border-gray-300 dark:border-gray-700">

            <!-- Advisor Information -->
            @if ($faculty->is_advisor)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Office Location</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $faculty->office_location ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Office Hours</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $faculty->office_hours ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Phone Number</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $faculty->phone_number ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Email</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $faculty->email }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Consultation Information</h3>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $faculty->consultation_info ?? 'Not set' }}</p>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">You are not currently listed as an advisor. Students cannot request consultations with you.</p>
                    <p class="text-gray-500 dark:text-gray-500 text-sm">To become an advisor, fill in your consultation information and activate your advisor status.</p>
                </div>
            @endif

            <hr class="my-6 border-gray-300 dark:border-gray-700">

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="{{ route('faculty.advisor-profile.edit') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('faculty.advisor-profile.toggle') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-{{ $faculty->is_advisor ? 'red' : 'green' }}-600 hover:bg-{{ $faculty->is_advisor ? 'red' : 'green' }}-700 text-white rounded-lg font-semibold transition">
                        {{ $faculty->is_advisor ? 'Deactivate Advisor Status' : 'Activate Advisor Status' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Back Link -->
        <div class="text-center">
            <a href="{{ route('student.dashboard') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
