<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTagRequest extends FormRequest
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
        switch($this->method()){
            case 'Post' :
                return [
                    'post_id' => 'exists:posts,id',
                    'tag_id' => 'exists:tags,id'
                ];
            case 'Put' :
                return [
                    'name' => 'required|string|min:2|max:100',
                    'location'=>'required|string|min:3',
                    'company_id' => 'required|exists:companies,id'
                ];
        }  
    }
}
