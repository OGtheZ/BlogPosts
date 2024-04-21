<?php

namespace App\Http\Requests;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(User $user, BlogPost $post): bool
    {
        if($user->id === $post->author_id) {
            return true;
        };
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->post;
        return [
            'title' => ['required', 'max:255', "unique:blog_posts,title,$post->id"],
            'body' => ['required']
        ];
    }
}
