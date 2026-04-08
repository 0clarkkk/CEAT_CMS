@extends('layouts.public')

@section('title', 'Consultation Hours')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Faculty Consultation Hours</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Introduction -->
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded mb-12">
            <p class="text-gray-700 leading-relaxed">
                Our faculty members are available during consultation hours to assist students with academic matters, 
                course guidance, and personal concerns. Please check each faculty member's schedule below and plan your visit accordingly.
            </p>
        </div>

        <!-- Filter/Search -->
        <div class="mb-8 flex flex-col sm:flex-row gap-4">
            <input type="text" placeholder="Search faculty name..." 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-maroon-600">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-maroon-600">
                <option value="">All Departments</option>
                <option value="civil">Civil Engineering</option>
                <option value="electrical">Electrical Engineering</option>
                <option value="mechanical">Mechanical Engineering</option>
                <option value="architecture">Architecture</option>
            </select>
        </div>

        <!-- Faculty Consultation Schedule Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Faculty Card 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Engr. Maria Santos</h3>
                    <p class="text-maroon-100 text-sm">Civil Engineering</p>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">OFFICE LOCATION</p>
                        <p class="text-gray-700">Civil Engineering Building, Room 201</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONSULTATION HOURS</p>
                        <div class="space-y-1 text-gray-700 text-sm">
                            <p>Monday & Wednesday: 2:00 PM - 5:00 PM</p>
                            <p>Tuesday & Thursday: 9:00 AM - 12:00 PM</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONTACT</p>
                        <p class="text-gray-700 text-sm">m.santos@uphsl.edu.ph</p>
                    </div>
                    <a href="mailto:m.santos@uphsl.edu.ph" class="inline-block mt-4 px-4 py-2 bg-maroon-600 text-white rounded-lg hover:bg-maroon-700 transition-colors">
                        Send Email
                    </a>
                </div>
            </div>

            <!-- Faculty Card 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Engr. Juan Reyes</h3>
                    <p class="text-maroon-100 text-sm">Electrical Engineering</p>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">OFFICE LOCATION</p>
                        <p class="text-gray-700">Electrical Engineering Building, Room 305</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONSULTATION HOURS</p>
                        <div class="space-y-1 text-gray-700 text-sm">
                            <p>Monday, Wednesday & Friday: 1:00 PM - 3:00 PM</p>
                            <p>Tuesday & Thursday: 10:00 AM - 12:00 PM</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONTACT</p>
                        <p class="text-gray-700 text-sm">j.reyes@uphsl.edu.ph</p>
                    </div>
                    <a href="mailto:j.reyes@uphsl.edu.ph" class="inline-block mt-4 px-4 py-2 bg-maroon-600 text-white rounded-lg hover:bg-maroon-700 transition-colors">
                        Send Email
                    </a>
                </div>
            </div>

            <!-- Faculty Card 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Engr. Roberto Cruz</h3>
                    <p class="text-maroon-100 text-sm">Mechanical Engineering</p>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">OFFICE LOCATION</p>
                        <p class="text-gray-700">Mechanical Engineering Building, Room 102</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONSULTATION HOURS</p>
                        <div class="space-y-1 text-gray-700 text-sm">
                            <p>Tuesday & Thursday: 2:00 PM - 4:00 PM</p>
                            <p>Friday: 9:00 AM - 12:00 PM</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONTACT</p>
                        <p class="text-gray-700 text-sm">r.cruz@uphsl.edu.ph</p>
                    </div>
                    <a href="mailto:r.cruz@uphsl.edu.ph" class="inline-block mt-4 px-4 py-2 bg-maroon-600 text-white rounded-lg hover:bg-maroon-700 transition-colors">
                        Send Email
                    </a>
                </div>
            </div>

            <!-- Faculty Card 4 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Arch. Patricia Lim</h3>
                    <p class="text-maroon-100 text-sm">Architecture</p>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">OFFICE LOCATION</p>
                        <p class="text-gray-700">Architecture Building, Room 401</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONSULTATION HOURS</p>
                        <div class="space-y-1 text-gray-700 text-sm">
                            <p>Monday & Friday: 10:00 AM - 1:00 PM</p>
                            <p>Wednesday: 2:00 PM - 5:00 PM</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 font-semibold mb-2">CONTACT</p>
                        <p class="text-gray-700 text-sm">p.lim@uphsl.edu.ph</p>
                    </div>
                    <a href="mailto:p.lim@uphsl.edu.ph" class="inline-block mt-4 px-4 py-2 bg-maroon-600 text-white rounded-lg hover:bg-maroon-700 transition-colors">
                        Send Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Guidelines Section -->
        <div class="mt-12 bg-gray-50 rounded-lg p-8 border-l-4 border-yellow-400">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Consultation Guidelines</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span><strong>Be On Time:</strong> Arrive at the scheduled time to respect the faculty member's schedule</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span><strong>Come Prepared:</strong> Bring relevant materials or questions to make the most of your consultation</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span><strong>Respect Confidentiality:</strong> Keep discussions confidential and professional</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span><strong>Email in Advance:</strong> For complex issues, email ahead to request a consultation appointment</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span><strong>Virtual Consultations:</strong> Available via Zoom or Teams upon request</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
