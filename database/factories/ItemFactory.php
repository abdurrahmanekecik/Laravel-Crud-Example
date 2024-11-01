<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'category_id' => rand(1, 5),
            'slug' => $this->faker->unique()->slug,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text,
            'status' => 1,
        ];
    }
}
