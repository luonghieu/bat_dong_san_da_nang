<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends FormRequest
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
            'block' => 'required|max:50',
            'land' => 'required|max:50',
            'floor' => 'required|numeric',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'block.required' => 'Block is required.',
            'block.max' => 'Block is not greater than 50 character.',
            'land.required' => 'Land is required.',
            'land.max' => 'Land is not greater than 50 character.',
            'floor.required' => 'floor is required.',
            'floor.numeric' => 'Floor must be number.',
            'area.required' => 'Area is required.',
            'area.numeric' => 'Area must be number.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be number.',
            'description.required' => 'Description is required.',
            'description.max' => 'Description is not greater than 255 character.',
        ];
    }
}
