<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->isMethod("POST")){

            return [

                'title'=>'required|min:3|max:120',
                'category_id'=> 'required|min:1|max:100000|numeric|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image'=> 'required|image|mimes:png,jpg,jpeg,gif',
                'tags'=> 'required',
                'status'=> 'required|numeric|in:0,1',
                'published_at'=> 'required|numeric',
                'summary'=>'required|min:2|max:300',
                'body'=> 'required|min:2|max:600',

            ];

        }
        else{

            return [
                
                'title'=>'required|min:3|max:120',
                'category_id'=> 'required|min:1|max:100000|numeric|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image'=> 'image|mimes:png,jpg,jpeg,gif',
                'tags'=> 'required',
                'status'=> 'required|numeric|in:0,1',
                'published_at'=> 'required|numeric',
                'summary'=>'required|min:2|max:300',
                'body'=> 'required|min:2|max:600',

            ];

    }
    }
}
