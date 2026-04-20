<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property int $id
 * @property int $advisor_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property string $status
 * @property string|null $location
 * @property string|null $notes
 * @property bool $is_recurring
 * @property string|null $recurrence_pattern
 * @property array|null $recurrence_days
 * @property int|null $recurrence_end_weeks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $advisor
 */
class AdvisorAvailabilitySlot extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'advisor_availability_slots';

    protected $fillable = [
        'advisor_id',
        'start_time',
        'end_time',
        'status',
        'location',
        'notes',
        'is_recurring',
        'recurrence_pattern',
        'recurrence_days',
        'recurrence_end_weeks',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_recurring' => 'boolean',
        'recurrence_days' => 'array',
    ];

    /**
     * Get the activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'start_time', 'end_time', 'location'])
            ->setDescriptionForEvent(fn(string $eventName) => "Availability slot {$eventName}")
            ->useLogName('availability_slots');
    }

    /**
     * Get the advisor who owns this availability slot.
     */
    public function advisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    /**
     * Scope to get available slots.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope to get booked slots.
     */
    public function scopeBooked($query)
    {
        return $query->where('status', 'booked');
    }

    /**
     * Scope to get blocked slots.
     */
    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    /**
     * Scope to get slots for a specific advisor.
     */
    public function scopeForAdvisor($query, int $advisorId)
    {
        return $query->where('advisor_id', $advisorId);
    }

    /**
     * Scope to get upcoming slots.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>', now());
    }

    /**
     * Scope to get slots within a date range.
     */
    public function scopeWithinRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_time', [$startDate, $endDate]);
    }

    /**
     * Scope to get slots for a specific date.
     */
    public function scopeOnDate($query, $date)
    {
        $start = \Carbon\Carbon::parse($date)->startOfDay();
        $end = \Carbon\Carbon::parse($date)->endOfDay();
        return $query->whereBetween('start_time', [$start, $end]);
    }

    /**
     * Check if the slot is available.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->start_time > now();
    }

    /**
     * Check if the slot is booked.
     */
    public function isBooked(): bool
    {
        return $this->status === 'booked';
    }

    /**
     * Check if the slot is blocked.
     */
    public function isBlocked(): bool
    {
        return $this->status === 'blocked';
    }

    /**
     * Check if the slot overlaps with another slot.
     */
    public static function hasConflict(int $advisorId, $startTime, $endTime, ?int $excludeSlotId = null): bool
    {
        $query = static::forAdvisor($advisorId)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function ($q) use ($startTime, $endTime) {
                      $q->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $endTime);
                  });
            });

        if ($excludeSlotId) {
            $query->where('id', '!=', $excludeSlotId);
        }

        return $query->exists();
    }

    /**
     * Get the duration of the slot in minutes.
     */
    public function getDurationInMinutes(): int
    {
        return (int) $this->end_time->diffInMinutes($this->start_time);
    }

    /**
     * Get the duration of the slot as a readable string.
     */
    public function getFormattedDuration(): string
    {
        $minutes = (int) $this->getDurationInMinutes();
        $hours = (int) floor($minutes / 60);
        $mins = (int) ($minutes % 60);

        if ($hours > 0) {
            return "{$hours}h " . ($mins > 0 ? "{$mins}m" : '');
        }

        return "{$mins}m";
    }
}
