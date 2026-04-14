<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DownloadCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get all forms in this category
     */
    public function forms(): HasMany
    {
        return $this->hasMany(DownloadableForm::class, 'category_id');
    }

    /**
     * Get active forms in this category
     */
    public function activeForms(): HasMany
    {
        return $this->forms()->where('is_active', true)->orderBy('order');
    }
}
