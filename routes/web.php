<?php

use App\Http\Controllers\admin\AdminController as AdminAdminController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
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
        Route::get('admin/user/list', [AdminAdminController::class, 'list'])->name('list');
        Route::get('admin/admin/delete/{id}', [AdminAdminController::class, 'delete'])->name('delete');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
