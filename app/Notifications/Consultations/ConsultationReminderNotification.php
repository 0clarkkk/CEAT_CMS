<?php

declare(strict_types=1);

namespace App\Notifications\Consultations;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationReminderNotification extends Notification implements ShouldQueue
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
            ->subject('Reminder: Your Consultation is Tomorrow')
            ->greeting("Hello {$notifiable->name},")
            ->line('This is a friendly reminder about your upcoming consultation.')
            ->line("**Consultation Details:**")
            ->line("Advisor: {$this->consultation->advisor->name}")
            ->line("Title: {$this->consultation->title}")
            ->line("Date: {$this->consultation->scheduled_at->format('l, F j, Y')}")
            ->line("Time: {$this->consultation->scheduled_at->format('h:i A')}")
            ->when($this->consultation->location, function (MailMessage $mail) {
                $mail->line("Location: {$this->consultation->location}");
            })
            ->line('Please make sure to be available at the scheduled time.')
            ->action('View Consultation', route('student.consultations.show', $this->consultation))
            ->line('See you soon!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'consultation_reminder',
            'consultation_id' => $this->consultation->id,
            'title' => 'Consultation Reminder',
            'message' => "Your consultation with {$this->consultation->advisor->name} is tomorrow at {$this->consultation->scheduled_at->format('h:i A')}",
            'url' => route('student.consultations.show', $this->consultation),
        ]);
    }
}
