<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('products.user.index');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    
    return redirect()->route('products.user.index');
});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create',[ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/edit/{id}',[ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}',[ProductController::class, 'destroy'])->name('products.delete');
    Route::get('/users/details/{user}',[UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{user}',[UserController::class, 'edit'])->name('users.edit');
    Route::post('users/edit/{user}', [UserController::class, 'update'])->name('users.update');    
});

Route::get('/products/index',[ProductController::class, 'getProducts'])->name('products.user.index');
Route::get('/products/detail/{id}',[ProductController::class, 'show'])->name('products.show');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [LoginController::class, 'create'])->name('admins.loginCreate');
    Route::post('/login', [LoginController::class, 'login'])->name('admins.login');
 
    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('dashboard', function () {
            return view('admins.dashboard');
        })->name('adminDashboard');
        Route::get('/products/edit/{product}',[AdminProductController::class, 'edit'])->name('admins.products.edit');
        Route::post('/products/edit/{id}',[AdminProductController::class, 'update'])->name('admin.products.update');
        Route::get('/products/delete/{id}',[AdminProductController::class, 'destroy'])->name('admins.products.delete');
        Route::get('/products/list',[AdminProductController::class, 'index'])->name('admins.products.index');
        Route::get('/products/export',[AdminProductController::class, 'index'])->name('products.export');
        Route::post('/products/import',[AdminProductController::class, 'import'])->name('products.import');

        Route::get('/users/create',[AdminUserController::class, 'create'])->name('admins.users.create');
        Route::post('/users/create',[AdminUserController::class, 'store'])->name('admins.users.store');
        Route::get('/users/index', [AdminUserController::class, 'index'])->name('admins.users.list');
        Route::get('/users/edit/{user}',[AdminUserController::class, 'edit'])->name('admins.users.edit');
        Route::post('users/edit/{user}', [AdminUserController::class, 'update'])->name('admins.users.update');
        Route::get('users/delete/{user}',[AdminUserController::class, 'destroy'])->name('admins.users.destroy');
        Route::get('/sendEmail/{id}', [SendEmailController::class, 'index'])->name('adminLte.sendEmail');

        Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/create',[CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/list',[CategoryController::class, 'list'])->name('categories.list');
        Route::get('/categories/edit/{id}',[CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/edit/{id}',[CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/delete/{id}',[CategoryController::class, 'destroy'])->name('categories.delete');
    });
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admins.logout');
});