<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->tag->user_id);
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
        ];
    }
}
