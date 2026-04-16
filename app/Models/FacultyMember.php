<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $department_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $position
 * @property string|null $specialization
 * @property string|null $biography
 * @property string|null $photo
 * @property array<array-key, mixed>|null $education
 * @property array<array-key, mixed>|null $research_interests
 * @property array<array-key, mixed>|null $publications
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @property-read string $full_name
 * @method static \Database\Factories\FacultyMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember wherePublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereResearchInterests($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FacultyMember withoutTrashed()
 * @mixin \Eloquent
 */
class FacultyMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'first_name',
        'last_name',
        'email',
        'position',
        'specialization',
        'biography',
        'photo',
        'education',
        'research_interests',
        'publications',
        'is_active',
        'is_advisor',
        'consultation_info',
        'office_location',
        'office_hours',
        'phone_number',
        'advisor_bio',
        'default_consultation_duration',
        'cancellation_deadline_hours',
        'is_advisor_visible',
        'profile_last_updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();

        // Delete old photo when updating
        static::updating(function ($model) {
            if ($model->isDirty('photo')) {
                $oldPhoto = $model->getOriginal('photo');
                if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }
        });

        // Delete photo when record is deleted
        static::deleting(function ($model) {
            if ($model->photo && Storage::disk('public')->exists($model->photo)) {
                Storage::disk('public')->delete($model->photo);
            }
        });
    }
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_advisor' => 'boolean',
            'is_advisor_visible' => 'boolean',
            'profile_last_updated_at' => 'datetime',
            'education' => 'json',
            'research_interests' => 'json',
            'publications' => 'json',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user associated with this faculty member
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get pending consultation requests count
     */
    public function getPendingConsultationCountAttribute(): int
    {
        return Consultation::where('advisor_id', $this->id)
            ->where('status', 'pending')
            ->count();
    }

    /**
     * Get upcoming consultations for this faculty member
     */
    public function getUpcomingConsultations($days = 7)
    {
        return Consultation::where('advisor_id', $this->id)
            ->where('status', 'approved')
            ->where('consultation_date', '>=', now())
            ->where('consultation_date', '<=', now()->addDays($days))
            ->orderBy('consultation_date')
            ->get();
    }

    /**
     * Get completed consultations for this month
     */
    public function getCompletedConsultationsThisMonth(): int
    {
        return Consultation::where('advisor_id', $this->id)
            ->where('status', 'completed')
            ->whereMonth('consultation_date', now()->month)
            ->count();
    }

    /**
     * Update the profile_last_updated_at timestamp
     */
    public function updateProfileTimestamp(): void
    {
        $this->update(['profile_last_updated_at' => now()]);
    }

    /**
     * Get the photo URL for display in views
     */
    public function getPhotoUrl(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        // If it's already a full URL, return it
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }

        // Convert to asset URL for public disk
        return asset('storage/' . $this->photo);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get education as display text (comma-separated or line-separated)
     */
    public function getEducationDisplayAttribute(): string
    {
        if (!$this->education) {
            return '';
        }

        $education = is_array($this->education) ? $this->education : json_decode($this->education, true);
        
        if (is_array($education)) {
            return implode("\n", $education);
        }

        return $education ?? '';
    }

    /**
     * Get research interests as display text
     */
    public function getResearchInterestsDisplayAttribute(): string
    {
        if (!$this->research_interests) {
            return '';
        }

        $interests = is_array($this->research_interests) ? $this->research_interests : json_decode($this->research_interests, true);
        
        if (is_array($interests)) {
            return implode(", ", $interests);
        }

        return $interests ?? '';
    }

    /**
     * Get publications as display text
     */
    public function getPublicationsDisplayAttribute(): string
    {
        if (!$this->publications) {
            return '';
        }

        $publications = is_array($this->publications) ? $this->publications : json_decode($this->publications, true);
        
        if (is_array($publications)) {
            return implode("\n", $publications);
        }

        return $publications ?? '';
    }
}
