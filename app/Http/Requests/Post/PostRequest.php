<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->user->id;
        return (auth()->user()->id == $compare);
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
