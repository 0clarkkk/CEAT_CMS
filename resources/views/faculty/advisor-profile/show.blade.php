@extends('layouts.faculty', [
    'title' => 'Advisor Settings',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Advisor Settings']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-4xl">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Advisor Tools Overview</h1>
            <p class="text-slate-500 font-medium mt-1">Manage your academic advising status and visibility</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('faculty.advisor-profile.edit') }}" class="px-5 py-2.5 bg-slate-900 text-white hover:bg-slate-800 rounded-xl font-bold shadow-sm transition-all text-sm flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Configure Settings
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl shadow-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Advisor Status Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-6 border-b border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center border-2 border-white shadow-sm flex-shrink-0 text-slate-400 font-black text-xl">
                    {{ substr($faculty->full_name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $faculty->full_name }}</h2>
                    <p class="text-slate-500 font-medium">{{ $faculty->position ?? 'Faculty Member' }}</p>
                </div>
            </div>
                @if ($faculty->is_advisor)
                    <span class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 border border-green-200 rounded-full font-bold text-sm tracking-wide shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span> Active Advisor
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-600 border border-slate-200 rounded-full font-bold text-sm tracking-wide shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-slate-400 mr-2"></span> Inactive Advisor
                    </span>
                @endif
                
                @if ($faculty->is_advisor_visible)
                    <span class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-full font-bold text-sm tracking-wide shadow-sm mt-3 sm:mt-0 sm:ml-2">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Search Visible
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-600 border border-slate-200 rounded-full font-bold text-sm tracking-wide shadow-sm mt-3 sm:mt-0 sm:ml-2">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg> Hidden
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 space-y-8">
            <!-- Advisor Information -->
            @if ($faculty->is_advisor)
                <div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                        <span class="bg-slate-100 w-6 h-px mr-3"></span> Contact Details <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Office Location</p>
                            <p class="text-slate-900 font-bold truncate" title="{{ $faculty->office_location ?? 'Not set' }}">{{ $faculty->office_location ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Office Hours</p>
                            <p class="text-slate-900 font-bold truncate" title="{{ $faculty->office_hours ?? 'Not set' }}">{{ $faculty->office_hours ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Phone Number</p>
                            <p class="text-slate-900 font-bold truncate">{{ $faculty->phone_number ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
                            <a href="mailto:{{ $faculty->email }}" class="text-tangerine-600 hover:text-tangerine-700 font-bold truncate block">{{ $faculty->email }}</a>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100 mt-4">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Standard Duration</p>
                            <p class="text-slate-900 font-bold truncate">{{ $faculty->default_consultation_duration ?? 15 }} minutes</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Cancellation Rule</p>
                            <p class="text-slate-900 font-bold truncate">{{ $faculty->cancellation_deadline_hours ?? 24 }} hours prior</p>
                        </div>
                        <div class="sm:col-span-2 lg:col-span-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Welcome Subject</p>
                            <p class="text-slate-600 font-bold truncate" title="{{ $faculty->advisor_bio ?? 'Not set' }}">{{ $faculty->advisor_bio ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-4 flex items-center">
                        <span class="bg-slate-100 w-6 h-px mr-3"></span> General Instructions & Notes <span class="bg-slate-100 flex-1 h-px ml-3"></span>
                    </h3>
                    <div class="bg-white border border-slate-200 rounded-xl p-5">
                        <p class="text-slate-700 font-medium leading-relaxed whitespace-pre-wrap">{{ $faculty->consultation_info ?? 'No special consultation instructions provided.' }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-12 px-4 bg-slate-50 rounded-2xl border border-slate-100 border-dashed">
                    <div class="inline-flex w-16 h-16 rounded-full bg-slate-200 items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Not currently listed as an advisor</h3>
                    <p class="text-slate-500 mb-6 max-w-md mx-auto">Students cannot currently request consultations with you. To allow consultation requests, update your settings and activate your status.</p>
                </div>
            @endif

            <!-- Action Controls -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-4">
                <form method="POST" action="{{ route('faculty.advisor-profile.toggle') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 rounded-xl font-bold shadow-sm transition-all flex items-center justify-center
                        {{ $faculty->is_advisor 
                            ? 'bg-red-50 text-red-700 hover:bg-red-100 border border-red-200' 
                            : 'bg-green-500 text-white hover:bg-green-600 border border-green-600' }}">
                        
                        @if($faculty->is_advisor)
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Turn Off Advisor Status
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Activate Advisor Status
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
