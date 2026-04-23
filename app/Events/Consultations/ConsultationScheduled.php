<?php

declare(strict_types=1);

namespace App\Events\Consultations;

use App\Models\Consultation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsultationScheduled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Consultation $consultation)
    {
    }
}
