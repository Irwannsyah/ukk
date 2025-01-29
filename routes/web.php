<?php

use App\Http\Controllers\admin\AdminController as AdminAdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\DestinationController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

    Route::get('admin', [AuthController::class, 'login'])->name('admin_login');
    Route::get('register', [AuthController::class, 'register'])->name('admin_register');

    Route::post('admin', [AuthController::class, 'admin_auth_login'])->name('admin_auth_login');
    Route::post('register', [AuthController::class, 'admin_auth_register'])->name('admin_auth_register');


Route::group(['middleware' => 'adminCheck'], function() {

    Route::as('admin.')->group(function() {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('admin/user/list', [UserController::class, 'list'])->name('list');
        Route::get('admin/user/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
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
    });
});
