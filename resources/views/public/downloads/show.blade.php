@extends('layouts.public')

@section('title', $downloadCategory->name . ' - Downloads')

@section('content')
<div class="bg-gradient-to-b from-maroon-50 to-white" style="padding-top: 120px; padding-bottom: 80px;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <a href="{{ route('view.downloads') }}" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 mb-8 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Downloads
        </a>

        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">{{ $downloadCategory->name }}</h1>
            <div class="h-1 w-32 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
            @if($downloadCategory->description)
                <p class="text-lg text-gray-600 mt-6 max-w-2xl">{{ $downloadCategory->description }}</p>
            @endif
        </div>

        @if($forms->count() > 0)
            <!-- Forms List -->
            <div class="space-y-4">
                @foreach($forms as $form)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-l-maroon-600 overflow-hidden">
                        <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <!-- Left Section -->
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <!-- Icon -->
                                    <div class="flex-shrink-0">
                                        @if(strtolower($form->file_type) === 'pdf')
                                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M5 4v12h10V4H5zm2 2h6v8H7V6z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1 break-words">{{ $form->title }}</h3>
                                        @if($form->description)
                                            <p class="text-gray-600 text-sm mb-2">{{ $form->description }}</p>
                                        @endif
                                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                            <span class="bg-gray-100 px-3 py-1 rounded-full font-semibold text-gray-700">
                                                {{ strtoupper($form->file_type) }}
                                            </span>
                                            @if($form->file_size)
                                                <span>{{ $form->formatted_file_size }}</span>
                                            @endif
                                            <span>
                                                {{ $form->download_count }} {{ Str::plural('download', $form->download_count) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Download Button -->
                            <div class="flex-shrink-0">
                                <a href="{{ route('download.form', $form) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-maroon-600 hover:bg-maroon-700 text-white font-semibold rounded-lg transition-colors whitespace-nowrap">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 text-yellow-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Forms in This Category</h3>
                <p class="text-gray-600">This category doesn't have any forms yet. Please check back later.</p>
            </div>
        @endif
    </div>
</div>
@endsection
