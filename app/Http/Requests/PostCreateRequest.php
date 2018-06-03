<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\Village;
use App\Models\Street;
use App\Models\District;
use App\Models\UnitPrice;

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
        $list = Category::pluck('id')->toArray();
        $districts = District::all(['id'])->pluck('id')->toArray();
        $villages = Village::all(['id'])->pluck('id')->toArray();
        $streets = Street::all(['id'])->pluck('id')->toArray();
        $unitPrice = UnitPrice::pluck('id')->toArray();
        return [
            'name' => 'required|max:255',
            'fullname' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required|min:30',
            'cat_id' => ['required', Rule::in($list)], 
            'district_id' => ['required', Rule::in($districts)],
            'village_id' => ['required', Rule::in($villages)],
            'street_id' => ['required', Rule::in($streets)],
            'unit_price_id' => ['required', Rule::in($unitPrice)] ,
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max: 1000',
            'start_time' => 'required|date|after:today',
            'end_time' => 'required|date|after:start_time',
            'project' => 'nullable|max:255',
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
            'village_id.required' => 'Village is required.',
            'village_id.in'  => 'Village not exist.',
            'street_id.required' => 'Street is required.',
            'street_id.in'  => 'Street not exist.',
            'unit_price_id.required' => 'UnitPrice is required.',
            'unit_price_id.in'  => 'UnitPrice not exist.',
            'image.image' => 'Image must in png, jpg, jpeg.',
            'image.max' => 'Image not greater than 1000kb.',
            'start_time.required' => 'Start time is required.',
            'start_time.after' => 'Start time is must after today.',
            'start_time.date'  => 'Start time must be date.',
            'end_time.required' => 'End time is required.',
            'end_time.date'  => 'End time must be date.',
            'end_time.after'  => 'End time must be after start time.',
            'project.max' => 'Project is less than 255 character.',
        ];
    }
}
