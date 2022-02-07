<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->user->id);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
        ];
    }
}
