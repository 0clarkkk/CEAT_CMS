<?php

namespace Database\Seeders;

use App\Models\NotificationPreference;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationPreferencesSeeder extends Seeder
{
    /**
     * Seed notification preferences for all users.
     */
    public function run(): void
    {
        $notificationTypes = [
            'consultation_requested',
            'consultation_approved',
            'consultation_rejected',
            'consultation_scheduled',
            'consultation_reminder',
            'new_consultation_request',
        ];

        $users = User::all();

        foreach ($users as $user) {
            foreach ($notificationTypes as $type) {
                NotificationPreference::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'notification_type' => $type,
                    ],
                    [
                        'email' => true,
                        'in_app' => true,
                        'sms' => false,
                        'push' => true,
                    ]
                );
            }
        }
    }
}
