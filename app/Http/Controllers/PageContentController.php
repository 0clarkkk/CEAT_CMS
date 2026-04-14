<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PageContentController extends Controller
{
    /**
     * Update page content via AJAX
     */
    public function update(Request $request): JsonResponse
    {
        // Check if user is admin
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'page_slug' => 'required|string|max:255',
            'section_key' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $pageContent = PageContent::setContent(
            $validated['page_slug'],
            $validated['section_key'],
            $validated['content']
        );

        return response()->json([
            'success' => true,
            'message' => 'Content updated successfully',
            'data' => $pageContent,
        ]);
    }

    /**
     * Get page content
     */
    public function show(string $pageSlug, string $sectionKey): JsonResponse
    {
        $content = PageContent::where('page_slug', $pageSlug)
            ->where('section_key', $sectionKey)
            ->first();

        if (!$content) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($content);
    }
}
