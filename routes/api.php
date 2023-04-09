<?php

use App\Http\Controllers\API\Accounts\AccountController;
use App\Http\Controllers\API\Accounts\AccountTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.')->group(function () {
    Route::prefix('accounts')->name('accounts.')->group(function () {
        # URL prefix /api/v1/accounts/xxx, Route name prefix api.accounts.xxx
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('/', [AccountController::class, 'store'])->name('store');
        Route::get('{account}', [AccountController::class, 'show'])->name('show');
        Route::put('{account}', [AccountController::class, 'update'])->name('update');
    });

    Route::get('account-types', [AccountTypeController::class, 'index'])->name('account-types.index');
});
