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
 * @property int|null $department_id
 * @property bool $applies_to_all_departments
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string|null $excerpt
 * @property string $content
 * @property string|null $featured_image
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $event_date
 * @property string|null $location
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Department> $departments
 * @method static \Database\Factories\NewsEventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent withoutTrashed()
 * @mixin \Eloquent
 */
class NewsEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'applies_to_all_departments',
        'title',
        'slug',
        'type',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'event_date',
        'location',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();

        // Delete old featured image when updating
        static::updating(function ($model) {
            if ($model->isDirty('featured_image')) {
                $oldImage = $model->getOriginal('featured_image');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });

        // Delete featured image when record is deleted
        static::deleting(function ($model) {
            if ($model->featured_image && Storage::disk('public')->exists($model->featured_image)) {
                Storage::disk('public')->delete($model->featured_image);
            }
        });
    }
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'event_date' => 'datetime',
            'applies_to_all_departments' => 'boolean',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all departments this news/event is associated with (many-to-many)
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_news_event');
    }

    /**
     * Get applicable departments - either all departments or specific ones
     */
    public function getApplicableDepartments()
    {
        if ($this->applies_to_all_departments) {
            return Department::all();
        }
        
        // If specific departments are set, use those
        $specific = $this->departments()->get();
        if ($specific->isNotEmpty()) {
            return $specific;
        }
        
        // Fallback to primary department if set
        if ($this->department_id) {
            return collect([$this->department]);
        }
        
        return collect([]);
    }

    /**
     * Get department display text for list views
     */
    public function getDepartmentDisplayText(): string
    {
        if ($this->applies_to_all_departments) {
            return 'All Departments';
        }
        
        $departments = $this->departments()->get();
        if ($departments->isNotEmpty()) {
            if ($departments->count() === 1) {
                return $departments->first()->name;
            }
            return "{$departments->count()} Departments";
        }
        
        return $this->department?->name ?? 'Unassigned';
    }

    /**
     * Get the featured image URL for display in views
     */
    public function getFeaturedImageUrl(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's already a full URL, return it
        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        // Convert to asset URL for public disk
        return asset('storage/' . $this->featured_image);
    }
}
