<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Consultation;
use App\Models\User;

class ConsultationPolicy
{
    /**
     * Determine whether the user can view any consultations.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_active;
    }

    /**
     * Determine whether the user can view the consultation.
     */
    public function view(User $user, Consultation $consultation): bool
    {
        // Student can view their own consultations
        if ($user->id === $consultation->student_id) {
            return true;
        }

        // Advisor can view consultations assigned to them
        if ($user->id === $consultation->advisor_id && $user->hasRole('advisor')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create consultations.
     */
    public function create(User $user): bool
    {
        // Only students can create consultation requests
        return $user->is_active && $user->role === 'student';
    }

    /**
     * Determine whether the user can update the consultation.
     * Students can update their pending consultations (add notes).
     */
    public function update(User $user, Consultation $consultation): bool
    {
        // Only the student who created it can update pending consultations
        if ($user->id === $consultation->student_id && $consultation->isPending()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the consultation.
     * Students can delete their own pending consultations.
     */
    public function delete(User $user, Consultation $consultation): bool
    {
        // Only the student who created it can delete pending consultations
        if ($user->id === $consultation->student_id && $consultation->isPending()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the consultation.
     */
    public function restore(User $user, Consultation $consultation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the consultation.
     */
    public function forceDelete(User $user, Consultation $consultation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can approve the consultation.
     */
    public function approve(User $user, Consultation $consultation): bool
    {
        // Only the assigned advisor can approve
        return $user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->isPending();
    }

    /**
     * Determine whether the user can reject the consultation.
     */
    public function reject(User $user, Consultation $consultation): bool
    {
        // Only the assigned advisor can reject
        return $user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->isPending();
    }

    /**
     * Determine whether the user can schedule the consultation.
     */
    public function schedule(User $user, Consultation $consultation): bool
    {
        // Only the assigned advisor can schedule
        return $user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->isApproved();
    }

    /**
     * Determine whether the user can reschedule the consultation.
     */
    public function reschedule(User $user, Consultation $consultation): bool
    {
        // Only the assigned advisor can reschedule
        return $user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->canBeRescheduled();
    }

    /**
     * Determine whether the user can cancel the consultation.
     */
    public function cancel(User $user, Consultation $consultation): bool
    {
        // Student can cancel their own consultations
        if ($user->id === $consultation->student_id && $consultation->canBeCancelled()) {
            return true;
        }

        // Advisor can cancel their consultations
        if ($user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->canBeCancelled()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can complete the consultation.
     */
    public function complete(User $user, Consultation $consultation): bool
    {
        // Only the assigned advisor can mark as completed
        return $user->id === $consultation->advisor_id 
            && $user->hasRole('advisor')
            && $consultation->isScheduled();
    }
}
