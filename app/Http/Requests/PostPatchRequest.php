<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPatchRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->user->id;
        return (auth()->user()->id == $compare);
    }


    public function rules()
    {
        return [
            'title' => 'string|min:2|max:100',
            'body' => 'string',
            'user_id' => 'exists:users,id',
            'category_id' => 'exists:categories,id'
        ];
    }
}
