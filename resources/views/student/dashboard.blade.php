{{-- Student Dashboard
     Main landing page for authenticated students.
     Shows a welcome banner and quick-link cards to explore programs,
     faculty, news, consultations, and new consultation requests.
     Color scheme: tangerine (orange), white, gray.
--}}
<x-app-layout>
    {{-- Page Header — avatar initials + title --}}
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-tangerine-400 to-tangerine-600 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-md">
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

            {{-- Welcome Banner — filled gradient with decorative SVG pattern --}}
            <div class="bg-gradient-to-r from-tangerine-500 to-tangerine-700 rounded-2xl p-8 mb-8 text-white relative overflow-hidden shadow-lg">
                {{-- Subtle cross pattern overlay --}}
                <div class="absolute inset-0 opacity-10"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.15\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
                </div>
                <div class="relative">
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!
                        {{-- Sparkle icon --}}
                        <svg class="w-6 h-6 inline-block animate-bounce" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z" />
                        </svg>
                    </h3>
                    @if(Auth::user()->student_id)
                        <p class="text-tangerine-100">Student ID: <span class="font-mono font-semibold text-white">{{ Auth::user()->student_id }}</span></p>
                    @endif
                    <p class="text-orange-100 mt-2 text-sm">Access your academic resources and stay updated below.</p>
                </div>
            </div>

            {{-- Quick Links Grid — 5 cards in a responsive grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- Card: View Programs --}}
                <a href="{{ route('view.programs') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 h-full border border-gray-100 hover:border-tangerine-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-tangerine-50 to-tangerine-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-tangerine-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.584 2.17a.75.75 0 01.832 0l9.25 5.25a.75.75 0 010 1.31l-9.25 5.25a.75.75 0 01-.832 0l-9.25-5.25a.75.75 0 010-1.31l9.25-5.25z" />
                                <path d="M21.25 10.155a.75.75 0 00-1.06-.063l-8.606 7.961L3.06 10.155a.75.75 0 10-1.026 1.09l9.106 8.423a.75.75 0 001.02 0l9.106-8.423a.75.75 0 00-.016-1.09z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-tangerine-600 transition-colors">View Programs</h4>
                        <p class="text-sm text-gray-500">Explore all academic programs offered by CEAT.</p>
                        <div class="mt-4 flex items-center text-tangerine-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Explore
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card: Faculty Directory --}}
                <a href="{{ route('view.faculty') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 h-full border border-gray-100 hover:border-tangerine-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z" />
                                <path d="M19.228 15.54a4.878 4.878 0 00-4.596-5.415 5.25 5.25 0 113.626 5.54c.328.093.66.19 1 .286l.006.002.35.1a7.834 7.834 0 00-.386-.513z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-tangerine-600 transition-colors">Faculty Directory</h4>
                        <p class="text-sm text-gray-500">Meet our distinguished faculty members.</p>
                        <div class="mt-4 flex items-center text-tangerine-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Browse
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card: News & Events --}}
                <a href="{{ route('view.news') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 h-full border border-gray-100 hover:border-tangerine-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-tangerine-50 to-tangerine-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-tangerine-500" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zm.75 3.375a.375.375 0 01.375-.375h1.125a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375H5.25a.375.375 0 01-.375-.375v-1.5zm0 4.5a.375.375 0 01.375-.375h1.125a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375H5.25a.375.375 0 01-.375-.375v-1.5zm0 4.5a.375.375 0 01.375-.375h1.125a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375H5.25a.375.375 0 01-.375-.375v-1.5zm9-9a.375.375 0 01.375-.375h1.5a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375h-1.5a.375.375 0 01-.375-.375v-1.5zm0 4.5a.375.375 0 01.375-.375h1.5a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375h-1.5a.375.375 0 01-.375-.375v-1.5zm0 4.5a.375.375 0 01.375-.375h1.5a.375.375 0 01.375.375v1.5a.375.375 0 01-.375.375h-1.5a.375.375 0 01-.375-.375v-1.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-tangerine-600 transition-colors">News & Events</h4>
                        <p class="text-sm text-gray-500">Stay updated with the latest news and events.</p>
                        <div class="mt-4 flex items-center text-tangerine-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Read
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card: My Consultations --}}
                <a href="{{ route('student.consultations.index') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 h-full border border-gray-100 hover:border-tangerine-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M10.5 3A1.5 1.5 0 009 4.5v.75a1.5 1.5 0 001.5 1.5h3A1.5 1.5 0 0015 5.25v-.75A1.5 1.5 0 0013.5 3h-3zm-6.75 3a1.5 1.5 0 00-1.5 1.5v13.5a1.5 1.5 0 001.5 1.5h16.5a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5h-4.236a3 3 0 01-5.528 0H3.75zm12 4.5a.75.75 0 010 1.5h-7.5a.75.75 0 010-1.5h7.5zm0 4.5a.75.75 0 010 1.5h-7.5a.75.75 0 010-1.5h7.5zm-7.5 4.5a.75.75 0 010-1.5h4.5a.75.75 0 010 1.5h-4.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-tangerine-600 transition-colors">My Consultations</h4>
                        <p class="text-sm text-gray-500">Manage your consultation requests with advisors.</p>
                        <div class="mt-4 flex items-center text-tangerine-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            View
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card: Request Consultation --}}
                <a href="{{ route('student.consultations.create') }}" class="group">
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 h-full border border-gray-100 hover:border-tangerine-200">
                        <div class="w-12 h-12 bg-gradient-to-br from-tangerine-50 to-tangerine-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-tangerine-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1 group-hover:text-tangerine-600 transition-colors">Request Consultation</h4>
                        <p class="text-sm text-gray-500">Submit a new consultation request to an advisor.</p>
                        <div class="mt-4 flex items-center text-tangerine-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Request
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>