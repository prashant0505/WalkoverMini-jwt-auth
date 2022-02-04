<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTagDeleteRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->post->user_id;
        return(auth()->user()->id == $user);
    }

    public function rules()
    {
        return [
            
        ];
    }
}
