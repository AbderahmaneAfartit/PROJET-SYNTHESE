<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PostController;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app' => config('app.name'),
    ]);
});

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:190'],
        'subject' => ['required', 'string', 'max:80'],
        'message' => ['required', 'string', 'min:20', 'max:1000'],
    ]);

    Log::info('New contact message', $data);

    return response()->json([
        'message' => 'Message recu avec succes.',
    ], 201);
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
Route::apiResource('posts', PostController::class)->only(['index', 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin only for creating/updating services
    Route::apiResource('services', ServiceController::class)->except(['index', 'show']);

    // Manjob/Authenticated users for posts
    Route::apiResource('posts', PostController::class)->except(['index', 'show']);
});

Route::get('/client-jobs', [ClientJobController::class, 'index']);
