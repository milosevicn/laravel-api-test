<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [FrontendController::class, 'authenticate']);
Route::post('register', [FrontendController::class, 'register']);
 
Route::group(['middleware' => 'jwt.auth'], function () {
    // Route::get('logout', [FrontendController::class, 'logout']);
 
    // Product routes
    Route::post('create-product', [ProductController::class, 'store']);

    // Order routes
    Route::post('create-order', [OrderController::class, 'store']);
    Route::get('get-my-orders', [OrderController::class, 'getMyOrders']);
});
