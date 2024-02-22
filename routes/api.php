<?php

use App\Http\Controllers\api\AccountController;
use App\Http\Controllers\api\auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
Route::group([
    "middleware" => ["auth:api"]
], function () {

    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::get("logout", [AuthController::class, "logout"]);
    // bank  account  service 
    Route::put('bankaccount/editAccount/{id}', [AccountController::class, "editAccount"]);
    Route::post('bankaccount/createAccount', [AccountController::class, 'createAccount']);
    Route::get('bankaccount', [AccountController::class,'getAllAccount']);
    Route::get('bankaccount/{id}', [AccountController::class, 'getAnaccount']);
    Route::delete('bankaccount/{id}', [AccountController::class, 'deleteAccount']);
    Route::get('users', [AccountController::class, 'getUsers']);
});
