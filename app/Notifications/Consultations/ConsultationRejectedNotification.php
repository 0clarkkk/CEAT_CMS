<?php

declare(strict_types=1);

namespace App\Notifications\Consultations;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Consultation $consultation)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Consultation Request Status Update')
            ->greeting("Hello {$notifiable->name},")
            ->line('Your consultation request has been reviewed.')
            ->line("**Request Details:**")
            ->line("Title: {$this->consultation->title}")
            ->line("Advisor: {$this->consultation->advisor->name}")
            ->when($this->consultation->rejection_reason, function (MailMessage $mail) {
                $mail->line("**Reason:**")
                    ->line($this->consultation->rejection_reason);
            })
            ->line('You can submit another consultation request at any time.')
            ->action('Submit New Request', route('student.consultations.browse'))
            ->line('If you have questions, please contact your advisor directly.');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'consultation_rejected',
            'consultation_id' => $this->consultation->id,
            'title' => 'Consultation Request Not Accepted',
            'message' => $this->consultation->rejection_reason ?? 'Your consultation request was not accepted',
            'url' => route('student.consultations.show', $this->consultation),
        ]);
    }
}
