<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [];
        $posts = [];

        for($i = 1; $i <4; $i++) {
            $user = User::factory()->create([
                'name' => 'Test User'.$i,
                'email' => 'test'.$i.'@example.com',
            ]);
            $users []= $user;
        }

        foreach ($users as $user) {
            $category = BlogCategory::factory()->create();

            for($i = 0; $i < 3; $i++) {
                $post = BlogPost::factory()->create([
                    'title' => fake()->sentence,
                    'body' => fake()->paragraph,
                    'author_id' => $user->id
                ]);
                $posts []= $post;

                $post->blogCategories()->attach($category->id);
            }
        }

        foreach ($posts as $post) {
            foreach ($users as $user)
            {
                BlogComment::factory()->create([
                    'author_id' => $user->id,
                    'blog_post_id' => $post->id
                ]);
            }
        }

    }
}
