<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'introduce' => 'required',
            'overview' => 'required',
            'position' => 'required',
            'utilities' => 'required',
            'progress' => 'required',
            'price_payment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'introduce.required' => 'Introduce is required.',
            'overview.required' => 'Overview is required.',
            'position.required' => 'Position is required.',
            'utilities.required' => 'Utilities is required.',
            'progress.required' => 'Progress is required.',
            'price_payment.required' => 'Price and Payment is required.',
        ];
    }
}
