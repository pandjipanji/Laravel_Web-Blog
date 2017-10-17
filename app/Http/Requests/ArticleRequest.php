<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|unique:articles,title|max:255',
            'content' => 'required|unique:articles,content|min:50',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required, at least fill a character',
            'title.unique' => 'Title must unique, take another title'
        ];
    }
}
