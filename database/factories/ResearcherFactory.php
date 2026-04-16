<?php

namespace Database\Factories;

use App\Models\Researcher;
use App\Models\ResearchCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Researcher>
 */
class ResearcherFactory extends Factory
{
    protected $model = Researcher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = [
            'Artificial Intelligence',
            'Machine Learning',
            'Software Engineering',
            'Data Science',
            'Cybersecurity',
            'Computer Networks',
            'Database Systems',
            'Cloud Computing',
            'Embedded Systems',
            'Computer Vision',
            'Natural Language Processing',
            'Robotics',
        ];

        $researchInterests = [
            'Algorithm Development',
            'Data Analysis',
            'System Design',
            'Performance Optimization',
            'Security Research',
            'Innovation',
            'Pattern Recognition',
            'Statistical Modeling',
            'Hardware Integration',
            'User Experience',
        ];

        return [
            'research_center_id' => ResearchCenter::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'bio' => $this->faker->paragraph(3),
            'photo' => null,
            'specialization' => $this->faker->randomElement($specializations),
            'affiliation' => $this->faker->company(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'research_interests' => $this->faker->randomElements($researchInterests, $this->faker->numberBetween(2, 4)),
            'order' => $this->faker->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
