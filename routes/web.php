<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//-------role and permission routes

Route::get('/roles-list', [App\Http\Controllers\Backends\RoleController::class, 'index'])->name('roles.index');
Route::get('/roles-create', [App\Http\Controllers\Backends\RoleController::class, 'create'])->name('roles.create');
Route::post('/roles-store', [App\Http\Controllers\Backends\RoleController::class, 'store'])->name('roles.store');
Route::get('/roles-show/{id}', [App\Http\Controllers\Backends\RoleController::class, 'show'])->name('roles.show');
Route::get('/roles-edit/{id}', [App\Http\Controllers\Backends\RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles-update/{id}', [App\Http\Controllers\Backends\RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles-destroy/{id}', [App\Http\Controllers\Backends\RoleController::class, 'destroy'])->name('roles.destroy');


//----------user routes
Route::get('/users-list', [App\Http\Controllers\Backends\UserController::class, 'index'])->name('users.index');
Route::get('/users-create', [App\Http\Controllers\Backends\UserController::class, 'create'])->name('users.create');
Route::post('/users-store', [App\Http\Controllers\Backends\UserController::class, 'store'])->name('users.store');
Route::get('/users-show/{id}', [App\Http\Controllers\Backends\UserController::class, 'show'])->name('users.show');
Route::get('/users-edit/{id}', [App\Http\Controllers\Backends\UserController::class, 'edit'])->name('users.edit');
Route::post('/users-update/{id}', [App\Http\Controllers\Backends\UserController::class, 'update'])->name('users.update');
Route::delete('/users-destroy/{id}', [App\Http\Controllers\Backends\UserController::class, 'destroy'])->name('users.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
