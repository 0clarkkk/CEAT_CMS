<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
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

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'event_date' => 'datetime',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
