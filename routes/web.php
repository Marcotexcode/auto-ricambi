<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prodotti', function () {
    return view('prodotti.index');
})->name('prodotti_index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('product', ProductController::class);

Route::get('/prodotti', [ProductController::class, 'index']);

Route::post('/prodottiStore', [ProductController::class, 'store'])->name('prodottiStore');

Route::get('/filterOrder', [ProductController::class, 'filterOrder'])->name('filterOrder');

