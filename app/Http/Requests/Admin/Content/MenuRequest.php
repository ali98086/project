<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name'=>'required|min:3|max:120',
                'parent_id'=>'nullable|regex:/^[0-9]+$/u|exists:menus,id',
                'url'=>'required|min:3|max:100000000|url:http,https',
                'status'=> 'required|numeric|in:0,1',
                
            ];
        } else {
            
            return [
                'name'=>'required|min:3|max:120',
                'parent_id'=>'nullable|regex:/^[0-9]+$/u|exists:menus,id',
                'url'=>'required|min:3|max:100000000|url:http,https',
                'status'=> 'required|numeric|in:0,1',
                
            ];

        }
    }
    
}
