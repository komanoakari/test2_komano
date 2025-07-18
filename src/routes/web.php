<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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
Route::get('/products/register', [ContactController::class, 'add']);
Route::post('/products/register', [ContactController::class, 'create']);

Route::get('/products/search', [ContactController::class, 'search']);

Route::get('/products', [ContactController::class, 'index']);
Route::get('/products/{productId}', [ContactController::class, 'edit']);
Route::put('/products/{productId}/update', [ContactController::class, 'update']);


Route::post('/products/{productId}/delete', [ContactController::class, 'destroy']);