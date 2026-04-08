@extends('layouts.public')

@section('title', 'The College')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">The College</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- About Content -->
        <div class="prose prose-lg max-w-none">
            <p class="text-gray-700 leading-relaxed mb-6">
                The College of Engineering, Architecture and Technology (CEAT) at University of Perpetual Help System DALTA 
                is dedicated to providing quality education in engineering, architecture, and technological innovation.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Our Mission</h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                To produce globally competitive engineers and architects equipped with technical expertise, moral values, 
                and environmental consciousness.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Our Vision</h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                To be a center of excellence in engineering and architectural education recognized for innovation, 
                sustainability, and service to society.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Core Values</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700 mb-6">
                <li><strong>Excellence:</strong> Commitment to high-quality education and practice</li>
                <li><strong>Integrity:</strong> Ethical conduct in all endeavors</li>
                <li><strong>Innovation:</strong> Advancing knowledge and technology</li>
                <li><strong>Sustainability:</strong> Environmental responsibility and stewardship</li>
                <li><strong>Service:</strong> Dedicated to community development</li>
            </ul>

            <p class="text-gray-700 leading-relaxed">
                For more information about our programs and offerings, please explore our website or contact the college office.
            </p>
        </div>
    </div>
</div>
@endsection
