<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPatchRequest extends FormRequest
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
            'location' => 'string|min:3',
            'company_id' => 'exists:companies,id'
        ];
    }
}
