@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12" style="margin-top: 2rem;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <a href="{{ route('student.consultations.index') }}" class="inline-flex items-center gap-2 text-tangerine-600 hover:text-tangerine-700 transition-colors mb-6 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Consultations
            </a>
            <h1 class="text-4xl font-bold text-slate-900 mb-3">Request a Consultation</h1>
            <p class="text-lg text-slate-600">Connect with faculty advisors for personalized academic guidance</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
            <!-- Form Header -->
            <div class="px-8 py-6 bg-gradient-to-r from-tangerine-400 to-tangerine-600 relative">
                <h2 class="text-2xl font-bold text-white relative z-10">New Consultation Request</h2>
                <p class="text-white/80 text-sm mt-1 relative z-10">Fill in the details below to submit your request</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-red-800 mb-2">Please fix these errors:</h3>
                                <ul class="space-y-1 text-sm text-red-700">
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
                        <label for="advisor_search" class="block text-sm font-semibold text-slate-900 mb-3">
                            Select an Advisor <span class="text-red-500">*</span>
                        </label>
                        @if($advisors->isEmpty())
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg mb-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.515 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-amber-800">No Advisors Available</h3>
                                        <p class="text-sm text-amber-700 mt-1">Currently, no advisors have active consultation schedules. Please check back later or contact the administration.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none z-10" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                                <input 
                                    type="text" 
                                    id="advisor_search" 
                                    placeholder="Search by name, email, or department..." 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-slate-300 bg-white text-slate-900 rounded-lg focus:border-tangerine-500 focus:ring-2 focus:ring-tangerine-200 transition-all"
                                    autocomplete="off"
                                >
                                <input type="hidden" id="advisor_id" name="advisor_id" value="{{ old('advisor_id') }}" required>
                                
                                <!-- Dropdown Results -->
                                @if($advisors->isNotEmpty())
                                    <div id="advisor_dropdown" class="absolute top-full left-0 right-0 mt-1 bg-white border border-slate-200 rounded-lg shadow-lg z-50 max-h-72 overflow-y-auto hidden">
                                        <div id="advisor_list" class="divide-y divide-slate-100"></div>
                                        <div id="no_results" class="p-6 text-center text-slate-500 hidden">
                                            <p class="text-sm">No advisors found</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Selected Advisor Display -->
                            <div id="selected_advisor" class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg hidden flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span id="selected_advisor_text" class="text-sm font-medium text-green-700"></span>
                                </div>
                                <button type="button" id="clear_advisor" class="p-1 hover:bg-green-100 rounded transition-colors">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        @error('advisor_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
                        <label for="title" class="block text-sm font-semibold text-slate-900 mb-3">
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
                            class="w-full px-4 py-3 border-2 border-slate-300 bg-white text-slate-900 rounded-lg focus:border-tangerine-500 focus:ring-2 focus:ring-tangerine-200 transition-all"
                        >
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-slate-900 mb-3">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="category" 
                            name="category" 
                            required 
                            class="w-full px-4 py-3 border-2 border-slate-300 bg-white text-slate-900 rounded-lg focus:border-tangerine-500 focus:ring-2 focus:ring-tangerine-200 transition-all"
                        >
                            <option value="">-- Select a category --</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" @selected(old('category') == $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-900 mb-3">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="5" 
                            required 
                            maxlength="1000" 
                            placeholder="Describe what you need help with in detail..." 
                            class="w-full px-4 py-3 border-2 border-slate-300 bg-white text-slate-900 rounded-lg focus:border-tangerine-500 focus:ring-2 focus:ring-tangerine-200 transition-all resize-none"
                            onkeyup="updateCharCount('description', 'descCharCount', 1000)"
                        >{{ old('description') }}</textarea>
                        <div class="mt-2 flex justify-between text-xs text-slate-500">
                            <span>Minimum 10 characters, maximum 1000</span>
                            <span id="descCharCount" class="font-medium">0 / 1000</span>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Notes (Optional) -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-slate-900 mb-3">
                            Additional Notes <span class="text-slate-500 text-xs">(Optional)</span>
                        </label>
                        <textarea 
                            id="notes" 
                            name="notes" 
                            rows="3" 
                            maxlength="500" 
                            placeholder="Any additional information..." 
                            class="w-full px-4 py-3 border-2 border-slate-300 bg-white text-slate-900 rounded-lg focus:border-tangerine-500 focus:ring-2 focus:ring-tangerine-200 transition-all resize-none"
                            onkeyup="updateCharCount('notes', 'notesCharCount', 500)"
                        >{{ old('notes') }}</textarea>
                        <div class="mt-2 flex justify-end text-xs text-slate-500">
                            <span id="notesCharCount" class="font-medium">0 / 500</span>
                        </div>
                        @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                        <a href="{{ route('student.consultations.index') }}" class="px-6 py-2.5 border-2 border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="px-8 py-2.5 bg-gradient-to-r from-tangerine-500 to-tangerine-600 hover:from-tangerine-600 hover:to-tangerine-700 text-white rounded-lg font-medium transition-all shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
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
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-tangerine-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                    </svg>
                    Tips for Success
                </h3>
                <ul class="space-y-3 text-sm text-slate-700">
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tangerine-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>Be specific about your concerns</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tangerine-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>Mention any relevant deadlines</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tangerine-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>Provide context about your situation</span>
                    </li>
                </ul>
            </div>

            <!-- Process Card -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-tangerine-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5A.75.75 0 0112 9zm.75 3.25a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5h-1.5z" clip-rule="evenodd" />
                    </svg>
                    What Happens Next
                </h3>
                <ol class="space-y-3 text-sm text-slate-700">
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-tangerine-500 text-white flex items-center justify-center text-xs font-bold">1</span>
                        <span>Submit your request</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-tangerine-500 text-white flex items-center justify-center text-xs font-bold">2</span>
                        <span>Advisor reviews within 24-48 hours</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-tangerine-500 text-white flex items-center justify-center text-xs font-bold">3</span>
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
        counter.classList.add('text-tangerine-600');
        counter.classList.remove('text-slate-500');
    } else {
        counter.classList.remove('text-tangerine-600');
        counter.classList.add('text-slate-500');
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
                <button type="button" class="w-full text-left px-4 py-3 hover:bg-slate-50 transition-colors advisor-option" data-id="${advisor.id}">
                    <p class="font-medium text-slate-900 text-sm">${advisor.name}</p>
                    <p class="text-xs text-slate-600">${advisor.email}</p>
                    <p class="text-xs text-slate-500 mt-1">${advisor.department}</p>
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
