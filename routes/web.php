<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegisterController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users/details/{id}',[UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{user}',[UserController::class, 'edit'])->name('users.edit');
Route::post('users/edit/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('users/delete/{id}',[UserController::class, 'destroy'])->name('users.destroy');
Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/create',[CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/list',[CategoryController::class, 'list'])->name('categories.list');
Route::get('/categories/edit/{id}',[CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/edit/{id}',[CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/delete/{id}',[CategoryController::class, 'destroy'])->name('categories.delete');
Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
Route::post('/products/create',[ProductController::class, 'store'])->name('products.store');
Route::get('/products/list',[ProductController::class, 'index'])->name('products.list');
Route::get('/products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/edit/{id}',[ProductController::class, 'update'])->name('products.update');
Route::get('/products/delete/{id}',[ProductController::class, 'destroy'])->name('products.delete');
Route::get('/products/detail/{id}',[ProductController::class, 'show'])->name('products.show');
Route::get('/products/search',[ProductController::class, 'search'])->name('products.search');
Route::get('/products/index',[ProductController::class, 'getProducts'])->name('products.user.index');

Route::get('/admins/dashboard',[LoginController::class, 'showDashboard'])->name('admins.dashboard');
Route::get('/admins/users/list',[LoginController::class, 'showDashboard'])->name('admins.dashboard');
Route::get('/products/export',[ProductController::class, 'export'])->name('products.export');
Route::post('/products/import',[ProductController::class, 'import'])->name('products.import');
Route::get('/sendEmail/{id}', [SendEmailController::class, 'index'])->name('adminLte.sendEmail');
//Route::get('/admins/login',[LoginController::class, 'create'])->name('admins.create');
//Route::post('/admins/login',[LoginController::class, 'login'])->name('admins.login');
Route::get('/admins/users/create',[UserController::class, 'create'])->name('admins.users.create');
Route::post('/admins/users/create',[UserController::class, 'store'])->name('admins.users.store');
Route::get('/admins/users/index', [UserController::class, 'index'])->name('admins.users.list');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [LoginController::class, 'create'])->name('admins.loginCreate');
    Route::post('/login', [LoginController::class, 'login'])->name('admins.login');
 
    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/admin/dashboard', function () {
            return view('admins.dashboard');
        })->name('adminDashboard');
 
    });
});

