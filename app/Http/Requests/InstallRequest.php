<?php

namespace App\Http\Requests;

use App\Models\MasterSetting;
use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !MasterSetting::isApplicationReady();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'master_password' => 'required|string|same:retype_master_password',
            'retype_master_password' => 'required|string',
            'backup_password' => 'required|string|same:retype_backup_password',
            'retype_backup_password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'master_password.required' => __('Please input the Master Password'),
            'master_password.same' => __('Master Password must be the same as the Retype Master Password'),
            'retype_master_password.required' => __('Please input the Retype Master Password'),

            'backup_password.required' => __('Please input the Backup Password'),
            'backup_password.same' => __('Master Password must be the same as the Retype Backup Password'),
            'retype_backup_password.required' => __('Please input the Retype Backup Password'),
        ];
    }
}
