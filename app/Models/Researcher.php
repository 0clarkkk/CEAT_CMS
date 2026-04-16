<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $research_center_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $bio
 * @property string|null $photo
 * @property string|null $specialization
 * @property string|null $affiliation
 * @property string|null $phone
 * @property string|null $website
 * @property array<array-key, mixed>|null $research_interests
 * @property int $order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ResearchCenter|null $researchCenter
 */
class Researcher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'research_center_id',
        'name',
        'email',
        'bio',
        'photo',
        'specialization',
        'affiliation',
        'phone',
        'website',
        'research_interests',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'research_interests' => 'json',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the research center this researcher belongs to
     */
    public function researchCenter(): BelongsTo
    {
        return $this->belongsTo(ResearchCenter::class);
    }
}
