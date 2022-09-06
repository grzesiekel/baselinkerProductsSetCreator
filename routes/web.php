<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetController;
use Illuminate\Support\Facades\Artisan;
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

//Sets

Route::get('/sets',[SetController::class,'index'])->name('admin.sets');
Route::get('/sets/{set}',[SetController::class,'show'])->name('admin.sets.show');
Route::post('/sets',[SetController::class,'store'])->name('admin.sets');
Route::post('/sets/csv',[SetController::class,'storeCsv'])->name('admin.sets.csv');
Route::delete('/sets/{set}', [SetController::class, 'destroy'])->name('admin.sets.destroy');
Route::post('/sets/attach/{set}/{product}', [SetController::class, 'attachProduct'])->name('admin.sets.attachProduct');
Route::delete('/sets/detach/{set}/{product}', [SetController::class, 'detachProduct'])->name('admin.sets.detachProduct');

//Artisan commands
Route::get('reboot',function(){
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
  });
  Route::get('migrate',function(){
    Artisan::call('migrate');
 
 });
 Route::get('migrate-fresh',function(){
    Artisan::call('migrate:fresh');
 
 });
 Route::get('rollback',function(){
    Artisan::call('migrate:rollback');
 });