<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-900 leading-tight">Student Dashboard</h2>
                <p class="text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-maroon-500 to-maroon-700 rounded-2xl p-8 mb-8 text-white relative overflow-hidden shadow-lg">
                <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.15\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
                <div class="relative">
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}! 👋</h3>
                    @if(Auth::user()->student_id)
                        <p class="text-maroon-100">Student ID: <span class="font-mono font-semibold text-primary-300">{{ Auth::user()->student_id }}</span></p>
                    @endif
                    <p class="text-gray-200 mt-2 text-sm">Access your academic resources and stay updated below.</p>
                </div>
            </div>

            <!-- Quick Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('view.programs') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-500 p-6 h-full border border-transparent hover:border-maroon-100" style="transform: translateY(0); transition: transform 0.5s, box-shadow 0.5s;">
                        <div class="w-12 h-12 bg-gradient-to-br from-maroon-50 to-maroon-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">🎓</div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-maroon-600 transition-colors">View Programs</h4>
                        <p class="text-sm text-gray-500">Explore all academic programs offered by CEAT.</p>
                        <div class="mt-4 flex items-center text-maroon-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Explore
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('view.faculty') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-500 p-6 h-full border border-transparent hover:border-maroon-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">👥</div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-maroon-600 transition-colors">Faculty Directory</h4>
                        <p class="text-sm text-gray-500">Meet our distinguished faculty members.</p>
                        <div class="mt-4 flex items-center text-maroon-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Browse
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>



                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-500 p-6 h-full border border-transparent hover:border-maroon-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-sky-50 to-sky-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">📰</div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-maroon-600 transition-colors">News & Events</h4>
                        <p class="text-sm text-gray-500">Stay updated with the latest news and events.</p>
                        <div class="mt-4 flex items-center text-maroon-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Read
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('student.consultations.index') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-500 p-6 h-full border border-transparent hover:border-indigo-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">📋</div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">My Consultations</h4>
                        <p class="text-sm text-gray-500">Manage your consultation requests with advisors.</p>
                        <div class="mt-4 flex items-center text-indigo-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            View
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('student.consultations.create') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-500 p-6 h-full border border-transparent hover:border-purple-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">✏️</div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors">Request Consultation</h4>
                        <p class="text-sm text-gray-500">Submit a new consultation request to an advisor.</p>
                        <div class="mt-4 flex items-center text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Request
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
