<?php

declare(strict_types=1);

namespace App\Notifications\Consultations;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationRequestedNotification extends Notification implements ShouldQueue
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
            ->subject('Consultation Request Confirmation')
            ->greeting("Hello {$notifiable->name},")
            ->line('Your consultation request has been submitted successfully.')
            ->line("**Request Details:**")
            ->line("Title: {$this->consultation->title}")
            ->line("Category: {$this->consultation->category}")
            ->line("Advisor: {$this->consultation->advisor->name}")
            ->line('Your advisor will review your request and get back to you shortly.')
            ->action('View Consultation', route('student.consultations.show', $this->consultation))
            ->line('Thank you for using our consultation system!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'consultation_requested',
            'consultation_id' => $this->consultation->id,
            'title' => "Consultation request submitted to {$this->consultation->advisor->name}",
            'message' => $this->consultation->title,
            'url' => route('student.consultations.show', $this->consultation),
        ]);
    }
}
