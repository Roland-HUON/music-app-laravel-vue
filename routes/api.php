<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('apikeys', [ApiKeyController::class, 'index']);
    Route::get('apikeys/{apiKey}', [ApiKeyController::class, 'show']);
    Route::post('apikeys', [ApiKeyController::class, 'store']);
    Route::delete('apikeys/{apiKey}', [ApiKeyController::class, 'destroy']);
});
