<?php

namespace App\Http\Controllers;

use App\Models\DownloadCategory;
use App\Models\DownloadableForm;
use Illuminate\View\View;

class PublicDownloadController extends Controller
{
    /**
     * Show all download categories
     */
    public function index(): View
    {
        $categories = DownloadCategory::where('is_active', true)
            ->with(['forms' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return view('public.downloads.index', compact('categories'));
    }

    /**
     * Show forms in a specific category
     */
    public function show(DownloadCategory $downloadCategory): View
    {
        abort_if(!$downloadCategory->is_active, 404);

        $forms = $downloadCategory->forms()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $categories = DownloadCategory::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('public.downloads.show', compact('downloadCategory', 'forms', 'categories'));
    }

    /**
     * Download a form and track the download
     */
    public function download(DownloadableForm $downloadableForm)
    {
        abort_if(!$downloadableForm->is_active, 404);
        abort_if(!$downloadableForm->category->is_active, 404);

        // Increment download count
        $downloadableForm->incrementDownloadCount();

        return response()->download(
            storage_path("app/public/{$downloadableForm->file_path}"),
            $downloadableForm->title . '.' . $downloadableForm->file_type
        );
    }
}
