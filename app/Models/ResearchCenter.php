<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $director
 * @property array<array-key, mixed>|null $research_areas
 * @property string|null $facilities
 * @property string|null $contact_email
 * @property bool $is_featured
 * @property int $featured_order
 * @property string|null $featured_image
 * @property string|null $featured_description
 * @property string|null $thumbnail_photo
 * @property array<array-key, string>|null $gallery
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Researcher>|null $researchers
 * @method static \Database\Factories\ResearchCenterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereResearchAreas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResearchCenter withoutTrashed()
 * @mixin \Eloquent
 */
class ResearchCenter extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'name',
        'slug',
        'description',
        'director',
        'research_areas',
        'facilities',
        'contact_email',
        'is_featured',
        'featured_order',
        'featured_image',
        'featured_description',
        'thumbnail_photo',
        'gallery',
        'published_at',
    ];

    protected $appends = [
        'clean_featured_description',
        'clean_description',
    ];

    protected function casts(): array
    {
        return [
            'research_areas' => 'json',
            'gallery' => 'json',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function getResearchAreasAttribute($value)
    {
        if (is_array($value)) {
            return !empty($value) ? $value : [['area' => '', 'description' => '']];
        }
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) && !empty($decoded) ? $decoded : [['area' => '', 'description' => '']];
        }
        return [['area' => '', 'description' => '']];
    }

    public function setResearchAreasAttribute($value)
    {
        if (is_array($value)) {
            // Filter out empty rows (where both area and description are empty)
            $filtered = array_filter($value, function ($item) {
                if (is_array($item)) {
                    return !empty(trim($item['area'] ?? '')) || !empty(trim($item['description'] ?? ''));
                }
                return !empty($item);
            });
            $this->attributes['research_areas'] = !empty($filtered) ? json_encode($filtered) : null;
        } else {
            $this->attributes['research_areas'] = $value;
        }
    }

    public function getGalleryAttribute($value)
    {
        if (is_array($value)) {
            return !empty($value) ? array_filter($value) : [];
        }
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) && !empty($decoded) ? array_filter($decoded) : [];
        }
        return [];
    }

    public function setGalleryAttribute($value)
    {
        if (is_array($value)) {
            // Filter out empty values
            $filtered = array_filter($value, function ($item) {
                return !empty(trim((string)$item));
            });
            $this->attributes['gallery'] = !empty($filtered) ? json_encode(array_values($filtered)) : null;
        } else {
            $this->attributes['gallery'] = $value;
        }
    }

    /**
     * Detect file type (photo or video) from file path
     */
    public function getFileType(string $path): string
    {
        $photoExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'];
        
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        if (in_array($extension, $photoExtensions)) {
            return 'photo';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        }
        
        return 'photo'; // default to photo
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::saved(function ($model) {
            // Delete researchers with both name and email empty
            $model->researchers()
                ->whereRaw("(TRIM(COALESCE(name, '')) = '' AND TRIM(COALESCE(email, '')) = '')")
                ->delete();

            // Filter out empty research areas from JSON
            if ($model->research_areas) {
                $filtered = array_filter($model->research_areas, function ($item) {
                    if (is_array($item)) {
                        return !empty(trim($item['area'] ?? '')) || !empty(trim($item['description'] ?? ''));
                    }
                    return !empty($item);
                });
                $newValue = !empty($filtered) ? array_values($filtered) : null;
                if ((json_encode($model->research_areas) !== json_encode($newValue))) {
                    $model->fill(['research_areas' => $newValue])->saveQuietly();
                }
            }

            // Filter out empty gallery items from JSON
            if ($model->gallery) {
                $filtered = array_filter($model->gallery, function ($item) {
                    return !empty(trim((string)$item));
                });
                $newValue = !empty($filtered) ? array_values($filtered) : null;
                if ((json_encode($model->gallery) !== json_encode($newValue))) {
                    $model->fill(['gallery' => $newValue])->saveQuietly();
                }
            }
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all researchers for this research center
     */
    public function researchers(): HasMany
    {
        return $this->hasMany(Researcher::class)->orderBy('order', 'asc')->where('is_active', true);
    }

    /**
     * Get clean featured description for frontend display
     */
    public function getCleanFeaturedDescriptionAttribute(): string
    {
        if ($this->featured_description) {
            $text = strip_tags($this->featured_description);
            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
            return Str::squish($text);
        }
        if ($this->description) {
            $text = strip_tags($this->description);
            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
            return Str::squish($text);
        }
        return '';
    }

    /**
     * Get clean description for frontend display
     */
    public function getCleanDescriptionAttribute(): string
    {
        if ($this->description) {
            $text = strip_tags($this->description);
            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
            return Str::squish($text);
        }
        return '';
    }
}   