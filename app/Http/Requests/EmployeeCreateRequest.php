<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\District;
use Illuminate\Validation\Rule;

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
        $district = District::all(['id'])->pluck('id')->toArray();

        return [
            'name' => 'required|min:3|max:20',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'gender' => ['required', Rule::in(['0', '1'])],
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
        ];
    }
}
