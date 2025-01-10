<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'status' => fake()->randomElement( [ 'published', 'draft', 'pending' ] ),
            'comments_on' => fake()->boolean(),
            'comment_count' => 0,
        ];
    }
}
