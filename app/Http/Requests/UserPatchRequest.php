<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPatchRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->company->id;
        return (auth()->user()->company_id == $compare);
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
            'email' => 'string|email|max:100',
            'password' => 'string|min:6',
            'salary' => 'integer|min:3',
        ];
    }
}
