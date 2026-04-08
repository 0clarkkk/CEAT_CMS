@extends('layouts.public')

@section('title', 'Curriculum')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Curriculum Overview</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Introduction -->
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded mb-12">
            <p class="text-gray-700 leading-relaxed">
                Our comprehensive curriculum is designed to provide students with a strong foundation in engineering 
                principles, practical skills, and professional competencies. Programs are regularly updated to align 
                with industry standards and accreditation requirements.
            </p>
        </div>

        <!-- Program Curricula -->
        <div class="space-y-8">
            <!-- Civil Engineering -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Civil Engineering</h2>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Core Subjects:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 mb-6">
                        <li>• Engineering Mathematics</li>
                        <li>• Structural Analysis</li>
                        <li>• Hydraulics & Hydrology</li>
                        <li>• Geotechnical Engineering</li>
                        <li>• Construction Management</li>
                        <li>• Transportation Engineering</li>
                        <li>• Environmental Engineering</li>
                        <li>• Professional Practice</li>
                    </ul>
                    <p class="text-sm text-gray-600">
                        <strong>Duration:</strong> 4 years | <strong>Units:</strong> 150 | <strong>Licensure Exam:</strong> BECE (Board Exam for Civil Engineers)
                    </p>
                </div>
            </div>

            <!-- Electrical Engineering -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Electrical Engineering</h2>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Core Subjects:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 mb-6">
                        <li>• Circuit Theory</li>
                        <li>• Electromagnetic Fields</li>
                        <li>• Power Systems</li>
                        <li>• Electric Machines</li>
                        <li>• Control Systems</li>
                        <li>• Electronics</li>
                        <li>• Communications Systems</li>
                        <li>• Professional Practice</li>
                    </ul>
                    <p class="text-sm text-gray-600">
                        <strong>Duration:</strong> 4 years | <strong>Units:</strong> 150 | <strong>Licensure Exam:</strong> BELE (Board Exam for Electrical Engineers)
                    </p>
                </div>
            </div>

            <!-- Mechanical Engineering -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Mechanical Engineering</h2>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Core Subjects:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 mb-6">
                        <li>• Thermodynamics</li>
                        <li>• Fluid Mechanics</li>
                        <li>• Machine Design</li>
                        <li>• Manufacturing Processes</li>
                        <li>• Heat Transfer</li>
                        <li>• Control Systems</li>
                        <li>• Power Plant Engineering</li>
                        <li>• Professional Practice</li>
                    </ul>
                    <p class="text-sm text-gray-600">
                        <strong>Duration:</strong> 4 years | <strong>Units:</strong> 150 | <strong>Licensure Exam:</strong> BEME (Board Exam for Mechanical Engineers)
                    </p>
                </div>
            </div>

            <!-- Architecture -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Architecture</h2>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Core Subjects:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 mb-6">
                        <li>• Architectural Design</li>
                        <li>• Building Construction</li>
                        <li>• Structural Design for Architecture</li>
                        <li>• Urban Design & Planning</li>
                        <li>• Environmental Design</li>
                        <li>• Heritage Conservation</li>
                        <li>• Professional Practice</li>
                        <li>• History of Architecture</li>
                    </ul>
                    <p class="text-sm text-gray-600">
                        <strong>Duration:</strong> 5 years | <strong>Units:</strong> 180 | <strong>Licensure Exam:</strong> BALE (Board Exam for Architects)
                    </p>
                </div>
            </div>
        </div>

        <!-- General Education -->
        <div class="mt-12 bg-gray-50 rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">General Education Requirements</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                All engineering and architecture students complete general education courses including:
            </p>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 text-gray-700">
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>English Communication</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>Filipino/Rizal Studies</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>Mathematics & Sciences</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>Social Sciences</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>Ethics & Morals</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                    <span>Physical Education</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
