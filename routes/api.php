<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
    });
    Route::group(['prefix' => 'users'], function () {
        Route::post('{user}/invite', [UserController::class, 'invite']);
        Route::get('{user}/invitations', [UserController::class, 'invitations']);
        Route::get('{user}/feedback-invitations', [UserController::class, 'feedbackInvitations']);
        /* next link does not work*/
        // Route::apiResource('', UserController::class)->except(['delete']);
    });
    Route::apiResource('users', UserController::class)->except(['delete']);
    Route::get('invitations/{invitation}/feedback', [InvitationController::class, 'feedback']);
    Route::post('invitations/{invitation}/skills/{skill}', [InvitationController::class, 'skills']);
    Route::apiResource('skills', SkillController::class)->only(['index']);
});
