@extends('layouts.public')

@section('title', 'Downloadables')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Student Downloadables</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Introduction -->
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded mb-12">
            <p class="text-gray-700 leading-relaxed">
                Access important documents, forms, and resources for your academic journey. All files are available in PDF format 
                and can be downloaded for your reference or printed as needed.
            </p>
        </div>

        <!-- Forms & Applications -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="inline-block w-4 h-4 bg-maroon-600 rounded-full mr-3"></span>
                Forms & Applications
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-maroon-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Course Substitution Form</h3>
                            <p class="text-sm text-gray-600 mb-3">Request form for equivalent courses</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-maroon-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Leave of Absence Application</h3>
                            <p class="text-sm text-gray-600 mb-3">Apply for academic leave</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-maroon-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Change of Program Request</h3>
                            <p class="text-sm text-gray-600 mb-3">Transfer to a different engineering program</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-maroon-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Graduation Application</h3>
                            <p class="text-sm text-gray-600 mb-3">Apply for graduation ceremony</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Academic Guidelines -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="inline-block w-4 h-4 bg-maroon-600 rounded-full mr-3"></span>
                Academic Guidelines & Policies
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-yellow-400">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Student Handbook</h3>
                            <p class="text-sm text-gray-600 mb-3">Complete guide to student policies and procedures</p>
                        </div>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-yellow-400">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Academic Calendar 2024-2025</h3>
                            <p class="text-sm text-gray-600 mb-3">Important dates and academic schedule</p>
                        </div>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-yellow-400">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Grading System & GPA Calculation</h3>
                            <p class="text-sm text-gray-600 mb-3">How grades are calculated and the GPA system</p>
                        </div>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-yellow-400">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Scholarship & Financial Aid Guide</h3>
                            <p class="text-sm text-gray-600 mb-3">Information about available scholarships</p>
                        </div>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Lab & Safety Manuals -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="inline-block w-4 h-4 bg-maroon-600 rounded-full mr-3"></span>
                Lab & Safety Manuals
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-red-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Laboratory Safety Manual</h3>
                            <p class="text-sm text-gray-600 mb-3">Essential safety procedures for all labs</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-red-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Chemical Safety Guide</h3>
                            <p class="text-sm text-gray-600 mb-3">Guidelines for handling chemicals safely</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-red-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Equipment Operation Manual</h3>
                            <p class="text-sm text-gray-600 mb-3">Instructions for major equipment operation</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition-shadow border-l-4 border-red-600">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Emergency Procedures Guide</h3>
                            <p class="text-sm text-gray-600 mb-3">What to do in case of emergency</p>
                        </div>
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">PDF</span>
                    </div>
                    <a href="#" class="inline-flex items-center text-maroon-600 hover:text-maroon-700 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="bg-gray-50 rounded-lg p-8 border-l-4 border-blue-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Need Help?</h2>
            <p class="text-gray-700 mb-4">
                If you cannot find the document you need or have questions about any of these resources, 
                please contact the Student Services Office:
            </p>
            <div class="bg-white p-4 rounded-lg">
                <p class="text-gray-700"><strong>Student Services Office</strong></p>
                <p class="text-gray-700">Email: studentservices@uphsl.edu.ph</p>
                <p class="text-gray-700">Phone: (02) 1234-5678</p>
                <p class="text-gray-700">Office Hours: Monday - Friday, 8:00 AM - 5:00 PM</p>
            </div>
        </div>
    </div>
</div>
@endsection
