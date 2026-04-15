<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Superadmin user
        $superadmin = User::updateOrCreate(
            ['email' => 'superadmin@uphsd.edu.ph'],
            [
                'name' => 'System Administrator',
                'password' => bcrypt('SuperAdmin@2024'),
                'role' => 'superadmin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $superadmin->syncRoles('superadmin');

        // Create or update Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@uphsd.edu.ph'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('Admin@2024'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles('admin');

        // Create or update Student user
        $student = User::updateOrCreate(
            ['email' => 'student@uphsd.edu.ph'],
            [
                'name' => 'Sample Student',
                'password' => bcrypt('Student@2024'),
                'role' => 'student',
                'student_id' => 'UPH-2024-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $student->syncRoles('student');
    }
}
