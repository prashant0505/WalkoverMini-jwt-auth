<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTagRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->post->user_id;
        return(auth()->user()->id == $user);
    }

    public function rules()
    {
        return [
            'tag_id' => 'required|exists:tags,id',
        ];
    }
}
