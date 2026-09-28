<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Frontend Routes
Route::get('/products', [FrontendController::class, 'getProducts']);
Route::get('/products/{id}', [FrontendController::class, 'getProduct']);
Route::get('/categories', [FrontendController::class, 'getCategories']);

// Authentication Routes
Route::post('/login', [AuthController::class, 'loginClient']);
Route::post('/register', [AuthController::class, 'registerClient']);
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);


// Checkout Route
Route::post('/checkout', [CheckoutController::class, 'checkout']);

// Public orders lookup by client id (for order history page)
Route::get('/commands', [CheckoutController::class, 'getClientOrders']);

// Protected Client Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Protected Admin Dashboard Routes
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/stats', [AdminController::class, 'getDashboardStats']);
    Route::get('/products/archived', [AdminController::class, 'getArchivedProducts']);
    Route::post('/products/{id}/restore', [AdminController::class, 'restoreProduct']);
    
    Route::post('/products', [AdminController::class, 'addProduct']);
    Route::put('/products/{id}', [AdminController::class, 'editProduct']);
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct']);
    
    Route::post('/categories', [AdminController::class, 'addCategory']);
    Route::put('/categories/{id}', [AdminController::class, 'editCategory']);
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory']);
    
    Route::get('/orders', [AdminController::class, 'getOrders']);
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus']);
    
    Route::get('/users', [AdminController::class, 'getUsers']);
});
