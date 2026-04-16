@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
                    <p class="mt-2 text-gray-600">Update your professional information</p>
                </div>
                <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px" aria-label="Tabs">
                    <a href="#basic" class="tab-link active py-4 px-6 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                        Basic Information
                    </a>
                    <a href="#professional" class="tab-link py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Professional
                    </a>
                    <a href="#advisor" class="tab-link py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Advisor Settings
                    </a>
                    <a href="#preview" class="inline-flex items-center px-6 py-4 ml-auto font-medium text-sm text-indigo-600 hover:text-indigo-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Preview Profile
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('faculty.profile.update') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <!-- Basic Information Tab -->
                <div id="basic" class="tab-content">
                    <div class="space-y-6">
                        <!-- Photo Upload -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-gray-400 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        @if($faculty->photo)
                                            <img src="{{ Storage::url($faculty->photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-lg object-cover mr-4">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">Profile Photo</p>
                                            <p class="text-sm text-gray-500">JPG, PNG or WebP. Max 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                <label class="cursor-pointer">
                                    <input type="file" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                                    <span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Upload
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- First Name and Last Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $faculty->first_name) }}" 
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $faculty->last_name) }}" 
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email and Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $faculty->email) }}" 
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $faculty->phone_number) }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="+1 (555) 000-0000">
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Tab -->
                <div id="professional" class="tab-content hidden space-y-6">
                    <!-- Position and Specialization -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                                Position/Title
                            </label>
                            <input type="text" name="position" id="position" value="{{ old('position', $faculty->position) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Associate Professor">
                            @error('position')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">
                                Specialization
                            </label>
                            <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $faculty->specialization) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Software Engineering">
                            @error('specialization')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Office Location and Hours -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="office_location" class="block text-sm font-medium text-gray-700 mb-2">
                                Office Location
                            </label>
                            <input type="text" name="office_location" id="office_location" value="{{ old('office_location', $faculty->office_location) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Engineering Building, Room 201">
                            @error('office_location')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="office_hours" class="block text-sm font-medium text-gray-700 mb-2">
                                Office Hours
                            </label>
                            <input type="text" name="office_hours" id="office_hours" value="{{ old('office_hours', $faculty->office_hours) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Mon-Wed 2-4 PM">
                            @error('office_hours')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Biography -->
                    <div>
                        <label for="biography" class="block text-sm font-medium text-gray-700 mb-2">
                            Biography / About
                        </label>
                        <textarea name="biography" id="biography" rows="5" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tell students about your background, research interests, and teaching philosophy..."
                            maxlength="2000">{{ old('biography', $faculty->biography) }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">
                            <span id="bio-count">{{ strlen(old('biography', $faculty->biography ?? '')) }}</span>/2000 characters
                        </p>
                        @error('biography')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Research Interests -->
                    <div>
                        <label for="research_interests" class="block text-sm font-medium text-gray-700 mb-2">
                            Research Interests
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Enter each interest separated by a comma</p>
                        <textarea name="research_interests" id="research_interests" rows="3" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Machine Learning, Data Science, Computer Vision">{{ old('research_interests', $faculty->research_interests_display ?? '') }}</textarea>
                        @error('research_interests')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publications -->
                    <div>
                        <label for="publications" class="block text-sm font-medium text-gray-700 mb-2">
                            Recent Publications
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Add your recent publications with titles and years</p>
                        <textarea name="publications" id="publications" rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Paper Title (Year)&#10;Another Paper Title (Year)">{{ old('publications', $faculty->publications_display ?? '') }}</textarea>
                        @error('publications')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Education -->
                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-2">
                            Education
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Add your degrees and institutions</p>
                        <textarea name="education" id="education" rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ph.D. in Computer Science, Stanford University&#10;B.S. in Computer Science, MIT">{{ old('education', $faculty->education_display ?? '') }}</textarea>
                        @error('education')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Advisor Settings Tab -->
                @if($faculty->is_advisor)
                <div id="advisor" class="tab-content hidden space-y-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-blue-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Advisor Information</p>
                                <p class="text-sm text-blue-700 mt-1">These settings help manage your consultation requests and availability.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Advisor Bio -->
                    <div>
                        <label for="advisor_bio" class="block text-sm font-medium text-gray-700 mb-2">
                            Advisor Bio / Consultation Focus
                        </label>
                        <textarea name="advisor_bio" id="advisor_bio" rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Describe your advising approach, areas of expertise, and what to expect in a consultation...">{{ old('advisor_bio', $faculty->advisor_bio) }}</textarea>
                        @error('advisor_bio')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Default Consultation Duration -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="default_consultation_duration" class="block text-sm font-medium text-gray-700 mb-2">
                                Default Consultation Duration (minutes)
                            </label>
                            <select name="default_consultation_duration" id="default_consultation_duration" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="15" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 15)>15 minutes</option>
                                <option value="30" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 30)>30 minutes</option>
                                <option value="45" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 45)>45 minutes</option>
                                <option value="60" @selected(old('default_consultation_duration', $faculty->default_consultation_duration) == 60)>60 minutes</option>
                            </select>
                            @error('default_consultation_duration')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cancellation Deadline -->
                        <div>
                            <label for="cancellation_deadline_hours" class="block text-sm font-medium text-gray-700 mb-2">
                                Cancellation Deadline (hours before)
                            </label>
                            <select name="cancellation_deadline_hours" id="cancellation_deadline_hours" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="1" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 1)>1 hour</option>
                                <option value="2" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 2)>2 hours</option>
                                <option value="4" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 4)>4 hours</option>
                                <option value="24" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 24)>24 hours</option>
                                <option value="48" @selected(old('cancellation_deadline_hours', $faculty->cancellation_deadline_hours) == 48)>48 hours</option>
                            </select>
                            @error('cancellation_deadline_hours')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-medium text-gray-900">Profile Visibility</p>
                            <p class="text-sm text-gray-600 mt-1">Allow students to see your profile and book consultations</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_advisor_visible" value="0">
                            <input type="checkbox" name="is_advisor_visible" value="1" 
                                @checked(old('is_advisor_visible', $faculty->is_advisor_visible))
                                class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
                @endif

                <!-- Form Actions -->
                <div class="flex justify-between items-center mt-8 pt-8 border-t border-gray-200">
                    <div>
                        @if($faculty->profile_last_updated_at)
                            <p class="text-sm text-gray-600">
                                Last updated: {{ $faculty->profile_last_updated_at->format('M d, Y \a\t h:i A') }}
                            </p>
                        @endif
                    </div>
                    <div class="flex gap-4">
                        <button type="reset" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                            Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Recent Changes -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Recent Changes</h2>
                <a href="{{ route('faculty.profile.history') }}" class="text-sm text-blue-600 hover:text-blue-700">View All Changes</a>
            </div>
            <p class="text-sm text-gray-600">Profile updates are logged for security and audit purposes. You can view your complete change history in the activity log.</p>
        </div>
    </div>
</div>

<script>
// Tab switching
document.querySelectorAll('.tab-link').forEach(link => {
    link.addEventListener('click', (e) => {
        if (link.getAttribute('href') === '#preview') return;
        
        e.preventDefault();
        const tabId = link.getAttribute('href').substring(1);
        
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        // Show selected tab
        document.getElementById(tabId).classList.remove('hidden');
        
        // Update active tab styling
        document.querySelectorAll('.tab-link').forEach(l => {
            l.classList.remove('border-blue-500', 'text-blue-600', 'border-b-2');
            l.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });
        link.classList.add('border-blue-500', 'text-blue-600');
        link.classList.remove('border-transparent', 'text-gray-500');
    });
});

// Character counter for biography
document.getElementById('biography').addEventListener('input', (e) => {
    document.getElementById('bio-count').textContent = e.target.value.length;
});

// Photo preview
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            // Could add preview here if needed
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
