<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    InstallController,
    PasswordManagementController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/install', [InstallController::class, 'install'])->name('install');

Route::middleware(['auth.password.management'])->group(function() {
    Route::resource('password', PasswordManagementController::class);
    Route::get('random-password', [PasswordManagementController::class, 'randomPassword'])
        ->name('password-management.random-password');
});
