<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   $com = $this->route()->parameter('id');
        return (auth()->user()->id == $com);
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
            'location'=>'string|min:3',
            'company_id' => 'exists:companies,id'
        ];
    }
}
