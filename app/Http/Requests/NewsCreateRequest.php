<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CatNew;

class NewsCreateRequest extends FormRequest
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
        $list = CatNew::all(['id'])->pluck('id')->toArray();
        return [
            'name' => 'required|max:255',
            'feature' => 'required|min:3|max:255',
            'detail' => 'required|min:6',
            'link' => 'required|max:255',
            'cat_new_id' => ['required', Rule::in($list)],
            'image' => 'nullable|image|max: 1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Title is required.',
            'name.max' => 'Title not greater than 255 character.',
            'feature.required' => 'Desribe is required.',
            'feature.min' => 'Desribe not less than 3 character.',
            'feature.max' => 'Desribe not grater than 255 character.',
            'detail.required' => 'Detail is required.',
            'detail.min' => 'Detail not less than 6 character.',
            'link.required' => 'Link is required.',
            'link.min' => 'Link not greater than 255 character.',
            'cat_new_id.required' => 'Category is required.',
            'cat_new_id.in'  => 'Category not exist.',
            'image.image' => 'Image must in png, jpg, jpeg.',
            'image.max' => 'Image not greater than 1000kb.',
        ];
    }
}
