<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'login']);
Route::post('register', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'register']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'logout']);
    Route::get('profile', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'profile']);
});
