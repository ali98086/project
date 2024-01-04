<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){

        return [

            'name'=>'required|min:3',
            'tags'=>'required',
            'status'=> 'required|numeric|in:0,1',
            'image'=>'required',
            'description'=>'required|min:3',
            'slug'=>'nullable'

        ];

    }
    else{

        return [

            'name'=>'required|min:3',
            'tags'=>'required',
            'status'=> 'required|numeric|in:0,1',
            'image'=>'',
            'description'=>'required|min:3',
            'slug'=>'nullable'

        ];


    }
    }
}
