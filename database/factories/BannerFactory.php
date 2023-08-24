<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $section = Section::inRandomOrder()->first();
        return [
            'section_id' => $section->id,
            'heading' => fake()->sentence(2),
            'sub_heading' => fake()->sentence(5),
            'status' => Banner::STT_ENABLE
        ];
    }
}
