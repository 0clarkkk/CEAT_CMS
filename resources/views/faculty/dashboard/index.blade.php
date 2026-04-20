<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between pt-2 pb-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Faculty Dashboard</h1>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(!$faculty)
            <!-- No Faculty Member Setup -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-200 rounded-2xl p-12 text-center shadow-lg">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-blue-900 mb-2">Profile Setup Required</h2>
                <p class="text-blue-700 mb-8 max-w-md mx-auto">Your faculty profile hasn't been set up yet. Please complete your profile to access the full dashboard and manage your consultations.</p>
                <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Complete Your Profile
                </a>
            </div>
        @else
            <!-- Statistics Cards - Only for Advisors -->
            @if($faculty->is_advisor)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-12">
                <!-- Pending Requests Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-yellow-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 border-t-4 border-yellow-400">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-yellow-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full">Awaiting Response</span>
                        </div>
                        <p class="text-sm text-gray-600 font-semibold">Pending Requests</p>
                        <p class="text-4xl font-bold text-gray-900 mt-3">{{ $pendingConsultations }}</p>
                        <a href="{{ route('faculty.consultations.index', ['status' => 'pending']) }}" class="text-xs text-yellow-600 hover:text-yellow-700 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                            Review Now
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Upcoming Consultations Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 border-t-4 border-blue-400">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-blue-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Next 7 Days</span>
                        </div>
                        <p class="text-sm text-gray-600 font-semibold">Upcoming Consultations</p>
                        <p class="text-4xl font-bold text-gray-900 mt-3">{{ $upcomingConsultations->count() }}</p>
                        <a href="{{ route('faculty.consultations.index') }}" class="text-xs text-blue-600 hover:text-blue-700 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                            View Schedule
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Completed This Month Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 border-t-4 border-green-400">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-green-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-green-600 bg-green-100 px-3 py-1 rounded-full">{{ now()->format('M') }}</span>
                        </div>
                        <p class="text-sm text-gray-600 font-semibold">Completed This Month</p>
                        <p class="text-4xl font-bold text-gray-900 mt-3">{{ $completedThisMonth }}</p>
                        <p class="text-xs text-gray-500 mt-4">{{ now()->format('F Y') }}</p>
                    </div>
                </div>

                <!-- Availability Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-purple-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6 border-t-4 border-purple-400">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-purple-100 rounded-xl p-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-purple-600 bg-purple-100 px-3 py-1 rounded-full">Schedule</span>
                        </div>
                        <p class="text-sm text-gray-600 font-semibold">Manage Your Time</p>
                        <p class="text-sm text-gray-700 mt-3">Set availability slots for student consultations</p>
                        <a href="{{ route('advisor.consultations.availability.index') }}" class="text-xs text-purple-600 hover:text-purple-700 mt-4 inline-flex items-center font-semibold group-hover:gap-2 transition-all gap-1">
                            Configure Slots
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-8">
                    @if($faculty->is_advisor)
                        <!-- Upcoming Consultations List -->
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden">
                            <div class="px-6 py-5 border-b-2 border-gray-100 bg-gradient-to-r from-blue-50 via-blue-50 to-indigo-50 flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">Upcoming Consultations</h2>
                                    <p class="text-sm text-gray-600 mt-1">{{ $upcomingConsultations->count() }} scheduled for the next 7 days</p>
                                </div>
                                <div class="bg-blue-100 rounded-xl p-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            @if($upcomingConsultations->isEmpty())
                                <div class="px-6 py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-4">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 font-semibold">No upcoming consultations</p>
                                    <p class="text-sm text-gray-500 mt-1">When students request consultations, they'll appear here</p>
                                </div>
                            @else
                                <div class="divide-y divide-gray-100">
                                    @foreach($upcomingConsultations as $consultation)
                                        <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-colors">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-2">
                                                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-1"></div>
                                                        <h3 class="text-sm font-semibold text-gray-900">{{ $consultation->title }}</h3>
                                                    </div>
                                                    <div class="ml-5 space-y-1 text-sm">
                                                        <p class="text-gray-600">
                                                            <span class="text-gray-400">Student:</span> 
                                                            <span class="font-medium text-gray-800">{{ $consultation->student?->name ?? 'N/A' }}</span>
                                                        </p>
                                                        @if($consultation->category)
                                                            <p class="text-gray-600">
                                                                <span class="text-gray-400">Category:</span> 
                                                                <span class="capitalize font-medium text-gray-800">{{ $consultation->category }}</span>
                                                            </p>
                                                        @endif
                                                        <div class="flex items-center text-gray-600 pt-1">
                                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            <span class="text-sm">{{ $consultation->scheduled_at?->format('M d, Y \a\t h:i A') ?? 'Not scheduled' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                        {{ ucfirst($consultation->status) }}
                                                    </span>
                                                    <a href="{{ route('faculty.consultations.show', $consultation->id) }}" 
                                                       class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold transition-colors">
                                                        View Details →
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden">
                        <div class="px-6 py-5 border-b-2 border-gray-100 bg-gradient-to-r from-purple-50 via-purple-50 to-pink-50 flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Recent Activity</h2>
                                <p class="text-sm text-gray-600 mt-1">Latest consultation updates and changes</p>
                            </div>
                            <div class="bg-purple-100 rounded-xl p-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        @if($recentActivity->isEmpty())
                            <div class="px-6 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-4">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-semibold">No recent activity</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-100">
                                @foreach($recentActivity->take(5) as $activity)
                                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-colors">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1 flex items-start gap-3">
                                                <div class="mt-0.5">
                                                    @if($activity->status === 'pending')
                                                        <span class="inline-block w-3 h-3 bg-yellow-400 rounded-full border-2 border-white shadow-sm"></span>
                                                    @elseif($activity->status === 'approved')
                                                        <span class="inline-block w-3 h-3 bg-blue-500 rounded-full border-2 border-white shadow-sm"></span>
                                                    @elseif($activity->status === 'completed')
                                                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full border-2 border-white shadow-sm"></span>
                                                    @else
                                                        <span class="inline-block w-3 h-3 bg-gray-300 rounded-full border-2 border-white shadow-sm"></span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h3 class="text-sm font-semibold text-gray-900">{{ $activity->title }}</h3>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <span class="text-gray-400">Student:</span> 
                                                        <span class="font-medium text-gray-800">{{ $activity->student?->name ?? 'Unknown' }}</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-2">{{ $activity->updated_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                                {{ ucfirst($activity->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="h-24 bg-gradient-to-r from-maroon-500 via-maroon-600 to-maroon-700"></div>
                        <div class="px-6 py-6 text-center -mt-12 relative z-10">
                            <div class="w-24 h-24 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-maroon-400 to-maroon-600 flex items-center justify-center shadow-lg border-4 border-white">
                                <span class="text-white font-bold text-2xl">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-maroon-600 font-semibold mt-1">{{ $faculty->position ?? 'Faculty Member' }}</p>
                            @if($faculty->department)
                                <p class="text-xs text-gray-500 mt-2">{{ $faculty->department->name }}</p>
                            @endif
                            @if($faculty->is_advisor)
                                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-300">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Active Advisor
                                </div>
                            @endif
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4 space-y-3 bg-gray-50">
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Email</p>
                                <p class="text-sm text-gray-900 font-medium mt-1">{{ auth()->user()->email }}</p>
                            </div>
                            @if($faculty->phone_number)
                                <div>
                                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Phone</p>
                                    <p class="text-sm text-gray-900 font-medium mt-1">{{ $faculty->phone_number }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Links Card -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b-2 border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Quick Links</h3>
                        </div>
                        <div class="px-4 py-3 space-y-2">
                            <a href="{{ route('faculty.profile.edit') }}" 
                               class="block px-4 py-3 text-sm text-gray-700 font-medium rounded-lg hover:bg-maroon-50 hover:text-maroon-600 transition-all duration-200 flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profile
                            </a>
                            <a href="{{ route('faculty.advisor-profile.show') }}" 
                               class="block px-4 py-3 text-sm text-gray-700 font-medium rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Advisor Profile
                            </a>
                            @if($faculty->is_advisor)
                                <a href="{{ route('advisor.consultations.availability.index') }}" 
                                   class="block px-4 py-3 text-sm text-gray-700 font-medium rounded-lg hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Availability
                                </a>
                                <a href="{{ route('faculty.consultations.index') }}" 
                                   class="block px-4 py-3 text-sm text-gray-700 font-medium rounded-lg hover:bg-green-50 hover:text-green-600 transition-all duration-200 flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    My Consultations
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="bg-gradient-to-br from-maroon-50 to-maroon-100 rounded-2xl shadow-lg overflow-hidden border border-maroon-200">
                        <div class="px-6 py-4 border-b border-maroon-300 bg-gradient-to-r from-maroon-100 to-maroon-200">
                            <h3 class="text-sm font-bold text-maroon-900 uppercase tracking-wide">This Month</h3>
                        </div>
                        <div class="px-6 py-6 space-y-3">
                            @if($faculty->is_advisor)
                                <div>
                                    <p class="text-xs text-maroon-700 font-semibold uppercase tracking-wide">Total Completed</p>
                                    <p class="text-3xl font-bold text-maroon-700 mt-2">{{ $completedThisMonth }}</p>
                                </div>
                                <div class="pt-3 border-t border-maroon-300">
                                    <p class="text-xs text-maroon-600">Completed in {{ now()->format('F Y') }}</p>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="inline-flex items-center justify-center w-10 h-10 bg-maroon-200 rounded-full mb-3">
                                        <svg class="w-5 h-5 text-maroon-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-maroon-900">Not an Active Advisor</p>
                                    <a href="{{ route('faculty.advisor-profile.edit') }}" class="text-xs text-maroon-700 hover:text-maroon-900 mt-3 inline-flex items-center font-semibold gap-1">
                                        Enable Role
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
