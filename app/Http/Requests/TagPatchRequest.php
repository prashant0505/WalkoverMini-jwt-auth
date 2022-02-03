<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagPatchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
            'user_id' => 'exists:users,id',
        ];
    }
}
