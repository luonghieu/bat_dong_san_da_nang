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
            'district_id' => ['required', Rule::in($district)],
            'gender' => ['required', Rule::in(['0', '1'])],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống.',
            'name.max' => 'Tên tối da 255 kí tự',
        ];
    }
}
