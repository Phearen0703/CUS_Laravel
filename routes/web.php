<?php


use App\Http\Middleware\IsDeveloper;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    // All routes in here are protected by the 'auth' middleware
    Route::get('/roles-list', [App\Http\Controllers\Backends\RoleController::class, 'index'])->name('roles.index');
});

Route::get('/', function () {
    return view('home');
});


use App\Http\Middleware\ActiveUser;

Route::group([
    'namespace'  => 'App\Http\Controllers\Backends',
    'prefix'     => 'admin',
    'middleware' => [ActiveUser::class],
], function () {

    
    Route::get('/', 'HomeController@index')->name('admin.home');



    //-------role and permission routes

Route::get('/roles-list', [App\Http\Controllers\Backends\RoleController::class, 'index'])->name('roles.index');
Route::get('/roles-create', [App\Http\Controllers\Backends\RoleController::class, 'create'])->name('roles.create');
Route::post('/roles-store', [App\Http\Controllers\Backends\RoleController::class, 'store'])->name('roles.store');
Route::get('/roles-show/{id}', [App\Http\Controllers\Backends\RoleController::class, 'show'])->name('roles.show');
Route::get('/roles-edit/{id}', [App\Http\Controllers\Backends\RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles-update/{id}', [App\Http\Controllers\Backends\RoleController::class, 'update'])->name('roles.update');
Route::get('/roles-delete/{id}', [App\Http\Controllers\Backends\RoleController::class, 'delete'])->name('roles.delete');

    //----------permission routes
Route::get('/roles/{id}/permissions', [App\Http\Controllers\Backends\RoleController::class, 'permissions'])->name('roles.permissions');
Route::get('/roles/{id}/permissions-update', [App\Http\Controllers\Backends\RoleController::class, 'permissionsUpdate'])->name('roles.permissions.update');


//----------user routes
Route::get('/users-list', [App\Http\Controllers\Backends\UserController::class, 'index'])->name('users.index');
Route::get('/users-create', [App\Http\Controllers\Backends\UserController::class, 'create'])->name('users.create');
Route::post('/users-store', [App\Http\Controllers\Backends\UserController::class, 'store'])->name('users.store');
Route::get('/users-show/{id}', [App\Http\Controllers\Backends\UserController::class, 'show'])->name('users.show');
Route::get('/users-edit/{id}', [App\Http\Controllers\Backends\UserController::class, 'edit'])->name('users.edit');
Route::post('/users-update/{id}', [App\Http\Controllers\Backends\UserController::class, 'update'])->name('users.update');
Route::get('/users-delete/{id}', [App\Http\Controllers\Backends\UserController::class, 'delete'])->name('users.delete');

//----------permission routes
Route::get('/permissions-list', [App\Http\Controllers\Backends\PermissionController::class, 'index'])->name('permissions.index')->middleware(IsDeveloper::class);
Route::get('/permissions-create', [App\Http\Controllers\Backends\PermissionController::class, 'create'])->name('permissions.create')->middleware(IsDeveloper::class);
Route::post('/permissions-store', [App\Http\Controllers\Backends\PermissionController::class, 'store'])->name('permissions.store')->middleware(IsDeveloper::class);
Route::get('/permissions-show/{id}', [App\Http\Controllers\Backends\PermissionController::class, 'show'])->name('permissions.show')->middleware(IsDeveloper::class);
Route::get('/permissions-edit/{id}', [App\Http\Controllers\Backends\PermissionController::class, 'edit'])->name('permissions.edit')->middleware(IsDeveloper::class);
Route::post('/permissions-update/{id}', [App\Http\Controllers\Backends\PermissionController::class, 'update'])->name('permissions.update')->middleware(IsDeveloper::class);
Route::get('/permissions-delete/{id}', [App\Http\Controllers\Backends\PermissionController::class, 'delete'])->name('permissions.delete')->middleware(IsDeveloper::class);


//----------book routes
Route::get('/books-list', [App\Http\Controllers\Backends\BookController::class, 'index'])->name('books.index');
Route::get('/books-create', [App\Http\Controllers\Backends\BookController::class, 'create'])->name('books.create');
Route::post('/books-store', [App\Http\Controllers\Backends\BookController::class, 'store'])->name('books.store');
Route::get('/books-show/{id}', [App\Http\Controllers\Backends\BookController::class, 'show'])->name('books.show');
Route::get('/books-edit/{id}', [App\Http\Controllers\Backends\BookController::class, 'edit'])->name('books.edit');
Route::post('/books-update/{id}', [App\Http\Controllers\Backends\BookController::class, 'update'])->name('books.update');
Route::get('/books-delete/{id}', [App\Http\Controllers\Backends\BookController::class, 'delete'])->name('books.delete');


//----------category routes
Route::get('/categorys-list', [App\Http\Controllers\Backends\CategoryController::class, 'index'])->name('categorys.index');
Route::get('/categorys-create', [App\Http\Controllers\Backends\CategoryController::class, 'create'])->name('categorys.create');
Route::post('/categorys-store', [App\Http\Controllers\Backends\CategoryController::class, 'store'])->name('categorys.store');
Route::get('/categorys-show/{id}', [App\Http\Controllers\Backends\CategoryController::class, 'show'])->name('categorys.show');
Route::get('/categorys-edit/{id}', [App\Http\Controllers\Backends\CategoryController::class, 'edit'])->name('categorys.edit');
Route::post('/categorys-update/{id}', [App\Http\Controllers\Backends\CategoryController::class, 'update'])->name('categorys.update');
Route::get('/categorys-delete/{id}', [App\Http\Controllers\Backends\CategoryController::class, 'delete'])->name('categorys.delete');




//no permission
Route::get('/admin.no_permission', function () {
    return view('backends.no_permission');
})->name('admin.no_permission');

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\Frontends\BookController::class, 'index'])->name('home');


Route::fallback(function () {
    redirect()->route('admin.home');
});