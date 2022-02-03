<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentPatchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'string|min:2|max:100',
            'user_id' => 'exists:users,id',
            'post_id' => 'exists:posts,id'
        ];
    }
}
