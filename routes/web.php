<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PrincipleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
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
Route::get('/', function () {return redirect()->route('admin.home');});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [ProfileController::class, 'dashboard'])->name('home');

    //permission
    Route::get('/permission-datatable', [PermissionController::class, 'dataTable']);
    Route::resource('permissions', PermissionController::class);

    //roles
    Route::get('/roles-datatable', [RolesController::class, 'dataTable']);
    Route::resource('roles', RolesController::class);

    //users
    Route::get('/users-datatable', [UserController::class, 'dataTable']);
    Route::resource('users', UserController::class);

    //principle
    Route::get('/principle-datatable', [PrincipleController::class, 'dataTable']);
    Route::resource('principles', PrincipleController::class);

    //category
    Route::get('/category-datatable', [CategoryController::class, 'dataTable']);
    Route::resource('categories', CategoryController::class);

    //ingredient
    Route::get('/ingredient-datatable', [IngredientController::class, 'dataTable']);
    Route::resource('ingredients', IngredientController::class);

    //products
    Route::get('/product-datatable', [ProductController::class, 'dataTable']);
    Route::post('/products/storeMedia', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::post('/products/deleteMedia', [ProductController::class, 'deleteMedia'])->name('products.deleteMedia');
    Route::resource('products', ProductController::class);
});

require __DIR__ . '/auth.php';
