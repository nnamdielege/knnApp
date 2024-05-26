<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnnController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/classify', [KnnController::class, 'classify']);
Route::post('/cross-validate', [KnnController::class, 'crossValidate']);
