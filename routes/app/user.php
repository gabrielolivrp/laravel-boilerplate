<?php

use App\Http\Controllers\App\Profile\UserProfilePhotoController;
use App\Http\Controllers\App\Profile\UserProfileController;

Route::name('user-profile-information.')->group(function() {
    Route::put('delete-profile-photo', [UserProfilePhotoController::class, 'delete'])->name('delete-profile-photo');
    Route::put('upload-profile-photo', [UserProfilePhotoController::class, 'upload'])->name('upload-profile-photo');
    Route::get('profile', [UserProfileController::class, 'index'])->name('index');
});
