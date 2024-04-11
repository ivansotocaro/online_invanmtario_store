<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('jwt.verify')->group(function() {

    Route::post('/buy/store', [BuyController::class, 'store'])->name('buy.store');

    Route::get('/productsAvailable', [ProductController::class, 'getProductsAvailable'])->name('product.available');
    Route::get('/product/{id}', [ProductController::class, 'getProductById'])->name('product.detail');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');


//Clients
    Route::get('/client', [ClientController::class, 'allClient'])->name('client.all');
    Route::get('/client/{id}', [ClientController::class, 'getClientById'])->name('client.show');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}/delete', [ClientController::class, 'destroy'])->name('client.destroy');
});
