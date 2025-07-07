<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backends.home.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
