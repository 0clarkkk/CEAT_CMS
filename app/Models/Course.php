<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $program_id
 * @property string $code
 * @property string $title
 * @property string|null $description
 * @property int $units
 * @property string $semester
 * @property int $year_level
 * @property string|null $prerequisites
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Program|null $program
 * @method static \Database\Factories\CourseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course wherePrerequisites($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereYearLevel($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_id',
        'code',
        'title',
        'description',
        'units',
        'semester',
        'year_level',
        'prerequisites',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
