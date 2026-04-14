<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = ['page_slug', 'section_key', 'content'];

    /**
     * Get content for a specific page and section
     */
    public static function getContent(string $pageSlug, string $sectionKey, string $default = ''): string
    {
        return self::where('page_slug', $pageSlug)
            ->where('section_key', $sectionKey)
            ->value('content') ?? $default;
    }

    /**
     * Update or create content for a page section
     */
    public static function setContent(string $pageSlug, string $sectionKey, string $content): self
    {
        return self::updateOrCreate(
            ['page_slug' => $pageSlug, 'section_key' => $sectionKey],
            ['content' => $content]
        );
    }
}
