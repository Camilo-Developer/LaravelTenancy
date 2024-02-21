<?php

use App\Http\Controllers\App\Auth\AuthenticatedSessionController;
use App\Http\Controllers\App\Auth\ConfirmablePasswordController;
use App\Http\Controllers\App\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\App\Auth\EmailVerificationPromptController;
use App\Http\Controllers\App\Auth\NewPasswordController;
use App\Http\Controllers\App\Auth\PasswordController;
use App\Http\Controllers\App\Auth\PasswordResetLinkController;
use App\Http\Controllers\App\Auth\RegisteredUserController;
use App\Http\Controllers\App\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('app/register', [RegisteredUserController::class, 'create'])
                ->name('app.register');

    Route::post('app/register', [RegisteredUserController::class, 'store']);

    Route::get('app/login', [AuthenticatedSessionController::class, 'create'])
                ->name('app.login');

    Route::post('app/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('app/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('app.password.request');

    Route::post('app/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('app.password.email');

    Route::get('app/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('app.password.reset');

    Route::post('app/reset-password', [NewPasswordController::class, 'store'])
                ->name('app.password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('app/verify-email', EmailVerificationPromptController::class)
                ->name('app.verification.notice');

    Route::get('app/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('app.verification.verify');

    Route::post('app/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('app.verification.send');

    Route::get('app/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('app.password.confirm');

    Route::post('app/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('app/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('app/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('app.logout');
});
