<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class ShowCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        dd($this->user->company_id);
        // return (auth()->user()->company_id == $this->user->company_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }
}
