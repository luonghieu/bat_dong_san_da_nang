<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IntroduceCreateRequest extends FormRequest
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
            'description' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Title is required.',
            'name.max' => 'Title not greater than 255 character.',
            'description.required' => 'Desribe is required.',
            'description.min' => 'Desribe not less than 3 character.',
        ];
    }
}
