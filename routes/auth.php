<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
Route::get('/auth/twitch', 'App\Http\Controllers\Auth\LoginController@redirectToTwitch');
Route::get('/auth/twitch/callback', 'App\Http\Controllers\Auth\LoginController@handleTwitchCallback');
Route::get('/users', [UserController::class, 'index']);
Route::put('/profile', [ProfileController::class, 'store'])
                ->name('changeprofile');
Route::put('/changepass', [ProfileController::class, 'editpass'])
                ->name('changepass');                
Route::get('/profile/getvideo', [ProfileController::class, 'getVideo'])
                ->name('getvideo');
Route::put('/profile/editvideo', [ProfileController::class, 'editVideo'])
                ->name('editvideo');
Route::get('/profile/refreshvideo', [ProfileController::class, 'refreshVideo'])
                ->name('refreshvideo');