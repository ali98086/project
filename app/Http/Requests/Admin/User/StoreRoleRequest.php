<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
        return [
            
            'name' => 'required|max:120|min:1',
            'description' => 'required|max:200|min:1',
            'permissions.*' => 'exists:permissions,id'

        ];
    }


    public function attributes()
    {
        return [
            'name' => 'نام نقش',
            'description' => 'توضیح نقش',
            'permissions.*' => 'دسترسی'
        ];
    }
}
