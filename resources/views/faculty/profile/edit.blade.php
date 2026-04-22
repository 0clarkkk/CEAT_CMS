@extends('layouts.faculty', [
    'title' => 'Edit My Profile',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'My Profile']
    ]
])

@section('faculty_content')
<div class="space-y-6 max-w-4xl">
    <!-- Header with Preview Link -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <div>
            <h1 class="text-xl font-black text-slate-900 tracking-tight">Profile Information</h1>
            <p class="text-sm text-slate-500 font-medium">Keep your credentials and contact data up to date</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('faculty.profile.history') }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg text-sm font-bold transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                History
            </a>
            <a href="{{ route('faculty.profile.preview') }}" class="px-4 py-2 bg-slate-900 text-white hover:bg-slate-800 rounded-lg text-sm font-bold shadow-sm transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Preview Profile View
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl font-medium">
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

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <!-- Tabs -->
        <div class="border-b border-slate-100 px-6">
            <nav class="flex space-x-6 overflow-x-auto" aria-label="Tabs">
                <button type="button" data-tab="basic" class="tab-link active py-4 border-b-2 border-tangerine-500 font-bold text-sm text-tangerine-600 whitespace-nowrap">
                    Basic Information
                </button>
                <button type="button" data-tab="professional" class="tab-link py-4 border-b-2 border-transparent font-bold text-sm text-slate-500 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap">
                    Professional
                </button>
            </nav>
        </div>

        <form method="POST" action="{{ route('faculty.profile.update') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- Basic Information Tab -->
            <div id="basic" class="tab-content">
                <div class="space-y-6">
                    <!-- Photo Upload -->
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 hover:border-tangerine-400 hover:bg-slate-50 transition-colors">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center">
                                @if($faculty->photo)
                                    <img src="{{ Storage::url($faculty->photo) }}" alt="Profile Photo" class="w-16 h-16 rounded-xl object-cover mr-4 shadow-sm">
                                @else
                                    <div class="w-16 h-16 bg-slate-100 rounded-xl mr-4 flex items-center justify-center border border-slate-200">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-900">Profile Photo</p>
                                    <p class="text-xs text-slate-500 mt-1 uppercase tracking-wider font-semibold">JPG, PNG or WebP. Max 5MB</p>
                                </div>
                            </div>
                            <label class="cursor-pointer">
                                <input type="file" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                                <span class="inline-flex items-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition font-bold text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    Upload Photo
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Name Block -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">First Name <span class="text-tangerine-500 ml-1">*</span></label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $faculty->first_name) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 @error('first_name') border-red-500 @enderror" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Last Name <span class="text-tangerine-500 ml-1">*</span></label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $faculty->last_name) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 @error('last_name') border-red-500 @enderror" required>
                        </div>
                    </div>

                    <!-- Contact Block -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address <span class="text-tangerine-500 ml-1">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $faculty->email) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 @error('email') border-red-500 @enderror" required>
                        </div>
                        <div>
                            <label for="phone_number" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Number</label>
                            <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $faculty->phone_number) }}" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500" placeholder="+1 (555) 000-0000">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Tab -->
            <div id="professional" class="tab-content hidden space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="position" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Position / Title</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $faculty->position) }}" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500" placeholder="e.g., Associate Professor">
                    </div>
                    <div>
                        <label for="specialization" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Specialization</label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $faculty->specialization) }}" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500" placeholder="e.g., Software Engineering">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="office_location" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Office Location</label>
                        <input type="text" name="office_location" id="office_location" value="{{ old('office_location', $faculty->office_location) }}" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500" placeholder="e.g., Engineering Bldg, Room 201">
                    </div>
                    <div>
                        <label for="office_hours" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Office Hours</label>
                        <input type="text" name="office_hours" id="office_hours" value="{{ old('office_hours', $faculty->office_hours) }}" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500" placeholder="e.g., Mon-Wed 2-4 PM">
                    </div>
                </div>

                <div>
                    <label for="biography" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Biography / About</label>
                    <textarea name="biography" id="biography" rows="5" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none"
                        placeholder="Tell students about your background, research interests, and teaching philosophy..." maxlength="2000">{{ old('biography', $faculty->biography) }}</textarea>
                    <p class="mt-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">
                        <span id="bio-count">{{ strlen(old('biography', $faculty->biography ?? '')) }}</span> / 2000
                    </p>
                </div>

                <div>
                    <label for="research_interests" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Research Interests <span class="font-normal normal-case text-slate-400 ml-1">(comma separated)</span></label>
                    <textarea name="research_interests" id="research_interests" rows="3" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none"
                        placeholder="Machine Learning, Data Science, Computer Vision">{{ old('research_interests', $faculty->research_interests_display ?? '') }}</textarea>
                </div>

                <div>
                    <label for="publications" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Recent Publications <span class="font-normal normal-case text-slate-400 ml-1">(one per line)</span></label>
                    <textarea name="publications" id="publications" rows="4" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none"
                        placeholder="Paper Title (Year)&#10;Another Paper Title (Year)">{{ old('publications', $faculty->publications_display ?? '') }}</textarea>
                </div>

                <div>
                    <label for="education" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Education Background <span class="font-normal normal-case text-slate-400 ml-1">(one per line)</span></label>
                    <textarea name="education" id="education" rows="4" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-tangerine-500 focus:border-tangerine-500 resize-none"
                        placeholder="Ph.D. in Computer Science, Stanford University&#10;B.S. in Computer Science, MIT">{{ old('education', $faculty->education_display ?? '') }}</textarea>
                </div>
            </div>

            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse sm:flex-row justify-between items-center sm:items-end mt-8 pt-6 border-t border-slate-100 gap-4">
                <div class="w-full sm:w-auto text-center sm:text-left">
                    @if($faculty->profile_last_updated_at)
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            Last sync: {{ $faculty->profile_last_updated_at->format('M d, Y') }}
                        </p>
                    @endif
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <button type="reset" class="px-6 py-3 border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition font-bold shadow-sm">
                        Revert Fields
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-tangerine-500 to-tangerine-600 border border-tangerine-600 text-white rounded-xl hover:from-tangerine-600 hover:to-tangerine-700 transition shadow-sm font-bold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Master Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('.tab-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const tabId = link.getAttribute('data-tab');
        
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        
        // Show selected tab
        document.getElementById(tabId).classList.remove('hidden');
        
        // Update active tab styling
        document.querySelectorAll('.tab-link').forEach(l => {
            l.classList.remove('border-tangerine-500', 'text-tangerine-600');
            l.classList.add('border-transparent', 'text-slate-500');
        });
        link.classList.add('border-tangerine-500', 'text-tangerine-600');
        link.classList.remove('border-transparent', 'text-slate-500');
    });
});

document.getElementById('biography').addEventListener('input', (e) => {
    document.getElementById('bio-count').textContent = e.target.value.length;
});

function previewPhoto(input) {
    // If a photo gets added, we can show logic. Left blank to match original intention.
}
</script>
@endsection
