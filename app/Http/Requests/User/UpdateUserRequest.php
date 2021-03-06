<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->has('password')) {
            $this->merge(['password' => bcrypt($this->password)]);
        }
        return (auth()->user()->id == $this->company->users()->first()->id);
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
            'email' => 'string|email|max:100|unique:users',
            'password' => 'string|min:6',
            'salary' => 'integer|min:3',
        ];
    }

    public function validated()
    {
        if ($this->has('password')) {
            $this->merge(['password' => bcrypt($this->password)]);
        }
        return $this->all();
    }
}
