<?php

namespace App\Policies;

use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogCommentPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogComment $blogComment): bool
    {
        if($user->id === $blogComment->author_id) {
            return true;
        }
        return false;
    }
}
