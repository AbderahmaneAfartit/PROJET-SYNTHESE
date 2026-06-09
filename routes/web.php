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
 Route::get('/login', [LoginController::class, 'Showlogin'])->name('login');
   Route::get('/signup', [SignupController::class, 'Showsigne'])->name('sign');

// Route::middleware('guest')->group(function () {
//     // Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//    ->name('login.attempt');
//   ->name('signup');
//     // Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');
// });

// Route::post('/logout', [AuthController::class, 'logout'])
//     ->middleware('auth')
//     ->name('logout');
