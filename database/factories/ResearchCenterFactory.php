<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Researcher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResearchCenter>
 */
class ResearchCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(4, true);

        return [
            'department_id' => Department::factory(),
            'name' => $name . ' Research Center',
            'slug' => str($name)->slug(),
            'description' => $this->faker->paragraphs(3, true),
            'director' => $this->faker->name(),
            'research_areas' => [
                $this->faker->words(3, true),
                $this->faker->words(3, true),
                $this->faker->words(3, true),
            ],
            'facilities' => $this->faker->paragraph(),
            'contact_email' => $this->faker->unique()->safeEmail(),
        ];
    }

    /**
     * Create researchers after creating research center
     */
    public function configure(): static
    {
        return $this->afterCreating(function ($researchCenter) {
            Researcher::factory(rand(2, 4))->create([
                'research_center_id' => $researchCenter->id,
            ]);
        });
    }
}
