<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentPatchRequest extends FormRequest
{
    public function authorize()
    {
        $compare = $this->company->id;
        return (auth()->user()->company_id == $compare);
    }

    public function rules()
    {
        return [
            'body' => 'string|min:2|max:100',
            'post_id' => 'exists:posts,id'
        ];
    }
}
