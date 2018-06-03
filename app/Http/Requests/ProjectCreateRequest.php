<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\District;
use App\Models\Village;
use App\Models\Street;

class ProjectCreateRequest extends FormRequest
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
        $districts = District::all(['id'])->pluck('id')->toArray();
        $villages = Village::all(['id'])->pluck('id')->toArray();
        $streets = Street::all(['id'])->pluck('id')->toArray();

        return [
            'name' => 'required|min:3',
            'image' => 'nullable|image',
            'introduce' => 'required',
            'overview' => 'required',
            'position' => 'required',
            'utilities' => 'required',
            'progress' => 'required',
            'price_payment' => 'required',
            'district_id' => ['required', Rule::in($districts)],
            'village_id' => ['required', Rule::in($villages)],
            'street_id' => ['required', Rule::in($streets)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name is not less than 3 character.',
            'image.required' => 'Image is required.',
            'image.image' => 'Image must in png, jpg, jpeg.',
            'introduce.required' => 'Introduce is required.',
            'overview.required' => 'Overview is required.',
            'position.required' => 'Position is required.',
            'utilities.required' => 'Utilities is required.',
            'progress.required' => 'Progress is required.',
            'price_payment.required' => 'Price and Payment is required.',
            'district_id.required' => 'District is required.',
            'district_id.in'  => 'District not exist.',
            'village_id.required' => 'Village is required.',
            'village_id.in'  => 'Village not exist.',
            'street_id.required' => 'Street is required.',
            'street_id.in'  => 'Street not exist.',
        ];
    }
}
