<?php

declare(strict_types=1);

namespace App\Listeners\Consultations;

use App\Events\Consultations\ConsultationApproved;
use App\Notifications\Consultations\ConsultationApprovedNotification;

class SendConsultationApprovedNotification
{
    public function handle(ConsultationApproved $event): void
    {
        $event->consultation->student->notify(
            new ConsultationApprovedNotification($event->consultation)
        );
    }
}
