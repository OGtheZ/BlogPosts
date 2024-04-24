<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = BlogCategory::all();

        foreach ($users as $user) {
            foreach ($categories as $category) {
                BlogPost::factory()->count(5)
                    ->hasAttached([$category])
                    ->create(['author_id' => $user->id]);
            }
        }
    }
}
