<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout',function() {
    Auth::logout(); // Logout the currently authenticated user
    return redirect('/');
})->name('logout');

Route::get('setup',function() {
    return view('setup');
})->name('setup');

Route::prefix('products')->middleware('auth')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('index_products');
});

Route::prefix('sales-order')->middleware('auth')->group(function () {
    Route::get('/',[SalesOrderController::class,'index'])->name('index_sales_orders');
    Route::get('/customer',[SalesOrderController::class,'customer'])->name('index_sales_orders_customer');
    Route::get('/product',[SalesOrderController::class,'product'])->name('index_sales_orders_product');
    Route::post('/store',[SalesOrderController::class,'store'])->name('store_sales_orders');
    Route::get('/transaction',[SalesOrderController::class,'transaction'])->name('transaction_sales_orders');

    ## Searching ##
    Route::get('/search/customers',[SalesOrderController::class,'searchCustomers'])->name('searching_customer');
    Route::get('/search/products',[SalesOrderController::class,'searchProducts'])->name('searching_product');

    ## Temp ##
    Route::post('/customer-temp',[SalesOrderController::class,'storeTemp'])->name('store_customer_sales_orders');
    Route::post('/products-temp',[SalesOrderController::class,'storeProductTemp'])->name('store_product_sales_orders');
});

Route::prefix('customers')->middleware('auth')->group(function () {
    Route::get('/',[CustomerController::class,'index'])->name('index_customers');
});

Route::prefix('transaction')->middleware('auth')->group(function () {
    Route::get('/on_progress',[TransactionController::class,'on_progress'])->name('on_progress_transaction');
    Route::get('/complete',[TransactionController::class,'complete'])->name('complete_transaction');
    Route::get('/canceled',[TransactionController::class,'canceled'])->name('canceled_transaction');

    Route::get('/show/{id}',[TransactionController::class,'show'])->name('show_transaction');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/',[ProfileController::class,'index'])->name('index_profile');
});
