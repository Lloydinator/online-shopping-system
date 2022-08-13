<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Users
Route::group([], function () {
    Route::get('home', [CustomerController::class, 'index'])->name('all-users');
    Route::post('create-user', [CustomerController::class, 'store'])->name('create-user');
    Route::post('edit-user/{id}', [CustomerController::class, 'update'])->name('edit-user');
    Route::post('delete-user/{id}', [CustomerController::class, 'destroy'])->name('delete-user');
});

// Products
Route::group(['prefix' => 'products'], function () {
    Route::get('all', [ProductController::class, 'index'])->name('all-products');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('show-product');
    Route::post('create', [ProductController::class, 'store'])->name('create-product');
    Route::post('edit/{id}', [ProductController::class, 'update'])->name('edit-product');
    Route::post('delete/{id}', [ProductController::class, 'destroy'])->name('delete-product');
});

// Orders
Route::group(['prefix' => 'orders'], function () {
    Route::get('all', [OrderController::class, 'index'])->name('all-orders');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('show-order');
    Route::post('create', [OrderController::class, 'store'])->name('create-order');
    Route::post('edit/{id}', [OrderController::class, 'update'])->name('edit-order');
    Route::post('delete/{id}', [OrderController::class, 'destroy'])->name('delete-order');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
