<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $com =$this->company->id;
        return (auth()->user()->company_id == $com);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
            'email' => 'string|email|max:100',
            'password' => 'string|min:6',
            'salary'=> 'integer|min:3',
        ];
    }
}
