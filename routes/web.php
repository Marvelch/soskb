<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IslandController;
use App\Http\Controllers\MarketingAreaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SubCustomerTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\general;
use App\Models\marketingArea;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;

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
    $agent = new Agent();

    if ($agent->isMobile()) {
        return view('welcome');
    } else {
        return view('admin.login');
    }
})->name('/');

Auth::routes();

Route::get('/logout',function() {
    Auth::logout();

    $agent = new Agent();

    if ($agent->isMobile()) {
        return redirect('/');
    } else {
        return view('admin.login');
    }
})->name('logout');

// Login with whatsapp url activation
Route::post('/login/with/whatsapp',[LoginController::class,'loginWithWhatsapp'])->name('login.with.whatsapp');
Route::get('verify-login/{token}',[LoginController::class, 'verifyLogin'])->name('verify-login');

Route::prefix('access')->group(function () {
    Route::get('/setup',[GeneralController::class,'setup'])->name('setup_general');
    Route::get('/error',[GeneralController::class,'error'])->name('error_general');
    Route::get('/error/mobile/',[GeneralController::class,'error_mobile'])->name('error_mobile');
    Route::get('/error/browser',[GeneralController::class,'error_browser'])->name('error_browser');
});

Route::prefix('home')->middleware('auth','authCheck')->group(function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
});

Route::prefix('products')->middleware('auth','authCheck')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('index_products');
});

Route::prefix('sales-order')->middleware('auth','authCheck')->group(function () {
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

Route::prefix('customers')->middleware('auth','authCheck')->group(function () {
    Route::get('/',[CustomerController::class,'index'])->name('index_customers');
    Route::get('/customer-close',[CustomerController::class,'customerClose'])->name('customer.close.orders');
});

Route::prefix('transaction')->middleware('auth','authCheck')->group(function () {
    Route::get('/on_progress',[TransactionController::class,'on_progress'])->name('on_progress_transaction');
    Route::get('/complete',[TransactionController::class,'complete'])->name('complete_transaction');
    Route::get('/canceled',[TransactionController::class,'canceled'])->name('canceled_transaction');

    Route::get('/show/{id}',[TransactionController::class,'show'])->name('show_transaction');
});

Route::prefix('profile')->middleware('auth','authCheck')->group(function () {
    Route::get('/',[ProfileController::class,'index'])->name('index_profile');
});

/*----------------------------------------- Private Access Group -----------------------------------------*/
Route::prefix('admin')->middleware('auth','authCheck')->group(function () {
    Route::prefix('access')->group(function () {
        // Route::get('/login',[LoginController::class,'login'])->name('private_login');
        Route::get('/home',[HomeController::class,'admin_home'])->name('admin.home');
    });

    Route::prefix('sales-orders')->group(function () {
        // Route::get('/login',[LoginController::class,'login'])->name('private_login');
        Route::get('/transactions',[SalesOrderController::class,'transaction_admin'])->name('admin.transaction');
        Route::get('/detail/{id}',[SalesOrderController::class,'transaction_detail'])->name('admin.detail.transaction');
        Route::put('/update/{id}',[SalesOrderController::class,'storeAdmin'])->name('admin.update.transaction');
        Route::get('/searching',[SalesOrderController::class,'searchingTransaction'])->name('admin.searching.transaction');
    });

    Route::prefix('products')->group(function () {
        Route::get('/',[ProductController::class,'index_product'])->name('admin.products.index');
        Route::get('/set-sales/{id}',[ProductController::class,'sales_products'])->name('admin.products.set.sales');
        Route::post('/store-sales-products/{id}',[ProductController::class,'storeSalesProducts'])->name('admin.store.sales.products');
        Route::get('/destroy/set-sales/{id}',[ProductController::class,'destroySalesProduct'])->name('admin.destroy.products.sales');

        ## Searching ##
        Route::get('/searching-products',[ProductController::class,'searchingProducts'])->name('admin.products.searching');
    });

    Route::prefix('customers')->group(function () {
        Route::get('/',[CustomerController::class,'index_customer'])->name('admin.customers.index');
        Route::get('/set-sales/{id}',[CustomerController::class,'sales_customer'])->name('admin.customers.set.sales');
        Route::post('/store-sales-customers/{id}',[CustomerController::class,'store_sales_customer'])->name('admin.store.sales.customer');
        Route::get('/create',[CustomerController::class,'create'])->name('admin.customers.create');
        Route::post('/store',[CustomerController::class,'store'])->name('admin.customers.store');
        Route::get('/edit/{id}',[CustomerController::class,'edit_admin'])->name('admin.customers.edit');
        Route::put('/update/{id}',[CustomerController::class,'update_admin'])->name('admin.customers.update');

        ## Searching ##
        Route::get('/searching-customers',[CustomerController::class,'searchingCustomers'])->name('admin.customers.searching');
        Route::get('/searching-sub-customers-type',[CustomerController::class,'searchingSubCustomersType'])->name('admin.sub.customers.type.searching');
        Route::get('/searching-region',[CustomerController::class,'searchingRegion'])->name('admin.region.searching');
        Route::get('/searching-city',[CustomerController::class,'searchingCity'])->name('admin.city.searching');
    });

    Route::prefix('generals')->group(function () {
        Route::get('/structure',[GeneralController::class,'structure'])->name('admin_structure_general');
        Route::post('/store-structure',[GeneralController::class,'store_structure'])->name('admin_store_structure_general');
    });

    Route::prefix('groups')->group(function () {
        Route::get('/group',[GroupController::class,'group'])->name('admin_group_general');
        Route::get('/group-searching-employee/{id}',[GroupController::class,'SearchingEmployee'])->name('admin_group_searching_employee_general');
        Route::post('/store',[GroupController::class,'store'])->name('admin.store.group');

        ## Searching ##
        Route::get('/searching',[GroupController::class,'SearchingChairman'])->name('admin.users.chairman.searching');
    });

    Route::prefix('users')->group(function () {
        Route::get('/',[UserController::class,'index'])->name('admin.users');
        Route::get('/edit/{id}',[UserController::class,'show'])->name('admin.users.edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('admin.users.update');

        ## Searching ##
        Route::get('/searching',[UserController::class,'searching_users_sales'])->name('admin.users.sales.searching');
        Route::get('/searching/sub-customer-type',[UserController::class,'searching_sub_customer_type'])->name('admin.users.sub.customers.searching');
    });

    Route::prefix('marketing-area')->group(function () {
        Route::get('/delete/{id}',[MarketingAreaController::class,'destroy'])->name('admin.marketing.area.destroy');
    });

    ## General Access Searching ##
    Route::get('/searching-island',[IslandController::class,'searchIsland'])->name('admin.searching.island.searching');
    Route::get('/searching-region',[RegionController::class,'searchRegion'])->name('admin.searching.region.searching');
    Route::get('/searching-city',[CityController::class,'searchCity'])->name('admin.searching.city.searching');

    Route::get('/searching-sub-customer-group',[SubCustomerTypeController::class,'searchSubCustomerGroup'])->name('admin.searching.sub.customer.group.searching');
});
