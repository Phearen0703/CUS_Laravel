<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backends.home.index');
});
