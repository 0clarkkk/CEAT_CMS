<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $degree = $this->faker->randomElement(['bs', 'ms', 'mengg', 'de', 'phd', 'diploma']);
        $name = $this->faker->words(4, true);
        $degreeLabel = match ($degree) {
            'bs' => 'Bachelor of Science',
            'ms' => 'Master of Science',
            'mengg' => 'Master in Engineering',
            'de' => 'Diploma in Engineering',
            'phd' => 'Doctor of Philosophy',
            'diploma' => 'Diploma',
        };

        return [
            'department_id' => Department::factory(),
            'name' => $degreeLabel . ' in ' . $name,
            'short_name' => strtoupper($this->faker->bothify('BS ?##')),
            'slug' => str($name)->slug(),
            'degree_level' => $degree,
            'duration_years' => $degree === 'phd' ? 5 : ($degree === 'ms' || $degree === 'mengg' ? 2 : 4),
            'description' => $this->faker->paragraphs(2, true),
            'objectives' => $this->faker->paragraphs(2, true),
            'career_opportunities' => $this->faker->paragraph(),
            'curriculum_structure' => [
                'core_courses' => $this->faker->randomDigitNotNull(),
                'electives' => $this->faker->randomDigitNotNull(),
                'thesis_capstone' => true,
            ],
            'is_active' => true,
        ];
    }
}
