<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
                'question'=>'required|min:3|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;&?؟ ]+$/u',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟]+$/u',
                'status'=> 'required|numeric|in:0,1',
                'answer'=>'required|min:3|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟]+$/u',
            ];
        } else {
            
            return [
                'question'=>'required|min:3|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;&?؟ ]+$/u',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟]+$/u',
                'status'=> 'required|numeric|in:0,1',
                'answer'=>'required|min:3|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟]+$/u',
            ];

        }
    }
}
