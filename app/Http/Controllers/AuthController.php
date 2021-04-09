<?php


namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Models\MasterSetting;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        if (!MasterSetting::isApplicationReady()){
            return view('install');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $postData = $request->validated();
        $password = $postData['password'];

        $currentSystemPassword = MasterSetting::byKey(MasterSetting::KEY_PASSWORD)->first();
        if (!Hash::check($password, $currentSystemPassword->value)) {
            return redirect()->back()
                ->with('error', __('Wrong password! Please try again.'));
        }

        // set session
        $request->session()->put('login-hash', $password);

        return redirect()->route('password.index');
    }
}
