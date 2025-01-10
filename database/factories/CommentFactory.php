<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'url' => fake()->url(),
            'avatar' => '',
            'body' => fake()->paragraph(3),
            'status' => fake()->randomElement( [ 'published', 'pending', 'spam' ] ),
            'post_id' => Post::all()->random()->id,
            'ip' => fake()->ipv4(),
            'ua' => fake()->userAgent(),
        ];
    }
}
