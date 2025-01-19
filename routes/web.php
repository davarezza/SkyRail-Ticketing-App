<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Master\OfficerController;
use App\Http\Controllers\Master\TransportationController;
use App\Http\Controllers\Master\TransportTypeController;
use App\Http\Controllers\Master\TravelRouteController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.store');

    Route::get('register', [AuthController::class, 'registerPage'])->name('register');
});

Route::get('/', [MainController::class, 'home'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('master')->group(function () {
    Route::prefix('/transportation')->group(function () {
        Route::get('/', [TransportationController::class, 'index'])->name('master.transportation.index');
        Route::post('table', [TransportationController::class, 'table'])->name('master.transportation.table');
        Route::post('store', [TransportationController::class, 'store'])->name('master.transportation.store');
        Route::post('delete', [TransportationController::class, 'delete'])->name('master.transportation.delete');
        Route::post('edit', [TransportationController::class, 'edit'])->name('master.transportation.edit');
        Route::post('update', [TransportationController::class, 'update'])->name('master.transportation.update');
        Route::get('detail/{id}', [TransportationController::class, 'detail'])->name('master.transportation.detail');
        Route::post('get-data-select', [TransportationController::class, 'getDataSelect'])->name('master.transportation.get-data-select');
    });

    Route::prefix('/transport-type')->group(function () {
        Route::post('table', [TransportTypeController::class, 'table'])->name('transport-type.table');
        Route::post('store', [TransportTypeController::class, 'store'])->name('transport-type.store');
        Route::post('edit', [TransportTypeController::class, 'edit'])->name('transport-type.edit');
        Route::post('update', [TransportTypeController::class, 'update'])->name('transport-type.update');
        Route::post('delete', [TransportTypeController::class, 'delete'])->name('transport-type.delete');
        Route::get('detail/{id}', [TransportTypeController::class, 'detail'])->name('master.transport-type.detail');
    });

    Route::prefix('/travel-route')->group(function () {
        Route::get('/', [TravelRouteController::class, 'index'])->name('master.travel-route.index');
        Route::post('table', [TravelRouteController::class, 'table'])->name('master.travel-route.table');
        Route::post('store', [TravelRouteController::class, 'store'])->name('master.travel-route.store');
        Route::post('delete', [TravelRouteController::class, 'delete'])->name('master.travel-route.delete');
        Route::post('edit', [TravelRouteController::class, 'edit'])->name('master.travel-route.edit');
        Route::post('update', [TravelRouteController::class, 'update'])->name('master.travel-route.update');
        Route::get('detail/{id}', [TravelRouteController::class, 'detail'])->name('master.travel-route.detail');
        Route::post('get-data-select', [TravelRouteController::class, 'getDataSelect'])->name('master.travel-route.get-data-select');
    });

    Route::prefix('/officer')->group(function () {
        Route::get('/', [OfficerController::class, 'index'])->name('master.officer.index');
        Route::post('table', [OfficerController::class, 'table'])->name('master.officer.table');
        Route::post('store', [OfficerController::class, 'store'])->name('master.officer.store');
        Route::post('delete', [OfficerController::class, 'delete'])->name('master.officer.delete');
        Route::post('edit', [OfficerController::class, 'edit'])->name('master.officer.edit');
        Route::post('update', [OfficerController::class, 'update'])->name('master.officer.update');
        Route::get('detail/{id}', [OfficerController::class, 'detail'])->name('master.officer.detail');
        Route::post('get-data-select', [OfficerController::class, 'getDataSelect'])->name('master.officer.get-data-select');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});