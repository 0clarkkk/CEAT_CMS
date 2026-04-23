<?php

declare(strict_types=1);

namespace App\Listeners\Consultations;

use App\Events\Consultations\ConsultationRejected;
use App\Notifications\Consultations\ConsultationRejectedNotification;

class SendConsultationRejectedNotification
{
    public function handle(ConsultationRejected $event): void
    {
        $event->consultation->student->notify(
            new ConsultationRejectedNotification($event->consultation)
        );
    }
}
