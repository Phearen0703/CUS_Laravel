<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsDeveloper;
use App\Http\Middleware\ActiveUser;

// Frontend Controllers
use App\Http\Controllers\Frontends\BookController as FrontendBookController;

// Backend Controllers
use App\Http\Controllers\Backends\HomeController as AdminHomeController;
use App\Http\Controllers\Backends\RoleController;
use App\Http\Controllers\Backends\UserController;
use App\Http\Controllers\Backends\PermissionController;
use App\Http\Controllers\Backends\BookController as AdminBookController;
use App\Http\Controllers\Backends\CategoryController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home page (all categories + books)
Route::get('/', [FrontendBookController::class, 'index'])->name('home');

// Category page (show books by category)
Route::get('/category/{id}', [FrontendBookController::class, 'category'])->name('frontend.category.show');

// Single book modal (AJAX modal)
Route::get('/book/{id}/modal', [FrontendBookController::class, 'showModal'])->name('frontends.books.modal');

// web.php
Route::get('/books/{id}/pdf', [FrontendBookController::class, 'viewPdf'])->name('books.viewPdf');




/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'admin',
    'middleware' => [ActiveUser::class],
], function () {

    // 🔹 Dashboard
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

    // 🔹 Roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/{id}/delete', [RoleController::class, 'delete'])->name('roles.delete');
        Route::get('/{id}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
        Route::post('/{id}/permissions-update', [RoleController::class, 'permissionsUpdate'])->name('roles.permissions.update');
    });

    // 🔹 Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('users.update');
        Route::get('/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    });

    // 🔹 Permissions
    Route::prefix('permissions')->middleware(IsDeveloper::class)->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/{id}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
        Route::get('/{id}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
    });

    // 🔹 Books (Admin)
    Route::prefix('books')->group(function () {
        Route::get('/', [AdminBookController::class, 'index'])->name('books.index');
        Route::get('/create', [AdminBookController::class, 'create'])->name('books.create');
        Route::post('/store', [AdminBookController::class, 'store'])->name('books.store');
        Route::get('/{id}', [AdminBookController::class, 'show'])->name('books.show');
        Route::get('/{id}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
        Route::post('/{id}/update', [AdminBookController::class, 'update'])->name('books.update');
        Route::get('/{id}/delete', [AdminBookController::class, 'delete'])->name('books.delete');
    });

    // 🔹 Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categorys.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categorys.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categorys.store');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('categorys.show');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categorys.edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('categorys.update');
        Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('categorys.delete');
    });

    // 🔹 No permission page
    Route::get('/no_permission', function () {
        return view('backends.no_permission');
    })->name('admin.no_permission');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();


/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('admin.home');
});
