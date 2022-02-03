<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tag_id' => 'required|exists:tags,id',
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
