<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ChatController;
use App\Http\Controllers\api\ChatNameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([
        'middleware' => 'auth:sanctum'
    ], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::apiResource('chatname', ChatNameController::class);
    Route::apiResource('chats', ChatController::class);
});
