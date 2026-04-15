@extends('layouts.public')

@section('title', 'Downloads')

@section('content')
<div class="bg-gradient-to-b from-maroon-50 to-white" style="padding-top: 120px; padding-bottom: 80px;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Downloadable Forms</h1>
            <div class="h-1 w-32 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
            <p class="text-lg text-gray-600 mt-6 max-w-2xl">Access important documents and forms organized by category for your convenience.</p>
        </div>

        @if($categories->count() > 0)
            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('view.downloads.category', $category->slug) }}" class="group">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border-l-4 border-l-maroon-600 h-full">
                            <div class="p-6">
                                @if($category->icon)
                                    <div class="mb-4">
                                        <svg class="w-12 h-12 text-maroon-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors">
                                    {{ $category->name }}
                                </h3>
                                
                                @if($category->description)
                                    <p class="text-gray-600 text-sm mb-4">{{ $category->description }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $category->forms->count() }} {{ Str::plural('form', $category->forms->count()) }}
                                    </span>
                                    <svg class="w-5 h-5 text-maroon-600 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 text-yellow-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Forms Available</h3>
                <p class="text-gray-600">Downloadable forms will be added soon. Please check back later.</p>
            </div>
        @endif
    </div>
</div>
@endsection
