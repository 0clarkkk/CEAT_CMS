<?php

declare(strict_types=1);

namespace App\Notifications\Advisor;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewConsultationRequestNotification extends Notification implements ShouldQueue
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
            ->subject('New Consultation Request')
            ->greeting("Hello {$notifiable->name},")
            ->line('You have received a new consultation request.')
            ->line("**Request Details:**")
            ->line("Student: {$this->consultation->student->name}")
            ->line("Title: {$this->consultation->title}")
            ->line("Category: {$this->consultation->category}")
            ->line("Description: {$this->consultation->description}")
            ->action('Review Request', route('advisor.consultations.show', $this->consultation))
            ->line('Please review and respond to this request at your earliest convenience.');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'type' => 'new_consultation_request',
            'consultation_id' => $this->consultation->id,
            'title' => 'New Consultation Request',
            'message' => "New consultation request from {$this->consultation->student->name}: {$this->consultation->title}",
            'url' => route('advisor.consultations.show', $this->consultation),
        ]);
    }
}
