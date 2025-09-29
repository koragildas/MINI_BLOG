<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// General Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
// Grouping auth routes for better organization
Route::controller(UserController::class)->group(function () {
    // Registration
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');

    // Login / Logout
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});


// User CRUD Routes
// Using a resource controller simplifies defining CRUD routes.
// It automatically maps to index, show, create, store, edit, update, and destroy methods.
Route::resource('users', UserController::class)->except(['create', 'store']);

// Posts CRUD Routes
Route::resource('posts', PostController::class);


// Socialite (Social Login) Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('github.login');
Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);

// Note: Password Reset routes from the original file were standard and have been removed
// for this cleanup, but you can add them back using Laravel's built-in features if needed.
// php artisan make:auth will generate them for you.


