<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsEvent>
 */
class NewsEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $type = $this->faker->randomElement(['news', 'event', 'announcement']);

        return [
            'department_id' => Department::factory(),
            'title' => $title,
            'slug' => str($title)->slug(),
            'type' => $type,
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'featured_image' => $this->faker->imageUrl(800, 400),
            'published_at' => $type === 'event' ? null : $this->faker->dateTimeThisMonth(),
            'event_date' => $type === 'event' ? $this->faker->dateTimeBetween('+1 week', '+1 month') : null,
            'location' => $type === 'event' ? $this->faker->address() : null,
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
