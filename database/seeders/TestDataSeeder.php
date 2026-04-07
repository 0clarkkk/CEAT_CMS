<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\FacultyMember;
use App\Models\NewsEvent;
use App\Models\Program;
use App\Models\ResearchCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 additional departments with related data
        Department::factory(5)
            ->has(
                Program::factory(3)
                    ->has(Course::factory(8))
                    ->state(['is_active' => true])
            )
            ->has(FacultyMember::factory(5))
            ->has(ResearchCenter::factory(2))
            ->has(NewsEvent::factory(4))
            ->create();

        // Generate additional courses, faculty, and news/events
        Program::all()->each(function (Program $program) {
            // Ensure each program has some courses
            if ($program->courses()->count() < 5) {
                Course::factory(rand(3, 5))->for($program)->create();
            }
        });

        // Create additional news and events
        NewsEvent::factory(10)->create();

        $this->command->info('Test data generated successfully!');
    }
}
