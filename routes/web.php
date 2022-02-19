<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Auth\LoginSocialController;


/**
 * Public routes
 *
 * Routes that are used between both frontend and backend.
 */

Route::get('lang/{lang}', [LocaleController::class, 'store'])->name('locale.store');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('login/{provider}', [LoginSocialController::class, 'redirect'])->name('social.login');
    Route::get('login/{provider}/callback', [LoginSocialController::class, 'callback']);
});

/**
 * Private routes
 */
Route::middleware(['auth', 'verified'])->group(function() {
    /**
     * Frontend Routes
     */
    Route::prefix('u')->group(function() {
        includeRouteFiles(__DIR__.'/app/');
    });

    /**
     * Admin Routes
     */
    Route::prefix('a')->name('admin.')->middleware('permission:access admin')->group(function() {
        includeRouteFiles(__DIR__.'/admin/');
    });
});
