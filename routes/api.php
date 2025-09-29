<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::prefix('v1')->group(function () {
    // Routes publiques
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/search', [PostController::class, 'search']);
    Route::get('posts/{post}', [PostController::class, 'show']);

    // Routes protégées (optionnel pour l'admin)
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('posts', [PostController::class, 'store']);
        Route::put('posts/{post}', [PostController::class, 'update']);
        Route::delete('posts/{post}', [PostController::class, 'destroy']);
    });
});
