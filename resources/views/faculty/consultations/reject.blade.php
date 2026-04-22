@extends('layouts.faculty', [
    'title' => 'Reject Consultation',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Consultations', 'url' => route('faculty.consultations.index')],
        ['label' => 'View Details', 'url' => route('faculty.consultations.show', $consultation->id)],
        ['label' => 'Reject Request']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 truncate pr-4">Consultation: {{ $consultation->title }}</h2>
            <p class="text-sm font-medium text-slate-500 whitespace-nowrap">Student: {{ $consultation->student?->name }}</p>
        </div>

        <form action="{{ route('faculty.consultations.reject', $consultation->id) }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="rejection_reason" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Reason for Rejection</label>
                <textarea 
                    id="rejection_reason" 
                    name="rejection_reason" 
                    rows="6"
                    placeholder="Please explain why you are rejecting this consultation request. Be professional and constructive."
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none transition-shadow"
                    required>{{ old('rejection_reason') }}</textarea>
                @error('rejection_reason')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm text-blue-800 leading-relaxed font-medium">
                    The student will be notified of the rejection along with your reason. Be clear and helpful so they understand how to proceed next.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('faculty.consultations.show', $consultation->id) }}" class="px-6 py-3 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors font-bold text-center">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 rounded-xl transition-colors font-bold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Reject Consultation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
