<?php

use App\Http\Controllers\App\HomeController;

Route::get('home', [HomeController::class, 'index'])->name('home');

