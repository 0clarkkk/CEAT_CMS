<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Consultation;
use App\Models\AdvisorAvailabilitySlot;
use App\Models\FacultyMember;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConsultationTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a department for faculty members
        $department = Department::first() ?? Department::create([
            'name' => 'Computer Science & Engineering',
            'slug' => 'cse',
            'description' => 'Department of Computer Science & Engineering',
        ]);

        // Create test advisors as faculty with advisor capability
        $advisor1User = User::firstOrCreate(
            ['email' => 'advisor1@ceat.edu'],
            [
                'name' => 'Dr. Ahmed Hassan',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'role' => 'faculty',
            ]
        );

        // Create FacultyMember record for advisor1
        $advisor1 = FacultyMember::firstOrCreate(
            ['user_id' => $advisor1User->id],
            [
                'email' => 'advisor1@ceat.edu',
                'first_name' => 'Ahmed',
                'last_name' => 'Hassan',
                'position' => 'Associate Professor',
                'specialization' => 'Database Systems',
                'is_active' => true,
                'is_advisor' => true,
                'office_location' => 'Office 101',
                'office_hours' => 'Monday to Friday: 9:00 AM - 5:00 PM',
                'phone_number' => '+1-555-0101',
                'department_id' => $department->id,
            ]
        );
        // Update user's faculty_member_id if needed
        if (!$advisor1User->faculty_member_id) {
            $advisor1User->update(['faculty_member_id' => $advisor1->id]);
        }

        $advisor2User = User::firstOrCreate(
            ['email' => 'advisor2@ceat.edu'],
            [
                'name' => 'Prof. Fatima Khan',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'role' => 'faculty',
            ]
        );

        // Create FacultyMember record for advisor2
        $advisor2 = FacultyMember::firstOrCreate(
            ['user_id' => $advisor2User->id],
            [
                'email' => 'advisor2@ceat.edu',
                'first_name' => 'Fatima',
                'last_name' => 'Khan',
                'position' => 'Professor',
                'specialization' => 'Software Engineering',
                'is_active' => true,
                'is_advisor' => true,
                'office_location' => 'Office 202',
                'office_hours' => 'Monday, Wednesday, Friday: 10:00 AM - 4:00 PM',
                'phone_number' => '+1-555-0202',
                'department_id' => $department->id,
            ]
        );
        // Update user's faculty_member_id if needed
        if (!$advisor2User->faculty_member_id) {
            $advisor2User->update(['faculty_member_id' => $advisor2->id]);
        }

        // Create test students
        $student1 = User::firstOrCreate(
            ['email' => 'student1@ceat.edu'],
            [
                'name' => 'Ali Mohammed',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'role' => 'student',
                'student_id' => 'ST001',
            ]
        );

        $student2 = User::firstOrCreate(
            ['email' => 'student2@ceat.edu'],
            [
                'name' => 'Hana Ali',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'role' => 'student',
                'student_id' => 'ST002',
            ]
        );

        // Set availability for advisors
        // Dr. Ahmed Hassan - Monday to Friday, 9 AM to 5 PM
        $now = Carbon::now();
        for ($day = 0; $day < 5; $day++) { // Next 5 weekdays
            $date = $now->clone()->addDays($day + 1);
            // Skip weekends
            if ($date->isWeekend()) {
                $date = $date->addDays(2);
            }
            AdvisorAvailabilitySlot::firstOrCreate(
                [
                    'advisor_id' => $advisor1->id,
                    'start_time' => $date->clone()->setTime(9, 0),
                    'end_time' => $date->clone()->setTime(17, 0),
                ],
                [
                    'status' => 'available',
                    'location' => 'Office 101',
                ]
            );
        }

        // Prof. Fatima Khan - Monday, Wednesday, Friday, 10 AM to 4 PM
        for ($day = 0; $day < 10; $day++) {
            $date = $now->clone()->addDays($day + 1);
            if ($date->dayOfWeek == 1 || $date->dayOfWeek == 3 || $date->dayOfWeek == 5) { // Mon, Wed, Fri
                AdvisorAvailabilitySlot::firstOrCreate(
                    [
                        'advisor_id' => $advisor2->id,
                        'start_time' => $date->clone()->setTime(10, 0),
                        'end_time' => $date->clone()->setTime(16, 0),
                    ],
                    [
                        'status' => 'available',
                        'location' => 'Office 202',
                    ]
                );
            }
        }

        // Create sample consultations for testing

        // 1. Pending consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student1->id,
                'advisor_id' => $advisor1->id,
                'title' => 'Course Selection Help',
            ],
            [
                'description' => 'Need help choosing electives for next semester',
                'category' => 'academic',
                'status' => 'pending',
                'location' => 'Office 101',
            ]
        );

        // 2. Approved consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student2->id,
                'advisor_id' => $advisor2->id,
                'title' => 'Career Guidance',
            ],
            [
                'description' => 'Want to discuss internship opportunities',
                'category' => 'career',
                'status' => 'approved',
                'scheduled_at' => Carbon::now()->next(Carbon::MONDAY)->setTime(10, 0),
                'location' => 'Office 201',
            ]
        );

        // 3. Scheduled consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student1->id,
                'advisor_id' => $advisor1->id,
                'title' => 'Thesis Discussion',
            ],
            [
                'description' => 'Discuss thesis proposal and timeline',
                'category' => 'thesis',
                'status' => 'scheduled',
                'scheduled_at' => Carbon::tomorrow()->setTime(14, 0),
                'location' => 'Room 305',
            ]
        );

        // 4. Completed consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student2->id,
                'advisor_id' => $advisor1->id,
                'title' => 'Technical Issue Resolution',
            ],
            [
                'description' => 'Problem with lab software installation',
                'category' => 'technical',
                'status' => 'completed',
                'scheduled_at' => Carbon::yesterday()->setTime(11, 0),
                'location' => 'Lab 101',
            ]
        );

        // 5. Rejected consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student1->id,
                'advisor_id' => $advisor2->id,
                'title' => 'Personal Counseling',
            ],
            [
                'description' => 'Need to discuss academic stress',
                'category' => 'personal',
                'status' => 'rejected',
                'location' => 'Office 202',
                'rejection_reason' => 'Please contact student counseling center for personal matters',
                'rejected_at' => Carbon::now()->subDays(2),
                'rejected_by' => $advisor2->id,
            ]
        );

        // 6. Cancelled consultation
        Consultation::firstOrCreate(
            [
                'student_id' => $student2->id,
                'advisor_id' => $advisor1->id,
                'title' => 'Schedule Review',
            ],
            [
                'description' => 'Review course schedule',
                'category' => 'academic',
                'status' => 'cancelled',
                'location' => 'Office 101',
            ]
        );

        $this->command->info('✅ Consultation test data seeded successfully!');
        $this->command->info('');
        $this->command->info('📝 Test Accounts:');
        $this->command->info('─────────────────────────────────────────');
        $this->command->info('ADVISORS:');
        $this->command->info('  Email: advisor1@ceat.edu | Password: password123');
        $this->command->info('  Name:  Dr. Ahmed Hassan');
        $this->command->info('');
        $this->command->info('  Email: advisor2@ceat.edu | Password: password123');
        $this->command->info('  Name:  Prof. Fatima Khan');
        $this->command->info('');
        $this->command->info('STUDENTS:');
        $this->command->info('  Email: student1@ceat.edu | Password: password123');
        $this->command->info('  Name:  Ali Mohammed (ID: ST001)');
        $this->command->info('');
        $this->command->info('  Email: student2@ceat.edu | Password: password123');
        $this->command->info('  Name:  Hana Ali (ID: ST002)');
        $this->command->info('─────────────────────────────────────────');
    }
}
