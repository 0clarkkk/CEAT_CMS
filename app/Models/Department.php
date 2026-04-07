<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'building_name',
        'location',
        'contact_email',
        'contact_phone',
        'history',
        'mission',
        'vision',
        'is_center_of_excellence',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_center_of_excellence' => 'boolean',
            'metadata' => 'json',
        ];
    }

    /**
     * Get all programs for this department.
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    /**
     * Get all faculty members in this department.
     */
    public function facultyMembers(): HasMany
    {
        return $this->hasMany(FacultyMember::class);
    }

    /**
     * Get all research centers in this department.
     */
    public function researchCenters(): HasMany
    {
        return $this->hasMany(ResearchCenter::class);
    }

    /**
     * Get all news and events for this department.
     */
    public function newsEvents(): HasMany
    {
        return $this->hasMany(NewsEvent::class);
    }
}
