<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
