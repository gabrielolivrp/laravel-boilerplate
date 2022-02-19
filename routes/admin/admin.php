<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('roles', RoleController::class)->except('show');
