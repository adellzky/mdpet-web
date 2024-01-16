<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\APICommentController;
use App\Http\Controllers\Api\APIOrderController;
use App\Http\Controllers\Api\APIPostController;
use App\Http\Controllers\Api\APIProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroomingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\itemController;
use App\Http\Resources\GroomingResource;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);


// Orders
Route::get('/orders', [APIOrderController::class, 'index']);
Route::get('/orders/{id}', [APIOrderController::class, 'show']);
Route::post('/orders', [APIOrderController::class, 'store']);
Route::post('/orders/{id}', [APIOrderController::class, 'update']);
Route::delete('/orders/{id}', [APIOrderController::class, 'destroy']);


// Products
Route::get('/products', [APIProductController::class, 'index']);
Route::get('/products/{id}', [APIProductController::class, 'show']);
Route::post('/products', [APIProductController::class, 'store']);
Route::post('/products/{id}', [APIProductController::class, 'update']);
Route::delete('/products/{id}', [APIProductController::class, 'destroy']);


// Posts
Route::get('/posts', [APIPostController::class, 'index']);
Route::get('/posts/{id}', [APIPostController::class, 'show']);
Route::post('/posts', [APIPostController::class, 'store']);
Route::post('/posts/{id}', [APIPostController::class, 'update']);
Route::delete('/posts/{id}', [APIPostController::class, 'destroy']);

// Comments
Route::get('/comments', [APICommentController::class, 'index']);
Route::get('/comments/{id}', [APICommentController::class, 'show']);
Route::post('/comments', [APICommentController::class, 'store']);
Route::post('/comments/{id}', [APICommentController::class, 'update']);
Route::delete('/comments/{id}', [APICommentController::class, 'destroy']);



// Route::post('/customer/register', [CustomerController::class, 'register']);
// Route::post('/customer/login', [CustomerController::class, 'login']);
// Route::post('/customer/logout', [CustomerController::class, 'logout'])->middleware(['auth:sanctum']);



// Route::get('/items', [itemController::class, 'index']);
// Route::post('/additems', [itemController::class, 'store']);
// Route::put('/updateitems', [itemController::class, 'update']);


