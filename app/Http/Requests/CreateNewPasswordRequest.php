<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewPasswordRequest extends FormRequest
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
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'label.required' => __('Label is required so you can know what password is it'),
            'password.required' => __('Please input your password or generate new one'),
            'password.min' => __('Your Password looks too weak, let increase it at least :min characters'),
        ];
    }
}
