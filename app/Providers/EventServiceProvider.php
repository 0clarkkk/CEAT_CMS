<?php

namespace App\Providers;

use App\Events\Consultations\ConsultationApproved;
use App\Events\Consultations\ConsultationCreated;
use App\Events\Consultations\ConsultationRejected;
use App\Events\Consultations\ConsultationScheduled;
use App\Listeners\Consultations\SendConsultationApprovedNotification;
use App\Listeners\Consultations\SendConsultationRejectedNotification;
use App\Listeners\Consultations\SendConsultationRequestedNotifications;
use App\Listeners\Consultations\SendConsultationScheduledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ConsultationCreated::class => [
            SendConsultationRequestedNotifications::class,
        ],
        ConsultationApproved::class => [
            SendConsultationApprovedNotification::class,
        ],
        ConsultationRejected::class => [
            SendConsultationRejectedNotification::class,
        ],
        ConsultationScheduled::class => [
            SendConsultationScheduledNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
