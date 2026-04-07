<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
