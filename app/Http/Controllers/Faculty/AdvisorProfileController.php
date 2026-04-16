<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdvisorProfileController extends Controller
{
    /**
     * Show the advisor profile management page
     */
    public function show(): View
    {
        $faculty = FacultyMember::where('email', auth()->user()->email)->firstOrFail();
        return view('faculty.advisor-profile.show', compact('faculty'));
    }

    /**
     * Show the form to edit advisor profile
     */
    public function edit(): View
    {
        $faculty = FacultyMember::where('email', auth()->user()->email)->firstOrFail();
        return view('faculty.advisor-profile.edit', compact('faculty'));
    }

    /**
     * Update advisor profile
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'is_advisor' => 'required|boolean',
            'consultation_info' => 'nullable|string|max:1000',
            'office_location' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $faculty = FacultyMember::where('email', auth()->user()->email)->firstOrFail();
        
        $isNowAdvisor = $validated['is_advisor'];

        // If becoming an advisor, require consultation info
        if ($isNowAdvisor && !$faculty->consultation_info) {
            $request->validate([
                'consultation_info' => 'required|string|max:1000',
                'office_location' => 'required|string|max:255',
                'office_hours' => 'required|string|max:255',
            ]);
        }

        $faculty->update($validated);

        return redirect()->route('faculty.advisor-profile.show')
            ->with('success', $isNowAdvisor ? 'You are now an active advisor!' : 'You have deactivated advisor status.');
    }

    /**
     * Toggle advisor status
     */
    public function toggleStatus(): RedirectResponse
    {
        $faculty = FacultyMember::where('email', auth()->user()->email)->firstOrFail();

        if (!$faculty->is_advisor && !$faculty->consultation_info) {
            return redirect()->route('faculty.advisor-profile.edit')
                ->with('error', 'Please fill in your consultation information before becoming an advisor.');
        }

        $faculty->is_advisor = !$faculty->is_advisor;
        $faculty->save();

        $message = $faculty->is_advisor 
            ? 'You are now an active advisor!' 
            : 'You have deactivated advisor status.';

        return redirect()->route('faculty.advisor-profile.show')
            ->with('success', $message);
    }
}
