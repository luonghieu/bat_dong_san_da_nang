<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationCreateRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'recurring_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'content.required' => 'Content is required.',
            'type.required' => 'Type is required.',
            'recurring_type.required' => 'Recurring is required.',
        ];
    }
}
