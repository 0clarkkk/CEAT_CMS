<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\FacultyMember;
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

        // Create or update Faculty user with Advisor capabilities
        $faculty = FacultyMember::updateOrCreate(
            ['email' => 'faculty@uphsd.edu.ph'],
            [
                'first_name' => 'Dr. Juan',
                'last_name' => 'Dela Cruz',
                'position' => 'Associate Professor',
                'specialization' => 'Software Engineering',
                'biography' => 'An experienced faculty member with 15+ years of industry experience in software development and consulting.',
                'is_active' => true,
                'is_advisor' => true,
                'consultation_info' => 'I offer guidance on:
- Software architecture and design patterns
- Web application development
- Database design and optimization
- Career development and internship preparation
- Technical mentoring for thesis projects

I have extensive industry experience and enjoy helping students bridge the gap between academic learning and real-world applications. My consultations are focused on practical problem-solving and skill development.',
                'office_location' => 'Engineering Building, Room 305',
                'office_hours' => 'Monday & Wednesday: 2:00 PM - 5:00 PM, Friday: 10:00 AM - 12:00 PM',
                'phone_number' => '+63 (2) 8123-4567',
                'department_id' => 1, // Assuming first department exists
            ]
        );

        // Create corresponding user account for faculty
        $facultyUser = User::updateOrCreate(
            ['email' => 'faculty@uphsd.edu.ph'],
            [
                'name' => 'Dr. Juan Dela Cruz',
                'password' => bcrypt('Faculty@2024'),
                'role' => 'faculty',
                'is_active' => true,
                'email_verified_at' => now(),
                'faculty_member_id' => $faculty->id,
            ]
        );
        $facultyUser->syncRoles('faculty');
    }
}
