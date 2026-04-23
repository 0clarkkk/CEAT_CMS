<?php

declare(strict_types=1);

namespace App\Listeners\Consultations;

use App\Events\Consultations\ConsultationScheduled;
use App\Notifications\Consultations\ConsultationScheduledNotification;

class SendConsultationScheduledNotification
{
    public function handle(ConsultationScheduled $event): void
    {
        $event->consultation->student->notify(
            new ConsultationScheduledNotification($event->consultation)
        );
    }
}
