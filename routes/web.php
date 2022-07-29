<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes([

    'login'    => true,

    'logout'   => true,

    'register' => true,

    'reset'    => false,   // for resetting passwords

    'confirm'  => false,  // for additional password confirmations

    'verify'   => false,  // for email verification

]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Products
Route::get('/products',[ProductController::class,'index'])->name('admin.products');
Route::post('/products',[ProductController::class,'store'])->name('admin.products');
Route::post('/products/csv',[ProductController::class,'storeCsv'])->name('admin.products.csv');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
