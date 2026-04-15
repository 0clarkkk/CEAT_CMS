<?php

namespace App\Observers;

use App\Models\DownloadableForm;

class DownloadableFormObserver
{
    /**
     * Handle the DownloadableForm "creating" event.
     */
    public function creating(DownloadableForm $downloadableForm): void
    {
        // Auto-set file_type from file_path if not provided
        if (!$downloadableForm->file_type && $downloadableForm->file_path) {
            $downloadableForm->file_type = pathinfo($downloadableForm->file_path, PATHINFO_EXTENSION);
        }

        // Auto-set file_size if not provided and file exists
        if (!$downloadableForm->file_size && $downloadableForm->file_path) {
            $filePath = storage_path("app/public/{$downloadableForm->file_path}");
            if (file_exists($filePath)) {
                $downloadableForm->file_size = filesize($filePath);
            }
        }
    }

    /**
     * Handle the DownloadableForm "updating" event.
     */
    public function updating(DownloadableForm $downloadableForm): void
    {
        // Auto-set file_type from file_path if changed and not provided
        if ($downloadableForm->isDirty('file_path') && !$downloadableForm->file_type) {
            $downloadableForm->file_type = pathinfo($downloadableForm->file_path, PATHINFO_EXTENSION);
        }

        // Auto-set file_size if file_path changed and not provided
        if ($downloadableForm->isDirty('file_path') && !$downloadableForm->isDirty('file_size')) {
            $filePath = storage_path("app/public/{$downloadableForm->file_path}");
            if (file_exists($filePath)) {
                $downloadableForm->file_size = filesize($filePath);
            }
        }
    }

    /**
     * Handle the DownloadableForm "deleted" event.
     */
    public function deleted(DownloadableForm $downloadableForm): void
    {
        //
    }

    /**
     * Handle the DownloadableForm "restored" event.
     */
    public function restored(DownloadableForm $downloadableForm): void
    {
        //
    }

    /**
     * Handle the DownloadableForm "force deleted" event.
     */
    public function forceDeleted(DownloadableForm $downloadableForm): void
    {
        //
    }
}
