<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'body' => fake()->paragraph(5),
            'published_at' => fake()->dateTimeThisDecade(),
            'status' => 'published',
        ];
    }
}
