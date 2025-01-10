<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->firstInstall()->create();
        User::factory(5)->create();
        Page::factory(50)->create();
        Post::factory(50)->create();
        Comment::factory(200)->create();

        return;
    }
}
