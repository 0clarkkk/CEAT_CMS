@extends('layouts.faculty', [
    'title' => 'Reschedule Consultation',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Consultations', 'url' => route('faculty.consultations.index')],
        ['label' => 'View Details', 'url' => route('faculty.consultations.show', $consultation->id)],
        ['label' => 'Reschedule Time']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 truncate pr-4">Consultation: {{ $consultation->title }}</h2>
            <p class="text-sm font-medium text-slate-500 whitespace-nowrap">Student: {{ $consultation->student?->name }}</p>
        </div>

        <div class="px-6 py-4 bg-blue-50/50 border-b border-blue-100 flex items-center gap-3">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm text-blue-900 font-medium tracking-wide">
                <span class="opacity-75 mr-1">Current Schedule:</span> {{ $consultation->scheduled_at?->format('l, F d, Y \a\t h:i A') ?? 'Not scheduled' }}
            </p>
        </div>

        <form action="{{ route('faculty.consultations.reschedule', $consultation->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="scheduled_date" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">New Date</label>
                    <input 
                        type="date" 
                        id="scheduled_date" 
                        name="scheduled_date"
                        value="{{ old('scheduled_date', $consultation->scheduled_at?->format('Y-m-d')) }}"
                        min="{{ now()->format('Y-m-d') }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow"
                        required>
                    @error('scheduled_date')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="scheduled_time" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">New Time</label>
                    <input 
                        type="time" 
                        id="scheduled_time" 
                        name="scheduled_time"
                        value="{{ old('scheduled_time', $consultation->scheduled_at?->format('H:i')) }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow"
                        required>
                    @error('scheduled_time')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="location" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Location</label>
                <input 
                    type="text" 
                    id="location" 
                    name="location"
                    placeholder="e.g., Office 305, Conference Room B, Virtual (Zoom link)"
                    value="{{ old('location', $consultation->location) }}"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow"
                    required>
                @error('location')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="reschedule_reason" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Reason for Reschedule <span class="text-slate-400 font-normal normal-case ml-1">(Optional)</span></label>
                <textarea 
                    id="reschedule_reason" 
                    name="reschedule_reason" 
                    rows="4"
                    placeholder="Briefly explain why you're rescheduling. The student will be notified of the change and reason."
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none transition-shadow">{{ old('reschedule_reason') }}</textarea>
                @error('reschedule_reason')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm text-blue-800 leading-relaxed font-medium">
                    The student will be notified of the reschedule with the new date, time, location, and your reason. This is important for maintaining good communication.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('faculty.consultations.show', $consultation->id) }}" class="px-6 py-3 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors font-bold text-center">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl shadow-sm transition-all font-bold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Reschedule Consultation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
