<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projecttype = ProjectType::inRandomOrder()->first();
        return [
            'project_type_id' => $projecttype->id,
            'title' => fake()->sentence(5),
            'description' => fake()->sentence(10),
            'status' => Project::STT_ENABLE
        ];
    }
}