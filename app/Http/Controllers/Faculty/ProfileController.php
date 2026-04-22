<?php

declare(strict_types=1);

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the edit profile form
     */
    public function edit(): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('id', $user->faculty_member_id)->firstOrFail();

        return view('faculty.profile.edit', [
            'faculty' => $faculty,
        ]);
    }

    /**
     * Update faculty profile
     */
    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('id', $user->faculty_member_id)->firstOrFail();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:faculty_members,email,' . $faculty->id,
            'phone_number' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'biography' => 'nullable|string|max:2000',
            'office_location' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'education' => 'nullable|string',
            'research_interests' => 'nullable|string',
            'publications' => 'nullable|string',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('faculty', 'public');
            $validated['photo'] = $path;
        }

        // Convert text fields to JSON arrays where needed
        if (!empty($validated['education'])) {
            $validated['education'] = array_filter(array_map('trim', explode("\n", $validated['education'])));
        }
        
        if (!empty($validated['research_interests'])) {
            $validated['research_interests'] = array_filter(array_map('trim', explode(',', $validated['research_interests'])));
        }
        
        if (!empty($validated['publications'])) {
            $validated['publications'] = array_filter(array_map('trim', explode("\n", $validated['publications'])));
        }

        // Update faculty member
        $faculty->update($validated);
        $faculty->updateProfileTimestamp();

        // Update user name if changed
        if ($user->name !== "{$validated['first_name']} {$validated['last_name']}") {
            $user->update([
                'name' => "{$validated['first_name']} {$validated['last_name']}",
            ]);
        }

        return redirect()->route('faculty.profile.edit')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Show profile preview
     */
    public function preview(): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('id', $user->faculty_member_id)->firstOrFail();

        return view('faculty.profile.preview', [
            'faculty' => $faculty,
        ]);
    }

    /**
     * Show change history
     */
    public function changeHistory(): View
    {
        $user = auth()->user();
        $faculty = FacultyMember::where('id', $user->faculty_member_id)->firstOrFail();

        $activities = \Spatie\ActivityLog\Models\Activity::where('subject_type', FacultyMember::class)
            ->where('subject_id', $faculty->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('faculty.profile.change-history', [
            'faculty' => $faculty,
            'activities' => $activities,
        ]);
    }
}
