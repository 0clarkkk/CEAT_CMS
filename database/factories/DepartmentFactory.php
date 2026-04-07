<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'code' => strtoupper($this->faker->unique()->bothify('??#')),
            'name' => 'Department of ' . $name,
            'slug' => str($name)->slug(),
            'description' => $this->faker->paragraph(),
            'building_name' => $this->faker->bothify('Building ##?'),
            'location' => $this->faker->bothify('Floor #, Room ###'),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'history' => $this->faker->paragraphs(3, true),
            'mission' => $this->faker->paragraph(),
            'vision' => $this->faker->paragraph(),
            'is_center_of_excellence' => $this->faker->boolean(30),
            'metadata' => [],
        ];
    }
}
