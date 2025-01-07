<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\TransportationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

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
    });
});