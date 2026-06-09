<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'sendContact'])->name('contact.send');
Route::get('/providers', [FrontendController::class, 'providers'])->name('providers');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/posts', [FrontendController::class, 'posts'])->name('posts');

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [FrontendController::class, 'ajoutPost'])->name('posts.create');
    Route::post('/posts', [FrontendController::class, 'storePost'])->name('posts.submit');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'Showlogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

    Route::get('/signup', [SignupController::class, 'Showsigne'])->name('sign');
    Route::post('/signup', [SignupController::class, 'register'])->name('signup.store');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
