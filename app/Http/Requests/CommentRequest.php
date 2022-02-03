<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                    'body' => 'required|string|min:2|max:100',
                   // 'user_id' => 'required|exists:users,id',
                    'post_id' => 'required|exists:posts,id'
                ];
            
            
    }
}
