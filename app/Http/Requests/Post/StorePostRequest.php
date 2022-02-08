<?php

namespace App\Http\Requests\Post;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        $cat_company_id = Category::find(request('category_id'))->users->company_id;
        return (auth()->user()->id == $this->user->id && auth()->user()->company_id == $cat_company_id);
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:100',
            'body' => 'required|string|',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
