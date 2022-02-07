<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
