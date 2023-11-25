<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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


Route::get('/', [ProductController::class, 'productindex']);
Route::get('/welcome', [ProductController::class, 'productindex'])->name('productindex');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


});


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});
