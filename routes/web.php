<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Public pages
Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/ai-interview', fn () => view('pages.ai-interview'))->name('ai-interview');
Route::get('/expert-interview', fn () => view('pages.expert-interview'))->name('expert-interview');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');

// Auth routes
Route::get('/signup', [AuthController::class, 'showSignup'])->middleware('guest')->name('signup.show');
Route::post('/signup', [AuthController::class, 'signup'])->middleware('guest')->name('signup');

Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard + Admin routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::post('/admin/user/{id}/promote', [AdminController::class, 'promoteUser'])
        ->name('admin.user.promote');

    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])
        ->name('admin.user.delete');
});
