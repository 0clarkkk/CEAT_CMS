@extends('layouts.public')

@section('title', 'Mission & Vision')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Mission & Vision</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- Mission Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border-l-4 border-maroon-600">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Our Mission</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        To produce globally competitive engineers and architects equipped with technical expertise, 
                        moral values, and environmental consciousness, committed to advancing technology and society 
                        through innovation, collaboration, and ethical practice.
                    </p>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border-l-4 border-yellow-400">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-900">Our Vision</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        To be a center of excellence in engineering and architectural education recognized nationally 
                        and internationally for innovation, sustainability, and meaningful service to society and industry.
                    </p>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="bg-gray-50 rounded-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Core Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Excellence -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-maroon-600 rounded-full flex items-center justify-center text-white text-xl">⭐</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Excellence</h3>
                    </div>
                    <p class="text-gray-600">
                        Commitment to high-quality education, research, and professional practice in all endeavors.
                    </p>
                </div>

                <!-- Integrity -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-gray-900 text-xl">✓</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Integrity</h3>
                    </div>
                    <p class="text-gray-600">
                        Ethical conduct and honesty in all professional and personal interactions.
                    </p>
                </div>

                <!-- Innovation -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-maroon-600 rounded-full flex items-center justify-center text-white text-xl">💡</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Innovation</h3>
                    </div>
                    <p class="text-gray-600">
                        Continuous advancement of knowledge and technology through creative thinking and research.
                    </p>
                </div>

                <!-- Sustainability -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-gray-900 text-xl">🌱</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Sustainability</h3>
                    </div>
                    <p class="text-gray-600">
                        Environmental responsibility and stewardship in engineering and architectural practice.
                    </p>
                </div>

                <!-- Service -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-maroon-600 rounded-full flex items-center justify-center text-white text-xl">🤝</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Service</h3>
                    </div>
                    <p class="text-gray-600">
                        Dedicated commitment to community development and societal needs through our expertise.
                    </p>
                </div>

                <!-- Collaboration -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-gray-900 text-xl">🔗</div>
                        <h3 class="text-lg font-bold text-gray-900 ml-4">Collaboration</h3>
                    </div>
                    <p class="text-gray-600">
                        Working together with students, faculty, industry, and community partners for mutual success.
                    </p>
                </div>
            </div>
        </div>

        <!-- Strategic Objectives -->
        <div class="bg-white border-l-4 border-maroon-600 p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Strategic Objectives</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Deliver high-quality, accredited programs that meet international standards</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Foster a culture of research, innovation, and entrepreneurship</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Develop students' technical and soft skills for industry readiness</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Strengthen partnerships with industry, government, and international institutions</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Promote sustainable and socially responsible engineering practices</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
