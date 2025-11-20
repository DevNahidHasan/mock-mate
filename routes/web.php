<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/ai-interview', function () {
    return view('pages.ai-interview');
});

Route::get('/expert-interview', function () {
    return view('pages.expert-interview');
});
