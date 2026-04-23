<?php

declare(strict_types=1);

namespace App\Notifications\Consultations;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationScheduledNotification extends Notification implements ShouldQueue
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
            ->subject('Your Consultation has been Scheduled')
            ->greeting("Hello {$notifiable->name},")
            ->line('Your consultation has been scheduled!')
            ->line("**Consultation Details:**")
            ->line("Advisor: {$this->consultation->advisor->name}")
            ->line("Title: {$this->consultation->title}")
            ->line("Date: {$this->consultation->scheduled_at->format('l, F j, Y')}")
            ->line("Time: {$this->consultation->scheduled_at->format('h:i A')}")
            ->when($this->consultation->location, function (MailMessage $mail) {
                $mail->line("Location: {$this->consultation->location}");
            })
            ->line('Please arrive 5 minutes early. If you need to reschedule, contact your advisor as soon as possible.')
            ->action('View Consultation', route('student.consultations.show', $this->consultation))
            ->line('Thank you!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'consultation_scheduled',
            'consultation_id' => $this->consultation->id,
            'title' => 'Consultation Scheduled',
            'message' => "Your consultation is scheduled for {$this->consultation->scheduled_at->format('M d, Y at h:i A')}",
            'url' => route('student.consultations.show', $this->consultation),
        ]);
    }
}
