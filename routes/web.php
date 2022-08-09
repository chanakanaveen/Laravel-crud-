<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});

Route::get('/product-show/{slug}', [PageController::class, 'show'])->name('product.show');

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
//     Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

    Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/product-add', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product-edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product-update/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product-delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    });

        