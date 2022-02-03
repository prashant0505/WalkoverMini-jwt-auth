<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
            return [
                'Name' => 'required|string|min:2|max:100',
                'user_id' => 'required|exists:Users,id',
            ];
            case 'PUT':
                return [
                    'Name' => 'required|string|min:2|max:100',
                    'user_id' => 'required|exists:Users,id',
                   ];    
            }
    }
}
