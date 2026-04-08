<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
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
    ];

    protected function casts(): array
    {
        return [
            'research_areas' => 'json',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
