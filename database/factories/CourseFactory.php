<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::factory(),
            'code' => strtoupper($this->faker->bothify('???-###')),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'units' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'semester' => $this->faker->randomElement(['1st', '2nd', 'summer', 'all']),
            'year_level' => $this->faker->randomElement([1, 2, 3, 4]),
            'prerequisites' => $this->faker->optional(0.7)->bothify('???-###'),
        ];
    }
}
