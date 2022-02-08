<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        $post_company_id = Post::find(request('post_id'))->users->company_id;
        return (auth()->user()->id == $this->user->id && auth()->user()->company_id == $post_company_id);
    }

    public function rules()
    {
        return [
            'body' => 'required|string|min:2|max:100',
            'post_id' => 'required|exists:posts,id'
        ];
    }
}
