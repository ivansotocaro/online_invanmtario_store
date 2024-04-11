<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
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

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Products
Route::get('/productsAvailable', [ProductController::class, 'getProductsAvailable'])->name('product.available');
Route::get('/product/{id}', [ProductController::class, 'getProductById'])->name('product.detail');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

//Clients
Route::get('/client', [ClientController::class, 'allClient'])->name('client.all');
Route::get('/client/{id}', [ClientController::class, 'getClientById'])->name('client.show');
Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');
Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

//Buy
Route::post('/buy/store', [BuyController::class, 'store'])->name('buy.store');

require __DIR__.'/auth.php';
