<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;

// Route::get('buku', [BukuController::class, 'index']);
// Route::get('buku/{id}', [BukuController::class, 'show']);
// Route::post('buku', [BukuController::class, 'store']);
// Route::put('buku/{id}', [BukuController::class, 'update']);
// Route::delete('buku/{id}', [BukuController::class, 'destroy']);

Route::apiResource('buku', BukuController::class);
