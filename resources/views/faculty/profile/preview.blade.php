@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Profile Preview</h1>
                    <p class="mt-2 text-gray-600">This is how your profile appears to students</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profile
                    </a>
                    <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Cover background -->
            <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

            <!-- Profile Content -->
            <div class="px-6 pb-6">
                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row md:items-end md:space-x-6 -mt-16 mb-6">
                    <!-- Photo -->
                    <div class="flex-shrink-0 mb-4 md:mb-0">
                        @if($faculty->photo)
                            <img src="{{ Storage::url($faculty->photo) }}" alt="{{ $faculty->full_name }}" 
                                class="w-32 h-32 rounded-lg object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-lg bg-gray-200 border-4 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Name and Title -->
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $faculty->full_name }}</h1>
                        @if($faculty->position)
                            <p class="text-lg text-blue-600 font-medium">{{ $faculty->position }}</p>
                        @endif
                        @if($faculty->specialization)
                            <p class="text-gray-600">{{ $faculty->specialization }}</p>
                        @endif
                    </div>

                    <!-- Contact Info -->
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:{{ $faculty->email }}" class="hover:text-blue-600">{{ $faculty->email }}</a>
                        </div>
                        @if($faculty->phone_number)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.756l2.048 1.029a2 2 0 002.063-.41l3.799-3.799a1 1 0 00-.364-1.635L16.666 2.75a1 1 0 00-.932.221l-.822.822A15.988 15.988 0 002.166 6.07A1 1 0 001 7.14V11a2 2 0 002 2h2.285a1 1 0 00.982-.6l1.566-3.73a1 1 0 00-.023-.957L5.354 5.697a2 2 0 00-2.16-.505L2.034 5.978A14.988 14.988 0 001.166 6.07"/></svg>
                            {{ $faculty->phone_number }}
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-6">

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left Column - Main Info -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Biography -->
                        @if($faculty->biography)
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-3">About</h2>
                                <div class="prose prose-sm max-w-none">
                                    <p class="text-gray-700 leading-relaxed">{{ $faculty->biography }}</p>
                                </div>
                            </section>
                        @endif

                        <!-- Education -->
                        @if($faculty->education_display)
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-3">Education</h2>
                                <ul class="space-y-3">
                                    @foreach(explode("\n", $faculty->education_display) as $edu)
                                        @if(trim($edu))
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L9 4.414V16a1 1 0 102 0V4.414l6.293 6.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                                                <span class="text-gray-700">{{ trim($edu) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </section>
                        @endif

                        <!-- Research Interests -->
                        @if($faculty->research_interests_display)
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-3">Research Interests</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_map('trim', explode(',', $faculty->research_interests_display)) as $interest)
                                        @if($interest)
                                            <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                                                {{ $interest }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- Publications -->
                        @if($faculty->publications_display)
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-3">Recent Publications</h2>
                                <ul class="space-y-3">
                                    @foreach(explode("\n", $faculty->publications_display) as $pub)
                                        @if(trim($pub))
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-indigo-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/></svg>
                                                <span class="text-gray-700">{{ trim($pub) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </div>

                    <!-- Right Column - Contact & Advisor Info -->
                    <div class="md:col-span-1">
                        <!-- Office Information -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-gray-900 mb-3">Office Information</h3>
                            <div class="space-y-3 text-sm">
                                @if($faculty->office_location)
                                    <div>
                                        <p class="text-gray-600">Location</p>
                                        <p class="text-gray-900 font-medium">{{ $faculty->office_location }}</p>
                                    </div>
                                @endif
                                @if($faculty->office_hours)
                                    <div>
                                        <p class="text-gray-600">Office Hours</p>
                                        <p class="text-gray-900 font-medium">{{ $faculty->office_hours }}</p>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-gray-600">Email</p>
                                    <p class="text-gray-900 font-medium break-all">{{ $faculty->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Advisor Section -->
                        @if($faculty->is_advisor && $faculty->is_advisor_visible)
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    <h3 class="font-semibold text-gray-900">Academic Advisor</h3>
                                </div>
                                
                                @if($faculty->advisor_bio)
                                    <p class="text-sm text-gray-700 mb-4">{{ $faculty->advisor_bio }}</p>
                                @endif

                                <div class="space-y-2 text-sm mb-4">
                                    <div>
                                        <p class="text-gray-600">Consultation Duration</p>
                                        <p class="text-gray-900 font-medium">{{ $faculty->default_consultation_duration }} minutes</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Cancellation Policy</p>
                                        <p class="text-gray-900 font-medium">{{ $faculty->cancellation_deadline_hours }} hours notice required</p>
                                    </div>
                                </div>

                                <a href="#" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                    Request Consultation
                                </a>
                            </div>
                        @elseif($faculty->is_advisor && !$faculty->is_advisor_visible)
                            <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                                <p class="text-sm text-gray-600 text-center">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.604-1.273A9.973 9.973 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                    Advisor profile is currently hidden from students
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="mt-8 bg-amber-50 border border-amber-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-amber-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="font-medium text-amber-900">Note</p>
                    <p class="text-sm text-amber-800 mt-1">This is a preview of how your profile appears to students. Return to edit your profile to make any changes.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
