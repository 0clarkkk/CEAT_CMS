@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-slate-950 to-slate-900 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <a href="{{ route('student.consultations.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors mb-6 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Consultations
            </a>
            <h1 class="text-4xl font-bold text-slate-900 dark:text-black mb-3">Request a Consultation</h1>
            <p class="text-lg text-slate-600 dark:text-slate-300">Connect with faculty advisors for personalized academic guidance</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
            <!-- Form Header -->
            <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-700 dark:to-blue-700">
                <h2 class="text-2xl font-bold text-black">New Consultation Request</h2>
                <p class="text-indigo-100 text-sm mt-1">Fill in the details below to submit your request</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-red-800 dark:text-red-200 mb-2">Please fix these errors:</h3>
                                <ul class="space-y-1 text-sm text-red-700 dark:text-red-300">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('student.consultations.store') }}" id="consultationForm" class="space-y-6">
                    @csrf

                    <!-- Advisor Selection -->
                    <div>
                        <label for="advisor_search" class="block text-sm font-semibold text-slate-900 dark:text-black mb-3">
                            Select an Advisor <span class="text-red-500">*</span>
                        </label>
                        @if($advisors->isEmpty())
                            <div class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-lg mb-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-amber-800 dark:text-amber-200">No Advisors Available</h3>
                                        <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">Currently, no advisors have active consultation schedules. Please check back later or contact the administration.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input 
                                    type="text" 
                                    id="advisor_search" 
                                    placeholder="Search by name, email, or department..." 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-600 text-slate-900 dark:text-black dark:placeholder-slate-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all"
                                    autocomplete="off"
                                >
                                <input type="hidden" id="advisor_id" name="advisor_id" value="{{ old('advisor_id') }}" required>
                                
                                <!-- Dropdown Results -->
                                @if($advisors->isNotEmpty())
                                    <div id="advisor_dropdown" class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-50 max-h-72 overflow-y-auto hidden">
                                        <div id="advisor_list" class="divide-y divide-slate-100 dark:divide-slate-600"></div>
                                        <div id="no_results" class="p-6 text-center text-slate-500 dark:text-slate-400 hidden">
                                            <p class="text-sm">No advisors found</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Selected Advisor Display -->
                            <div id="selected_advisor" class="mt-3 p-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-700 rounded-lg hidden flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span id="selected_advisor_text" class="text-sm font-medium text-emerald-700 dark:text-emerald-300"></span>
                                </div>
                                <button type="button" id="clear_advisor" class="p-1 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 rounded transition-colors">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        @error('advisor_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Advisors Data (JSON) -->
                    <script>
                        const advisorsData = {!! json_encode($advisors->map(fn($a) => [
                            'id' => (int)$a->id,
                            'name' => $a->name,
                            'email' => $a->email,
                            'department' => $a->facultyMember?->department?->name ?? 'N/A'
                        ])->values()) !!};
                        
                        // Debug: Log advisors data
                        console.log('Advisors loaded:', advisorsData.length, advisorsData);
                    </script>

                    <!-- Consultation Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-900 dark:text-black mb-3">
                            Consultation Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            required 
                            maxlength="255" 
                            value="{{ old('title') }}" 
                            placeholder="e.g., Help with Course Registration" 
                            class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-600 text-slate-900 dark:text-black dark:placeholder-slate-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all"
                        >
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-slate-900 dark:text-black mb-3">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="category" 
                            name="category" 
                            required 
                            class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-600 text-slate-900 dark:text-black rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all"
                        >
                            <option value="">-- Select a category --</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" @selected(old('category') == $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-900 dark:text-black mb-3">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="5" 
                            required 
                            maxlength="1000" 
                            placeholder="Describe what you need help with in detail..." 
                            class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-600 text-slate-900 dark:text-black dark:placeholder-slate-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all resize-none"
                            onkeyup="updateCharCount('description', 'descCharCount', 1000)"
                        >{{ old('description') }}</textarea>
                        <div class="mt-2 flex justify-between text-xs text-slate-500 dark:text-slate-400">
                            <span>Minimum 10 characters, maximum 1000</span>
                            <span id="descCharCount" class="font-medium">0 / 1000</span>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Notes (Optional) -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-slate-900 dark:text-black mb-3">
                            Additional Notes <span class="text-slate-500 text-xs">(Optional)</span>
                        </label>
                        <textarea 
                            id="notes" 
                            name="notes" 
                            rows="3" 
                            maxlength="500" 
                            placeholder="Any additional information..." 
                            class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-600 text-slate-900 dark:text-black dark:placeholder-slate-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all resize-none"
                            onkeyup="updateCharCount('notes', 'notesCharCount', 500)"
                        >{{ old('notes') }}</textarea>
                        <div class="mt-2 flex justify-end text-xs text-slate-500 dark:text-slate-400">
                            <span id="notesCharCount" class="font-medium">0 / 500</span>
                        </div>
                        @error('notes')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('student.consultations.index') }}" class="px-6 py-2.5 border-2 border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg font-medium hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 dark:from-indigo-700 dark:to-blue-700 dark:hover:from-indigo-800 dark:hover:to-blue-800 text-black rounded-lg font-medium transition-all shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            @if($advisors->isEmpty()) disabled @endif
                        >
                            <span id="submitBtnText">Submit Request</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Cards Below Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Tips Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-black mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm0 3a1 1 0 000 2h3a1 1 0 000-2H8z" clip-rule="evenodd"></path>
                    </svg>
                    Tips for Success
                </h3>
                <ul class="space-y-3 text-sm text-slate-700 dark:text-slate-300">
                    <li class="flex gap-3">
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold flex-shrink-0">✓</span>
                        <span>Be specific about your concerns</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold flex-shrink-0">✓</span>
                        <span>Mention any relevant deadlines</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold flex-shrink-0">✓</span>
                        <span>Provide context about your situation</span>
                    </li>
                </ul>
            </div>

            <!-- Process Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-black mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17a1 1 0 102 0v-1a1 1 0 10-2 0v1zM5.757 15.657a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM2 10a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.757 4.343a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707z"></path>
                    </svg>
                    What Happens Next
                </h3>
                <ol class="space-y-3 text-sm text-slate-700 dark:text-slate-300">
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 dark:bg-blue-500 text-black flex items-center justify-center text-xs font-bold">1</span>
                        <span>Submit your request</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 dark:bg-blue-500 text-black flex items-center justify-center text-xs font-bold">2</span>
                        <span>Advisor reviews within 24-48 hours</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 dark:bg-blue-500 text-black flex items-center justify-center text-xs font-bold">3</span>
                        <span>Schedule your consultation</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<script>
