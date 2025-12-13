<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InterviewController;

// Public pages
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/ai-interview', function () {
    return view('pages.ai-interview');
})->name('ai-interview');

Route::get('/expert-interview', function () {
    return view('pages.expert-interview');
})->name('expert-interview');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// ---------- Auth routes ---------- //

// Signup
Route::get('/signup', [AuthController::class, 'showSignup'])
    ->middleware('guest')
    ->name('signup.show');

Route::post('/signup', [AuthController::class, 'signup'])
    ->middleware('guest')
    ->name('signup');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login.show');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

// Dashboard (only logged-in users)
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------- AI Interview API routes ---------- //
Route::post('/api/interview/generate-question', [InterviewController::class, 'generateQuestion'])
    ->name('interview.generate');

Route::post('/api/interview/evaluate-answer', [InterviewController::class, 'evaluateAnswer'])
    ->name('interview.evaluate');

Route::post('/api/interview/generate-feedback', [InterviewController::class, 'generateFeedback'])
    ->name('interview.feedback');
