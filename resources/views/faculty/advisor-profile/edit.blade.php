@extends('layouts.faculty', [
    'title' => 'Edit Advisor Profile',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'Advisor Settings', 'url' => route('faculty.advisor-profile.show')],
        ['label' => 'Edit Configuration']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
            <h2 class="text-lg font-bold text-slate-900">Consultation Availability settings</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">Configure when and how students can request sessions with you.</p>
        </div>

        @if ($errors->any())
            <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl font-medium">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <strong>Please fix the following problems:</strong>
                </div>
                <ul class="list-disc list-inside text-sm pl-7 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('faculty.advisor-profile.update') }}" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="pb-6 border-b border-slate-100 flex items-center justify-between gap-4">
                <div>
                    <label class="text-sm font-black text-slate-800 uppercase tracking-wider block">Advisor Status Activity</label>
                    <p class="text-sm text-slate-500 font-medium mt-1">
                        @if ($faculty->is_advisor)
                            <span class="text-green-600 font-bold">● Active </span> — You accept new requests
                        @else
                            <span class="text-slate-400 font-bold">○ Inactive </span> — You are hidden from lists
                        @endif
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_advisor" value="0">
                    <input type="checkbox" name="is_advisor" value="1" 
                        {{ $faculty->is_advisor ? 'checked' : '' }}
                        class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-tangerine-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-tangerine-500"></div>
                </label>
            </div>

            <!-- Student Visibility Toggle -->
            <div class="pb-6 border-b border-slate-100 flex items-center justify-between gap-4">
                <div>
                    <label class="text-sm font-black text-slate-800 uppercase tracking-wider block">Profile Search Visibility</label>
                    <p class="text-sm text-slate-500 font-medium mt-1">
                        Allow students to find your advisor card in the request browsing list
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_advisor_visible" value="0">
                    <input type="checkbox" name="is_advisor_visible" value="1" 
                        @checked(old('is_advisor_visible', $faculty->is_advisor_visible))
                        class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-tangerine-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-tangerine-500"></div>
                </label>
            </div>

            <!-- Consultation Info -->
            <div>
                <label for="consultation_info" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Scope of Consultations <span class="text-tangerine-500 ml-1">*</span>
                </label>
                <textarea name="consultation_info" id="consultation_info" rows="5"
                    placeholder="e.g., I offer guidance on software architecture and thesis review..."
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow @error('consultation_info') border-red-500 ring-red-500 @enderror">{{ old('consultation_info', $faculty->consultation_info) }}</textarea>
                @error('consultation_info')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6 flex items-start">
                <svg class="h-5 w-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="text-sm font-bold text-blue-900">Meeting Parameters</p>
                    <p class="text-sm text-blue-800 leading-relaxed mt-1">Configure duration times and how soon students can cancel their sessions.</p>
                </div>
            </div>

            <div>
                <label for="advisor_bio" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Advisor Welcome Message</label>
                <textarea name="advisor_bio" id="advisor_bio" rows="4" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none"
                    placeholder="Brief message displayed to students viewing your advisor profile e.g., 'Hello! I accept slots every Monday.'">{{ old('advisor_bio', $faculty->advisor_bio) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="default_consultation_duration" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Default Duration</label>
                    <select name="default_consultation_duration" id="default_consultation_duration" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500">
                        <option value="15" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 15)>15 minutes</option>
                        <option value="30" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 30)>30 minutes</option>
                        <option value="45" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 45)>45 minutes</option>
                        <option value="60" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 60)>60 minutes</option>
                    </select>
                </div>

                <div>
                    <label for="cancellation_deadline_hours" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cancellation Cutoff</label>
                    <select name="cancellation_deadline_hours" id="cancellation_deadline_hours" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500">
                        <option value="1" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 1)>1 hour before</option>
                        <option value="2" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 2)>2 hours before</option>
                        <option value="4" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 4)>4 hours before</option>
                        <option value="24" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 24)>24 hours before</option>
                        <option value="48" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 48)>48 hours before</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Office Location -->
                <div>
                    <label for="office_location" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                        Office Location <span class="text-tangerine-500 ml-1">*</span>
                    </label>
                    <input type="text" name="office_location" id="office_location"
                        placeholder="e.g., Building A, Room 305"
                        value="{{ old('office_location', $faculty->office_location) }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow @error('office_location') border-red-500 @enderror">
                    @error('office_location')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Office Hours -->
                <div>
                    <label for="office_hours" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                        Common Office Hours <span class="text-slate-400 font-normal normal-case ml-1">(Optional)</span>
                    </label>
                    <input type="text" name="office_hours" id="office_hours"
                        placeholder="e.g., Mon/Wed 2-5PM"
                        value="{{ old('office_hours', $faculty->office_hours) }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow @error('office_hours') border-red-500 @enderror">
                    @error('office_hours')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Contact Phone Number <span class="text-slate-400 font-normal normal-case ml-1">(Optional)</span>
                </label>
                <input type="tel" name="phone_number" id="phone_number"
                    placeholder="e.g., +1 (555) 123-4567"
                    value="{{ old('phone_number', $faculty->phone_number) }}"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 transition-shadow @error('phone_number') border-red-500 @enderror">
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('faculty.advisor-profile.show') }}" class="px-6 py-3 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors font-bold text-center">
                    Cancel Changes
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-tangerine-500 to-tangerine-600 hover:from-tangerine-600 hover:to-tangerine-700 text-white rounded-xl shadow-sm transition-all font-bold flex items-center justify-center flex-1 sm:flex-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Advisor Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('input[name="is_advisor"]').addEventListener('change', function() {
        const isAdvisor = this.checked;
        document.querySelector('input[name="office_location"]').required = isAdvisor;
        document.querySelector('textarea[name="consultation_info"]').required = isAdvisor;
    });

    window.addEventListener('DOMContentLoaded', function() {
        const isAdvisor = document.querySelector('input[name="is_advisor"]').checked;
        document.querySelector('input[name="office_location"]').required = isAdvisor;
        document.querySelector('textarea[name="consultation_info"]').required = isAdvisor;
    });
</script>
@endsection
