<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'education' => 'json',
            'research_interests' => 'json',
            'publications' => 'json',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
