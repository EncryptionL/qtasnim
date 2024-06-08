<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\TransactionController;
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

Route::permanentRedirect('/', '/transactions')->name('home');

Route::resource('/products/types', ProductTypeController::class)->names('products.types');
Route::resource('/products', ProductController::class)->names('products');
Route::get('/transactions/typecomparison', [TransactionController::class, 'typeComparison'])->name('transactions.typecomparison');
Route::resource('/transactions', TransactionController::class)->names('transactions');
