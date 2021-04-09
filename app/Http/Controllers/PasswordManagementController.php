<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateNewPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Password;
use Faker\Generator as FakerGenerator;

class PasswordManagementController extends Controller
{
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        // get list passwords
        $passwords = Password::all();

        return view('passwords.index', compact('passwords'));
    }

    public function show(Password $password): \Illuminate\Contracts\Support\Renderable
    {
        $password->load(
            relations: [
                'passwordHistories'
            ]
        );

        return view('passwords.show', compact('password'));
    }

    public function create(): \Illuminate\Contracts\Support\Renderable
    {
        return view('passwords.create');
    }

    public function store(CreateNewPasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $postData = $request->validated();
        $password = Password::create($postData);
        return redirect()->route('password.index');
    }

    public function update(Password $password, UpdatePasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $postData = $request->validated();
        $hasNewPassword = (
            !empty($postData['password']) // not empty
            && $postData['password'] != $password->rawPassword // not same with the old password
        );

        // update normal detail
        $password->label = $postData['label'];
        $password->description = $postData['description'] ?? '';

        if ($hasNewPassword) {
            // save old password
            $password->putCurrentPasswordAsHistory();

            // save new password
            $password->password = $postData['password'];
        }

        $password->save();

        // back to the detail page
        return redirect()->route('password.show', [$password]);
    }

    public function randomPassword(FakerGenerator $generator): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'password' => $generator->password(8, 15)
        ]);
    }
}
