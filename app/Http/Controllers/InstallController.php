<?php


namespace App\Http\Controllers;


use App\Http\Requests\InstallRequest;
use App\Models\MasterSetting;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{

    /**
     * Install the application
     * @param InstallRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(InstallRequest $request): \Illuminate\Http\RedirectResponse
    {
        $postData = $request->validated();

        // install master password
        MasterSetting::create([
            'key' => MasterSetting::KEY_PASSWORD,
            'value' => Hash::make($postData['master_password'])
        ]);

        // install backup password
        MasterSetting::create([
            'key' => MasterSetting::KEY_BACKUP_PASSWORD,
            'value' => Hash::make($postData['backup_password'])
        ]);

        // after the installation, back to login
        return redirect()->route('login')
            ->with('success', __('The installation was success! Please login to test.'));
    }
}
