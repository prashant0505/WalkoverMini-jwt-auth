<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return (auth()->user()->id == $this->company->users()->first()->id);
    }

    public function rules()
    {
        return [
            'name' => 'string|min:2|max:100',
            'location' => 'string|min:3',
            'company_id' => 'exists:companies,id'
        ];
    }
}
