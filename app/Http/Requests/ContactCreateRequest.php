<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactCreateRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'content' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name not greater than 255 character.',
            'content.required' => 'Content is required.',
            'content.min' => 'Content not less than 3 character.',
            'content.max' => 'Content not grater than 255 character.',
            'email.required' => 'Link is required.',
            'email.email' => 'Email is not format.',
            'phone.required' => 'Phone is required.',
            'phone.numeric' => 'Phone must be number.',
        ];
    }
}
