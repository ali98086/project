<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
                'subject' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'body' => 'required|max:1000|min:5',
                'published_at' => 'required|numeric',
            ];
        } else {

            return [
                'subject' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'body' => 'required|max:1000|min:5',
                'published_at' => 'required|numeric',
            ];
        }
    }
}
