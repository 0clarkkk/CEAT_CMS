<?php

declare(strict_types=1);

namespace App\Notifications\Consultations;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationApprovedNotification extends Notification implements ShouldQueue
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
            ->subject('Consultation Request Approved')
            ->greeting("Hello {$notifiable->name},")
            ->line('Great news! Your consultation request has been approved.')
            ->line("**Consultation Details:**")
            ->line("Advisor: {$this->consultation->advisor->name}")
            ->line("Title: {$this->consultation->title}")
            ->when($this->consultation->scheduled_at, function (MailMessage $mail) {
                $mail->line("Scheduled Date: {$this->consultation->scheduled_at->format('M d, Y')}")
                    ->line("Time: {$this->consultation->scheduled_at->format('h:i A')}");
            })
            ->when($this->consultation->location, function (MailMessage $mail) {
                $mail->line("Location: {$this->consultation->location}");
            })
            ->action('View Details', route('student.consultations.show', $this->consultation))
            ->line('If you have any questions, please contact your advisor.');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'consultation_approved',
            'consultation_id' => $this->consultation->id,
            'title' => 'Consultation Request Approved',
            'message' => "Your consultation with {$this->consultation->advisor->name} has been approved",
            'url' => route('student.consultations.show', $this->consultation),
        ]);
    }
}
