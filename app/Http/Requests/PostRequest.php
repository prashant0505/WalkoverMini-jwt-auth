<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $com =$this->user->id;
        
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
            'title' => 'required|string|min:2|max:100',
            'body'=>'required|string|',
           // 'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ];
       
    }
}
