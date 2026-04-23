<?php

declare(strict_types=1);

namespace App\Jobs\Consultations;

use App\Models\Consultation;
use App\Notifications\Consultations\ConsultationReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendConsultationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // Find consultations scheduled for 24 hours from now
        $tomorrow = now()->addDay();
        $consultations = Consultation::where('status', 'approved')
            ->whereDate('scheduled_at', $tomorrow->date())
            ->whereTime('scheduled_at', '>=', $tomorrow->copy()->startOfDay()->toTimeString())
            ->whereTime('scheduled_at', '<=', $tomorrow->copy()->endOfDay()->toTimeString())
            ->get();

        foreach ($consultations as $consultation) {
            $consultation->student->notify(
                new ConsultationReminderNotification($consultation)
            );
        }
    }
}
