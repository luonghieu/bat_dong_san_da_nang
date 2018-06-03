<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\UnitPrice;

class ApartmentCreateRequest extends FormRequest
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
        $unitPrice = UnitPrice::pluck('id')->toArray();
        return [
            'position' => 'required|max:50',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'unit_price_id' => ['required', Rule::in($unitPrice)] ,
            'description' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'position.required' => 'Position is required.',
            'position.max' => 'Position is not greater than 50 character.',
            'area.required' => 'Area is required.',
            'area.numeric' => 'Area must be number.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be number.',
            'description.max' => 'Description is not greater than 255 character.',
            'unit_price_id.required' => 'UnitPrice is required.',
            'unit_price_id.in'  => 'UnitPrice not exist.',
        ];
    }
}
