<?php

declare(strict_types=1);

namespace App\Listeners\Consultations;

use App\Events\Consultations\ConsultationCreated;
use App\Notifications\Consultations\ConsultationRequestedNotification;
use App\Notifications\Advisor\NewConsultationRequestNotification;

class SendConsultationRequestedNotifications
{
    public function handle(ConsultationCreated $event): void
    {
        // Notify student that request was submitted
        $event->consultation->student->notify(
            new ConsultationRequestedNotification($event->consultation)
        );

        // Notify advisor of new request
        $event->consultation->advisor->notify(
            new NewConsultationRequestNotification($event->consultation)
        );
    }
}
