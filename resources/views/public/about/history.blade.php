@extends('layouts.public')

@section('title', 'College History')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">College History</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Timeline -->
        <div class="space-y-8">
            <!-- Timeline Item 2000 -->
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-maroon-600 flex items-center justify-center text-white font-bold">
                        1
                    </div>
                    <div class="w-1 h-24 bg-yellow-400"></div>
                </div>
                <div class="pb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2000 - Establishment</h3>
                    <p class="text-gray-700">
                        The College of Engineering was established as part of University of Perpetual Help System DALTA's 
                        expansion into professional engineering education.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2005 -->
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-maroon-600 flex items-center justify-center text-white font-bold">
                        2
                    </div>
                    <div class="w-1 h-24 bg-yellow-400"></div>
                </div>
                <div class="pb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2005 - ABET Accreditation</h3>
                    <p class="text-gray-700">
                        Our engineering programs achieved international recognition through ABET accreditation, 
                        marking a significant milestone in academic excellence.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2010 -->
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-maroon-600 flex items-center justify-center text-white font-bold">
                        3
                    </div>
                    <div class="w-1 h-24 bg-yellow-400"></div>
                </div>
                <div class="pb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2010 - Architecture Program Launch</h3>
                    <p class="text-gray-700">
                        The College expanded its offerings by launching the Architecture program, strengthening 
                        our commitment to design and built environment education.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2015 -->
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-maroon-600 flex items-center justify-center text-white font-bold">
                        4
                    </div>
                    <div class="w-1 h-24 bg-yellow-400"></div>
                </div>
                <div class="pb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2015 - Research Center Establishment</h3>
                    <p class="text-gray-700">
                        The establishment of our research centers elevated our focus on innovation and 
                        contribution to engineering science and technology.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2020 -->
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-maroon-600 flex items-center justify-center text-white font-bold">
                        5
                    </div>
                </div>
                <div class="pb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2020 - Digital Transformation</h3>
                    <p class="text-gray-700">
                        The College adapted to modern educational needs by implementing comprehensive digital learning 
                        platforms while maintaining academic rigor.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
