<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->company->users()->first()->id);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'salary' => 'required|integer|min:3',
        ];
    }
}