function updateCharCount(textareaId, counterId, maxLength) {
    const textarea = document.getElementById(textareaId);
    const counter = document.getElementById(counterId);
    const currentLength = textarea.value.length;
    counter.textContent = currentLength + ' / ' + maxLength;
    
    if (currentLength > maxLength * 0.8) {
        counter.classList.add('text-orange-600', 'dark:text-orange-400');
        counter.classList.remove('text-slate-500', 'dark:text-slate-400');
    } else {
        counter.classList.remove('text-orange-600', 'dark:text-orange-400');
        counter.classList.add('text-slate-500', 'dark:text-slate-400');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateCharCount('description', 'descCharCount', 1000);
    updateCharCount('notes', 'notesCharCount', 500);
    
    // Get references to form elements
    const form = document.getElementById('consultationForm');
    const submitBtn = document.getElementById('submitBtn');
    const advisorIdInput = document.getElementById('advisor_id');
    const searchInput = document.getElementById('advisor_search');
    const dropdown = document.getElementById('advisor_dropdown');
    const advisorList = document.getElementById('advisor_list');
    const noResults = document.getElementById('no_results');
    const selectedAdvisorDiv = document.getElementById('selected_advisor');
    const selectedAdvisorText = document.getElementById('selected_advisor_text');
    const clearBtn = document.getElementById('clear_advisor');
    
    // Form submission validation
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate that advisor is selected
            if (!advisorIdInput.value || advisorIdInput.value === '') {
                e.preventDefault();
                alert('Please select an advisor before submitting.');
                return false;
            }
            
            // Disable button during submission
            submitBtn.disabled = true;
            document.getElementById('submitBtnText').textContent = 'Submitting...';
            
            console.log('Form submitted with advisor_id:', advisorIdInput.value);
        });
    }
    
    // Only initialize advisor search if advisors are available
    if (advisorsData.length === 0 || !searchInput) {
        console.log('No advisors available for consultation');
        return;
    }
    
    if (advisorIdInput.value) {
        const selectedId = parseInt(advisorIdInput.value);
        const selected = advisorsData.find(a => a.id === selectedId);
        if (selected) {
            searchInput.value = selected.name;
            showSelectedAdvisor(selected);
            console.log('Pre-selected advisor:', selected);
        }
    }
    
    clearBtn.addEventListener('click', function(e) {
        e.preventDefault();
        advisorIdInput.value = '';
        searchInput.value = '';
        selectedAdvisorDiv.classList.add('hidden');
        dropdown.classList.add('hidden');
        searchInput.focus();
    });
    
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        
        console.log('Search query:', query, 'Available advisors:', advisorsData.length);
        
        if (query.length === 0) {
            dropdown.classList.add('hidden');
            return;
        }
        
        const filtered = advisorsData.filter(advisor => {
            const nameMatch = advisor.name.toLowerCase().includes(query);
            const emailMatch = advisor.email.toLowerCase().includes(query);
            const deptMatch = advisor.department.toLowerCase().includes(query);
            return nameMatch || emailMatch || deptMatch;
        });
        
        console.log('Filtered results:', filtered.length, filtered);
        
        if (filtered.length === 0) {
            advisorList.innerHTML = '';
            noResults.classList.remove('hidden');
            dropdown.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
            advisorList.innerHTML = filtered.map(advisor => `
                <button type="button" class="w-full text-left px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-600/50 transition-colors advisor-option" data-id="${advisor.id}">
                    <p class="font-medium text-slate-900 dark:text-black text-sm">${advisor.name}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">${advisor.email}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">${advisor.department}</p>
                </button>
            `).join('');
            
            dropdown.classList.remove('hidden');
            
            document.querySelectorAll('.advisor-option').forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const advisorId = parseInt(this.getAttribute('data-id'));
                    const selected = advisorsData.find(a => a.id === advisorId);
                    
                    console.log('Selected advisor:', selected);
                    console.log('Setting advisor_id to:', advisorId);
                    
                    advisorIdInput.value = advisorId;
                    console.log('advisor_id input value is now:', advisorIdInput.value);
                    
                    searchInput.value = selected.name;
                    showSelectedAdvisor(selected);
                    dropdown.classList.add('hidden');
                });
            });
        }
    });
    
    searchInput.addEventListener('focus', function() {
        if (this.value.length > 0) {
            dropdown.classList.remove('hidden');
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#advisor_search') && !e.target.closest('#advisor_dropdown')) {
            dropdown.classList.add('hidden');
        }
    });
    
    function showSelectedAdvisor(advisor) {
        selectedAdvisorText.textContent = `${advisor.name} • ${advisor.email}`;
        selectedAdvisorDiv.classList.remove('hidden');
    }
});
</script>
@endsection
