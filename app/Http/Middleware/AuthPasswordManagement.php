<?php

namespace App\Http\Middleware;

use App\Models\MasterSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthPasswordManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $loginHash = $request->session()->get('login-hash');
        $currentSystemPassword = MasterSetting::byKey(MasterSetting::KEY_PASSWORD)->first();

        if (
            // if not logged in
            empty($loginHash)

            // or not configured password
            || empty($currentSystemPassword)

            // or wrong password
            || !Hash::check($loginHash, $currentSystemPassword->value)
        ) {
            $request->session()->remove('login-hash');
            return redirect()->route('login');
        }


        return $next($request);
    }
}
