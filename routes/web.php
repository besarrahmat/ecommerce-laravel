<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product', [ProductController::class, 'store'])->name('product.store');
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::post('cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::patch('cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
