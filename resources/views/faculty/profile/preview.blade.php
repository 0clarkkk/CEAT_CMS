@extends('layouts.faculty', [
    'title' => 'Profile Preview',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'My Profile', 'url' => route('faculty.profile.edit')],
        ['label' => 'Preview']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-4xl">
    <!-- Header Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Student View Preview</h2>
            <p class="text-sm text-slate-500">This is exactly how students will see your profile information.</p>
        </div>
        <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition shadow-sm text-sm font-bold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Profile Elements
        </a>
    </div>

    <!-- Profile Card Preview (Simulating Student UI) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative ring-1 ring-slate-100 ring-offset-4 ring-offset-slate-50">
        <!-- Cover background -->
        <div class="h-32 bg-gradient-to-r from-tangerine-500 to-tangerine-600"></div>

        <!-- Profile Content -->
        <div class="px-6 pb-6">
            <!-- Profile Header -->
            <div class="flex flex-col md:flex-row md:items-end md:gap-6 -mt-16 mb-6 relative z-10">
                <!-- Photo -->
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    @if($faculty->photo)
                        <img src="{{ Storage::url($faculty->photo) }}" alt="{{ $faculty->full_name }}" 
                            class="w-32 h-32 rounded-2xl object-cover border-4 border-white shadow-md bg-white">
                    @else
                        <div class="w-32 h-32 rounded-2xl bg-slate-100 border-4 border-white shadow-md flex items-center justify-center">
                            <span class="text-4xl font-black text-slate-300">{{ substr($faculty->full_name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                
                <!-- Name and Title -->
                <div class="flex-1 pb-1">
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $faculty->full_name }}</h1>
                    @if($faculty->position)
                        <p class="text-lg text-tangerine-600 font-bold mt-1">{{ $faculty->position }}</p>
                    @endif
                    @if($faculty->specialization)
                        <p class="text-slate-500 font-medium mt-1">{{ $faculty->specialization }}</p>
                    @endif
                </div>

                <!-- Contact Info Quick Actions -->
                <div class="flex flex-col gap-2 pb-1">
                    <a href="mailto:{{ $faculty->email }}" class="inline-flex items-center px-4 py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-slate-700 transition font-semibold text-sm">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Email Connect
                    </a>
                    @if($faculty->phone_number)
                        <div class="inline-flex items-center px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 font-semibold text-sm cursor-default">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.756l2.048 1.029a2 2 0 002.063-.41l3.799-3.799a1 1 0 00-.364-1.635L16.666 2.75a1 1 0 00-.932.221l-.822.822A15.988 15.988 0 002.166 6.07A1 1 0 001 7.14V11a2 2 0 002 2h2.285a1 1 0 00.982-.6l1.566-3.73a1 1 0 00-.023-.957L5.354 5.697a2 2 0 00-2.16-.505L2.034 5.978A14.988 14.988 0 001.166 6.07"/></svg>
                            {{ $faculty->phone_number }}
                        </div>
                    @endif
                </div>
            </div>

            <hr class="border-slate-100 my-6">

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Biography -->
                    @if($faculty->biography)
                        <section>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                                <span class="bg-slate-100 w-6 h-px mr-3"></span> About <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                            </h2>
                            <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
                                <p class="text-slate-600">{{ $faculty->biography }}</p>
                            </div>
                        </section>
                    @endif

                    <!-- Education -->
                    @if($faculty->education_display)
                        <section>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                                <span class="bg-slate-100 w-6 h-px mr-3"></span> Education <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                            </h2>
                            <ul class="space-y-4">
                                @foreach(explode("\n", $faculty->education_display) as $edu)
                                    @if(trim($edu))
                                        <li class="flex items-start bg-slate-50 p-3 rounded-lg border border-slate-100">
                                            <div class="w-8 h-8 rounded-full bg-tangerine-100 flex items-center justify-center mr-4 flex-shrink-0">
                                                <svg class="w-4 h-4 text-tangerine-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L9 4.414V16a1 1 0 102 0V4.414l6.293 6.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                                            </div>
                                            <span class="text-slate-700 font-medium py-1">{{ trim($edu) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    <!-- Research Interests -->
                    @if($faculty->research_interests_display)
                        <section>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                                <span class="bg-slate-100 w-6 h-px mr-3"></span> Research Areas <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_map('trim', explode(',', $faculty->research_interests_display)) as $interest)
                                    @if($interest)
                                        <span class="inline-flex tracking-wide bg-slate-100 text-slate-700 border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold uppercase">
                                            {{ $interest }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Publications -->
                    @if($faculty->publications_display)
                        <section>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                                <span class="bg-slate-100 w-6 h-px mr-3"></span> Recent Publications <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                            </h2>
                            <ul class="space-y-3">
                                @foreach(explode("\n", $faculty->publications_display) as $pub)
                                    @if(trim($pub))
                                        <li class="flex items-start text-sm">
                                            <svg class="w-5 h-5 text-tangerine-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/></svg>
                                            <span class="text-slate-600">{{ trim($pub) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    @endif
                </div>

                <!-- Right Column - Contact & Advisor Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Office Information -->
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 shadow-sm">
                        <h3 class="font-bold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Office Information
                        </h3>
                        <div class="space-y-4 text-sm">
                            @if($faculty->office_location)
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Location</p>
                                    <p class="text-slate-900 font-medium">{{ $faculty->office_location }}</p>
                                </div>
                            @endif
                            @if($faculty->office_hours)
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Office Hours</p>
                                    <p class="text-slate-900 font-medium">{{ $faculty->office_hours }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Advisor Section Simulation -->
                    @if($faculty->is_advisor && $faculty->is_advisor_visible)
                        <div class="bg-gradient-to-br from-tangerine-50 to-orange-50 border border-tangerine-200 rounded-2xl p-5 shadow-sm">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 rounded-full bg-tangerine-100 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-tangerine-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                </div>
                                <h3 class="font-bold text-tangerine-900">Academic Advisor</h3>
                            </div>
                            
                            @if($faculty->advisor_bio)
                                <p class="text-sm text-tangerine-800/80 mb-5 leading-relaxed">{{ $faculty->advisor_bio }}</p>
                            @endif

                            <div class="space-y-3 mb-5 bg-white/60 p-3 rounded-xl border border-tangerine-100/50">
                                <div>
                                    <p class="text-[10px] font-bold text-tangerine-600 uppercase tracking-widest">Duration</p>
                                    <p class="text-sm font-semibold text-tangerine-900">{{ $faculty->default_consultation_duration }} minutes</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-tangerine-600 uppercase tracking-widest">Cancellation</p>
                                    <p class="text-sm font-semibold text-tangerine-900">{{ $faculty->cancellation_deadline_hours }} hours notice</p>
                                </div>
                            </div>

                            <button disabled class="w-full px-4 py-3 bg-tangerine-500 text-white rounded-xl font-bold text-sm opacity-50 cursor-not-allowed shadow-sm">
                                Request Consultation (Disabled)
                            </button>
                        </div>
                    @elseif($faculty->is_advisor && !$faculty->is_advisor_visible)
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 border-dashed">
                            <div class="text-center text-slate-500">
                                <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.604-1.273A9.973 9.973 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                <p class="text-sm font-medium">Advisor profile hidden from students</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
