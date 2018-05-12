<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'gender' => ['required', Rule::in(['0', '1'])], 
            'image' => 'nullable|image|max: 1000',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name is not less than 3 character',
            'name.max' => 'Name is not greater than 20 character',
            'address.required' => 'Address is required.',
            'address.min' => 'Address is not less than 3 character',
            'address.max' => 'Address is not greater than 255 character',
            'Phone.required' => 'Phone is required.',
            'Phone.numeric' => 'Phone must be number.',
            'gender.required' => 'Gender is required.',
            'image.image' => 'Image must in png, jpg, jpeg.',
            'image.max' => 'Image not greater than 1000kb.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid',
            'password.min' => 'Password is not less than 6 character.',
        ];
    }
}
