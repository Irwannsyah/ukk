<?php

use App\Http\Controllers\admin\AdminController as AdminAdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\DestinationController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Models\destination;
use App\Models\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



    Route::get('admin', [AuthController::class, 'login'])->name('admin_login');
    Route::post('admin', [AuthController::class, 'admin_auth_login'])->name('admin_auth_login');


Route::middleware('admin')->group(function() {

    Route::as('admin.')->group(function() {
        Route::get('admin/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('admin/user/list', [UserController::class, 'list'])->name('list');
        Route::get('admin/user/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::as('category.')->group(function() {
        Route::get('admin/category/list', [CategoryController::class, 'list'])->name('list');
        Route::get('admin/category/add', [CategoryController::class, 'add'])->name('add');
        Route::post('admin/category/add', [CategoryController::class, 'insert'])->name('insert');
        Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('admin/category/edit/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::as('destination.')->group(function(){
        Route::get('admin/destination/list', [DestinationController::class, 'list'])->name('list');
        Route::get('admin/destination/add', [DestinationController::class, 'add'])->name('add');
        Route::post('admin/destination/add', [DestinationController::class, 'insert'])->name('insert');
        Route::get('admin/destination/edit/{id}', [DestinationController::class, 'edit'])->name('edit');
        Route::post('admin/destination/edit/{id}', [DestinationController::class, 'update'])->name('update');
        Route::get('admin/destination/delete/{id}', [DestinationController::class, 'delete'])->name('delete');
        Route::get('admin/destination/view/{id}', [DestinationController::class, 'view'])->name('view');
    });

    Route::as('banner.')->group(function(){
        Route::get('admin/banner/list', [BannerController::class, 'list'])->name('list');
        Route::get('admin/banner/add', [BannerController::class, 'add'])->name('add');
        Route::post('admin/banner/add', [BannerController::class, 'insert'])->name('insert');
        Route::get('admin/banner/edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::post('admin/banner/edit/{id}', [BannerController::class, 'update'])->name('update');
        Route::get('admin/banner/delete/{id}', [BannerController::class, 'delete'])->name('delete');
    });

    Route::as('brand.')->group(function(){
        Route::get('admin/brand/list', [BrandController::class, 'list'])->name('list');
        Route::get('admin/brand/add', [BrandController::class, 'add'])->name('add');
        Route::post('admin/brand/add', [BrandController::class, 'insert'])->name('insert');
        Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('admin/brand/edit/{id}', [BrandController::class, 'update'])->name('update');
        Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('delete');
    });
});

Route::get('pdf/view/{transaction_id}', [PDFController::class, 'index']);

Route::as('user.')->group(function(){
    Route::get('/', [HomepageController::class, 'dashboard'])->name('dashbaord');

    Route::get('login', [AuthUserController::class, 'login'])->name('login');
    Route::post('login', [AuthUserController::class, 'login_user'])->name('login_user');

    Route::get('register', [AuthUserController::class, 'register'])->name('register');
    Route::post('register', [AuthUserController::class, 'register_user'])->name('register_user');

    Route::post('logout', [AuthUserController::class, 'logout_user'])->name('logout');

    Route::get('detail/{id}', [HomepageController::class, 'detail'])->name('detail');
    Route::post('detail/{id}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('category/{id}', [HomepageController::class, 'category'])->name('category');


    Route::middleware(['user'])->group(function(){
        // Route::get('checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
        // Route::post('checkout/{id}', [PaymentController::class, 'checkoutInsert'])->name('checkoutInsert');
        Route::get('payment', [PaymentController::class, 'showPayment'])->name('showPayment');
        Route::post('payment',  [PaymentController::class, 'payment_post'])->name('paymentpost');

        Route::as('profile')->group(function(){
            Route::get('profile/user', [ProfileController::class, 'profile'])->name('profile');
            Route::get('profile/riwayatorder', [ProfileController::class, 'riwayat'])->name('riwayat');
        });
    });

});
