<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::post('/store', [StoreController::class, 'addStore']);

Route::post('/products', [ProductController::class, 'createProduct']);
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/:product_id', [ProductController::class, 'getProduct']);
Route::post('/products/:product_id/inventory', [ProductController::class, 'updateProduct']);


