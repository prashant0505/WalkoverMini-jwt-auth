<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->company_id;
        return (auth()->user()->id == $compare);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'location' => 'required|string|min:3'
        ];
    }
}
