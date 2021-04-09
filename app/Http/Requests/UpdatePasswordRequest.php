<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'label' => 'required',
            'description' => 'sometimes',
            'password' => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'label.required' => __('Label is required so you can know what password is it'),
        ];
    }
}
