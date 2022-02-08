<?php

namespace App\Http\Requests\PostTag;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'tag_id' => 'required|exists:tags,id',
        ];
    }
}
