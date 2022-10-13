<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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
Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
Route::post('users/edit/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('users/delete/{id}',[UserController::class, 'delete'])->name('users.destroy');
Route::get('/categories/create',[CategoryController::class, 'add'])->name('categories.add');
Route::post('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/list',[CategoryController::class, 'list'])->name('categories.list');
Route::get('/categories/edit/{id}',[CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/edit/{id}',[CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/delete/{id}',[CategoryController::class, 'delete'])->name('categories.delete');
Route::get('/products/create',[ProductController::class, 'add'])->name('products.add');
Route::post('/products/create',[ProductController::class, 'create'])->name('products.create');
Route::get('/products/list',[ProductController::class, 'list'])->name('products.list');
Route::get('/products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/edit/{id}',[ProductController::class, 'update'])->name('products.update');
Route::get('/products/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');