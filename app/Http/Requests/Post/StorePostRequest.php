<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->user->id);
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:100',
            'body' => 'required|string|',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
