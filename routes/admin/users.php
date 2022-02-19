<?php

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserPasswordController;
use App\Http\Controllers\Admin\User\UserStatusController;
use App\Http\Controllers\Admin\User\UserConfirmationController;
use App\Http\Controllers\Admin\User\UserDeletedController;

/**
 * Users route
 */
Route::prefix('users')->name('users.')->group(function() {
    Route::prefix('{user}')->group(function() {
        // Deleted
        Route::delete('permanently-delete', [UserDeletedController::class, 'forceDelete'])->name('permanently-delete');
        Route::post('restore', [UserDeletedController::class, 'restore'])->name('restore');

        // Password update
        Route::get('password/change', [UserPasswordController::class, 'index'])->name('change-password');
        Route::put('password/change/update', [UserPasswordController::class, 'update'])->name('change-password.update');

        // Status
        Route::post('deactivate', [UserStatusController::class, 'deactivate'])->name('deactivate');
        Route::post('reactivate', [UserStatusController::class, 'reactivate'])->name('reactivate');

        // Email verification
        Route::post('confirm/email-verification', [UserConfirmationController::class, 'confirmEmailVerification'])
            ->name('confirm-email-verification');
        Route::post('unconfirm/email-verification', [UserConfirmationController::class, 'unconfirmEmailVerification'])
            ->name('unconfirm-email-verification');
        Route::post('resend/email-verification', [UserConfirmationController::class, 'resendEmailVerification'])
            ->name('resend-email-verification');
    });

    Route::get('deleted', [UserDeletedController::class, 'deleted'])->name('deleted');

    Route::get('deactivated', [UserStatusController::class, 'deactivated'])->name('deactivated');
});

Route::resource('users', UserController::class);
