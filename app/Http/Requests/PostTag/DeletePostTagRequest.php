<?php

namespace App\Http\Requests\PostTag;

use Illuminate\Foundation\Http\FormRequest;

class DeletePostTagRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->post->user_id);
    }

    public function rules()
    {
        return [
            
        ];
    }
}
