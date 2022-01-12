<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'index']);

Route::prefix('admin')->group(function () {

    Route::get('index', [MainController::class, 'index']);

    Route::prefix('products')->group(function () {
        Route::get('add', [ProductController::class, 'create'])->name('index');
        Route::post('add', [ProductController::class, 'store'])->name('insert');
        Route::get('list', [ProductController::class, 'index'])->name('list');
        Route::post('list', [ProductController::class, 'index']);
        Route::get('detail/{id}', [ProductController::class, 'show']);
        Route::get('edit/{id}', [ProductController::class, 'edit']);
        Route::post('edit/{id}', [ProductController::class, 'update']);
        Route::DELETE('delete', [ProductController::class, 'destroy']);
    });
    Route::prefix('categories')->group(function () {
        Route::get('add', [CategoryController::class, 'create']);
        Route::post('add', [CategoryController::class, 'store']);
        Route::get('list', [CategoryController::class, 'index']);
        Route::get('edit/{id}', [CategoryController::class, 'show']);
        Route::post('edit/{id}', [CategoryController::class, 'update']);
        Route::delete('delete', [CategoryController::class, 'destroy']);
    });
    Route::prefix('suppliers')->group(function () {
        Route::get('add', [SupplierController::class, 'create']);
        Route::post('add', [SupplierController::class, 'store']);
        Route::get('list', [SupplierController::class, 'index']);
        Route::get('edit/{id}', [SupplierController::class, 'show']);
        Route::post('edit/{id}', [SupplierController::class, 'update']);
        Route::delete('delete', [SupplierController::class, 'destroy']);
    });
    Route::prefix('customers')->group(function () {
        Route::get('add', [CustomerController::class, 'create']);
        Route::post('add', [CustomerController::class, 'store']);
        Route::get('list', [CustomerController::class, 'index']);
        Route::get('edit/{id}', [CustomerController::class, 'show']);
        Route::post('edit/{id}', [CustomerController::class, 'update']);
        Route::delete('delete', [CustomerController::class, 'destroy']);
    });
    Route::prefix('orders')->group(function () {
        Route::get('add', [OrderController::class, 'create']);
        Route::post('add', [OrderController::class, 'store']);
        Route::get('list', [OrderController::class, 'index']);
        Route::get('edit/{id}', [OrderController::class, 'show']);
        Route::post('edit/{id}', [OrderController::class, 'update']);
        Route::delete('delete', [OrderController::class, 'destroy']);
    });
    Route::prefix('employees')->group(function () {
        Route::get('add', [EmployeeController::class, 'create']);
        Route::post('add', [EmployeeController::class, 'store']);
        Route::get('list', [EmployeeController::class, 'index']);
        Route::get('edit/{id}', [EmployeeController::class, 'show']);
        Route::post('edit/{id}', [EmployeeController::class, 'update']);
        Route::delete('delete', [EmployeeController::class, 'destroy']);
    });
});
