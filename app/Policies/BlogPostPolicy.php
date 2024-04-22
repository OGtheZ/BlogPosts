<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blogPost): bool
    {
        if($user->id === $blogPost->author_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPost $blogPost): bool
    {
        if($user->id === $blogPost->author_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model for editing.
     */
    public function updateView(User $user, BlogPost $blogPost): bool
    {
        if($user->id === $blogPost->author_id) {
            return true;
        }
        return false;
    }
}
