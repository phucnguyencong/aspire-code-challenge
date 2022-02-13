<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RepaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
});

Route::group([
    'middleware' => 'auth:api'
], function () {

    Route::group([
        'prefix' => 'loan'
    ], function () {
            Route::post('/', [LoanController::class, 'store']);
            Route::patch('{id}/approval', [LoanController::class, 'approveLoan']);
            Route::post('{id}/repayment', [RepaymentController::class, 'createRepay']);
    });
});
