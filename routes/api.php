<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\PlaylistController;
use App\Http\Middleware\ValidateApiKey;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('apikeys', [ApiKeyController::class, 'index']);
    Route::get('apikeys/{apiKey}', [ApiKeyController::class, 'show']);
    Route::post('apikeys', [ApiKeyController::class, 'store']);
    Route::delete('apikeys/{apiKey}', [ApiKeyController::class, 'destroy']);
});

Route::get('playlists', [PlaylistController::class, 'userPlaylists'])->middleware([ValidateApiKey::class])->name('api-playlists.index');
