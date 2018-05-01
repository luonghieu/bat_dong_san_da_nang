<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\District;

class PostCreateRequest extends FormRequest
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
        $list = Category::all(['id'])->pluck('id')->toArray();
        $district = District::all(['id'])->pluck('id')->toArray();
        return [
            'name' => 'required|max:255',
            'fullname' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required|min:30',
            'cat_id' => ['required', Rule::in($list)], 
            'district_id' => ['required', Rule::in($district)] ,
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'fullname.required' => 'Fullname is required.',
            'phone.required' => 'Phone is required.',
            'email.required' => 'Email is required.',
            'name.max' => 'Name is less than 255 character.',
            'name.max' => 'Fullname is less than 255 character.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description is greater than 30 character.',
            'area.required' => 'Area is required.',
            'area.numeric' => 'Area must be number.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be number.',
            'cat_id.required' => 'Category is required.',
            'cat_id.in'  => 'Category not exist.',
            'district_id.required' => 'District is required.',
            'district_id.in'  => 'District not exist.',
            'start_time.required' => 'Start time is required.',
            'start_time.date'  => 'Start time must be date.',
            'end_time.required' => 'End time is required.',
            'end_time.date'  => 'End time must be date.',
        ];
    }
}
