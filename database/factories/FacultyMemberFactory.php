<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacultyMember>
 */
class FacultyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->randomElement(['Professor', 'Associate Professor', 'Assistant Professor', 'Instructor', 'Lecturer']),
            'specialization' => $this->faker->words(3, true),
            'biography' => $this->faker->paragraphs(2, true),
            'photo' => $this->faker->imageUrl(300, 300, 'people'),
            'education' => [
                [
                    'degree' => 'PhD',
                    'field' => $this->faker->words(3, true),
                    'institution' => $this->faker->company(),
                    'year' => $this->faker->year(),
                ]
            ],
            'research_interests' => [
                $this->faker->words(3, true),
                $this->faker->words(3, true),
            ],
            'publications' => [
                [
                    'title' => $this->faker->sentence(),
                    'journal' => $this->faker->company(),
                    'year' => $this->faker->year(),
                ]
            ],
            'is_active' => true,
        ];
    }
}
