<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderInputController;
use App\Http\Controllers\OrderOutputController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;

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
Route::get('403', function () {
    return view('admin.403');
})->name('403');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin.access'])->group(function () {

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
            Route::delete('delete', [ProductController::class, 'destroy']);
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
        Route::prefix('orders-input')->group(function () {
            Route::get('add', [OrderInputController::class, 'create']);
            Route::post('add', [OrderInputController::class, 'store']);
            Route::get('list', [OrderInputController::class, 'index']);
            Route::get('edit/{id}', [OrderInputController::class, 'show']);
            Route::post('edit/{id}', [OrderInputController::class, 'update']);
            Route::delete('delete', [OrderInputController::class, 'destroy']);
        });
        Route::prefix('orders-output')->group(function () {
            Route::get('add', [OrderOutputController::class, 'create']);
            Route::post('add', [OrderOutputController::class, 'store']);
            Route::get('list', [OrderOutputController::class, 'index']);
            Route::get('edit/{id}', [OrderOutputController::class, 'show']);
            Route::post('edit/{id}', [OrderOutputController::class, 'update']);
            Route::delete('delete', [OrderOutputController::class, 'destroy']);
        });
        Route::prefix('employees')->group(function () {
            Route::get('add', [EmployeeController::class, 'create']);
            Route::post('add', [EmployeeController::class, 'store']);
            Route::get('list', [EmployeeController::class, 'index']);
            Route::get('edit/{id}', [EmployeeController::class, 'show']);
            Route::post('edit/{id}', [EmployeeController::class, 'update']);
            Route::delete('delete', [EmployeeController::class, 'destroy']);
        });
        Route::prefix('users')->group(function () {
            Route::get('list', [UserController::class, 'index']);
            Route::get('edit/{id}', [UserController::class, 'edit']);
            Route::post('edit/{id}', [UserController::class, 'update']);
        });
        Route::prefix('report')->group(function () {
            Route::get('profit-stats', [ReportController::class, 'ProfitStats']);
            Route::get('month-stats', [ReportController::class, 'MonthStats']);
            Route::get('quarter-stats', [ReportController::class, 'QuarterStats']);
            Route::get('product-stats', [ReportController::class, 'CateStats']);
            Route::post('product-stats', [ReportController::class, 'CateStats']);
        });

        Route::get('export-product', [ExportController::class, 'export_product'])->name('export');
        Route::post('import-product', [ImportController::class, 'import_product'])->name('import');
    });
});

Route::get('/forgot-password', [LoginController::class, 'getEmail']);
Route::post('/forgot-password', [LoginController::class, 'postEmail']);
Route::get('/reset-password/{token}', [LoginController::class, 'getPassword']);
Route::post('/reset-password', [LoginController::class, 'updatePassword']);
Route::get('register', [RegistrationController::class, 'create']);
Route::post('register', [RegistrationController::class, 'store']);
Route::get('register/verify/{code}', [RegistrationController::class, 'verify']);

