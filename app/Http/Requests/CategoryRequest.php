<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->user->id;
        return (auth()->user()->id == $compare);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
        ];
    }
}
