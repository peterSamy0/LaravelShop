<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/redirect', [HomeController::class, 'redirect']);

// category routes
Route::get('/category', [AdminController::class, 'category'])->name('category');
Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
Route::delete('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
Route::put('/editCategory/{id}', [AdminController::class, 'editCategory'])->name('editCategory');


// products routes api resources
Route::apiResource('/products', ProductController::class);
Route::get('/addProducts', [ProductController::class, 'create'])->name('product.create');

// add to cart routes
Route::get('/addToCart/{id}', [HomeController::class, 'addToCart']);
Route::get('/cart', [HomeController::class, 'goToCart']);
Route::delete('/deleteFromCart/{id}', [HomeController::class, 'deleteProductFromCart']);
