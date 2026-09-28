<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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

// ── Pages publiques ─────────────────────────────────────────────────────────
Route::get('/',           [PageController::class, 'index'])->name('home');
Route::get('/index.html', [PageController::class, 'index']);

Route::get('/about',      [PageController::class, 'about'])->name('about');
Route::get('/about.html', [PageController::class, 'about']);

Route::get('/contact',      [PageController::class, 'contact'])->name('contact');
Route::get('/contact.html', [PageController::class, 'contact']);


Route::get('/product',      [PageController::class, 'product'])->name('product');
Route::get('/product.html', [PageController::class, 'product']);

Route::get('/cart',      [PageController::class, 'cart'])->name('cart');
Route::get('/cart.html', [PageController::class, 'cart']);

Route::get('/checkout',      [PageController::class, 'checkout'])->name('checkout');
Route::get('/checkout.html', [PageController::class, 'checkout']);

Route::get('/categories',      [PageController::class, 'categories'])->name('categories');
Route::get('/categories.html', [PageController::class, 'categories']);

Route::get('/orders',      [PageController::class, 'orders'])->name('orders');
Route::get('/orders.html', [PageController::class, 'orders']);

// ── Admin ────────────────────────────────────────────────────────────────────

// Login page — accessible without auth
Route::get('/admin/login',      [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/login.html', [AdminController::class, 'login']);
Route::post('/admin/login',     [AdminController::class, 'postLogin'])->name('admin.login.post');

// Logout
Route::post('/admin/logout',    [AdminController::class, 'logout'])->name('admin.logout');

// Protected admin routes — require admin login
Route::middleware('admin.auth')->group(function () {
    Route::get('/admin',            [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/index.html', [AdminController::class, 'index']);
});
