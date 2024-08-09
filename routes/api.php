<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'register']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'logout']);
    Route::get('profile', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'profile']);

    Route::get('holiday', [\App\Http\Controllers\api\holiday\HolidayController::class, 'getAll']);
    Route::get('holiday/{id}', [\App\Http\Controllers\api\holiday\HolidayController::class, 'getOne']);
    Route::post('holiday', [\App\Http\Controllers\api\holiday\HolidayController::class, 'create']);
    Route::put('holiday/{id}', [\App\Http\Controllers\api\holiday\HolidayController::class, 'update']);
    Route::delete('holiday/{id}', [\App\Http\Controllers\api\holiday\HolidayController::class, 'delete']);
    Route::get('holiday/{id}/pdf', [\App\Http\Controllers\api\holiday\HolidayController::class, 'pdfGenerator']);

    Route::patch('holiday/{id}/participants/related', [\App\Http\Controllers\api\holiday\ParticipantsController::class, 'relatedParticipants']);
    Route::patch('holiday/{id}/participants/unrelated', [\App\Http\Controllers\api\holiday\ParticipantsController::class, 'unrelatedParticipants']);
});
