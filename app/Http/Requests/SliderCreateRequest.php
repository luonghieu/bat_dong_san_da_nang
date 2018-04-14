<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderCreateRequest extends FormRequest
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
            'description' => 'required|min:3|max:255',
            'link' => 'required|max:255',
            'image' => 'nullable|image|max: 1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Title is required.',
            'name.max' => 'Title not greater than 255 character.',
            'description.required' => 'Desribe is required.',
            'description.min' => 'Desribe not less than 3 character.',
            'description.max' => 'Desribe not grater than 255 character.',
            'link.required' => 'Link is required.',
            'link.min' => 'Link not greater than 255 character.',
            'image.image' => 'Image must in png, jpg, jpeg.',
            'image.max' => 'Image not greater than 1000kb.',
        ];
    }
}
