<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CatNew;

class EmployeeCreateRequest extends FormRequest
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
            'username' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
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
            'username.required' => 'Username is required.',
            'username.min' => 'Username is not less than 3 character',
            'username.max' => 'Username is not greater than 50 character',
            'username.unique' => 'Username is exist',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is exist',
            'password.required' => 'Password is required.',
            'password.min' => 'Password is not less than 6 character.',
        ];
    }
}
