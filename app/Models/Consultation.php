<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property int $id
 * @property int $student_id
 * @property int $advisor_id
 * @property string $title
 * @property string $description
 * @property string $category
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $scheduled_at
 * @property string|null $location
 * @property string|null $notes
 * @property string|null $rejection_reason
 * @property \Illuminate\Support\Carbon|null $rejected_at
 * @property int|null $rejected_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $student
 * @property-read User $advisor
 * @property-read User|null $rejectedBy
 */
class Consultation extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'student_id',
        'advisor_id',
        'title',
        'description',
        'category',
        'status',
        'scheduled_at',
        'location',
        'notes',
        'rejection_reason',
        'rejected_at',
        'rejected_by',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'rejected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::created(function (self $consultation) {
            \App\Events\Consultations\ConsultationCreated::dispatch($consultation);
        });
    }

    /**
     * Get the activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'scheduled_at', 'rejection_reason', 'rejected_at'])
            ->setDescriptionForEvent(fn(string $eventName) => "Consultation {$eventName}")
            ->useLogName('consultations');
    }

    /**
     * Get the student who requested the consultation.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the advisor for this consultation.
     */
    public function advisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    /**
     * Get the user who rejected the consultation (if any).
     */
    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Scope to get pending consultations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved consultations.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get scheduled consultations.
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope to get completed consultations.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope to get rejected consultations.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to get cancelled consultations.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope to get consultations for a specific student.
     */
    public function scopeForStudent($query, int $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Scope to get consultations for a specific advisor.
     */
    public function scopeForAdvisor($query, int $advisorId)
    {
        return $query->where('advisor_id', $advisorId);
    }

    /**
     * Scope to get upcoming consultations (scheduled after now).
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
            ->where('scheduled_at', '>', now());
    }

    /**
     * Scope to get past consultations (scheduled before now).
     */
    public function scopePast($query)
    {
        return $query->whereIn('status', ['scheduled', 'completed'])
            ->where('scheduled_at', '<', now());
    }

    /**
     * Check if the consultation is in pending status.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the consultation is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the consultation is scheduled.
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    /**
     * Check if the consultation is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the consultation is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if the consultation is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if the consultation can be cancelled.
     * Students and advisors can cancel anytime, but not if already completed.
     */
    public function canBeCancelled(): bool
    {
        return !in_array($this->status, ['completed', 'cancelled', 'rejected']);
    }

    /**
     * Check if the consultation can be rescheduled.
     * Only advisors can reschedule and only for scheduled/approved consultations.
     */
    public function canBeRescheduled(): bool
    {
        return in_array($this->status, ['scheduled', 'approved']);
    }

    /**
     * Check if the consultation is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'scheduled' && $this->scheduled_at > now();
    }

    /**
     * Check if the consultation is past due.
     */
    public function isPastDue(): bool
    {
        return $this->status === 'scheduled' && $this->scheduled_at < now();
    }

    /**
     * Dispatch event when consultation is approved.
     */
    public function markAsApproved(): void
    {
        $this->status = 'approved';
        $this->save();
        \App\Events\Consultations\ConsultationApproved::dispatch($this);
    }

    /**
     * Dispatch event when consultation is rejected.
     */
    public function markAsRejected(string $reason): void
    {
        $this->status = 'rejected';
        $this->rejection_reason = $reason;
        $this->rejected_at = now();
        $this->rejected_by = auth()->id();
        $this->save();
        \App\Events\Consultations\ConsultationRejected::dispatch($this);
    }

    /**
     * Dispatch event when consultation is scheduled.
     */
    public function markAsScheduled(): void
    {
        $this->status = 'approved';
        $this->save();
        \App\Events\Consultations\ConsultationScheduled::dispatch($this);
    }

    /**
     * Dispatch event when consultation is completed.
     */
    public function markAsCompleted(): void
    {
        $this->status = 'completed';
        $this->save();
        \App\Events\Consultations\ConsultationCompleted::dispatch($this);
    }
}
