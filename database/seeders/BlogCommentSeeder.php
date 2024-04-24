<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = BlogPost::all();

        foreach ($posts as $post) {
            foreach ($users as $user) {
                BlogComment::factory()->count(1)->create(['author_id' => $user->id, 'blog_post_id' => $post->id]);
            }
        }
    }
}
