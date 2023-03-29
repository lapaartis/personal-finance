<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('WelcomeView', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
Route::get('tables', [DashboardController::class, 'tables'])->name('tables');
Route::get('forms', [DashboardController::class, 'forms'])->name('forms');
Route::get('ui', [DashboardController::class, 'ui'])->name('ui');
Route::get('error', [DashboardController::class, 'error'])->name('error');

Route::resource('accounts',AccountController::class);
