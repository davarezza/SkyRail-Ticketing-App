<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\TransportationController;
use App\Http\Controllers\Master\TransportTypeController;
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
        Route::post('get-data-select', [TransportationController::class, 'getDataSelect'])->name('master.transportation.get-data-select');
    });

    Route::prefix('/transport-type')->group(function () {
        Route::post('table', [TransportTypeController::class, 'table'])->name('transport-type.table');
        // Route::post('table-job', [TransportTypeController::class, 'tableJob'])->name('transport-type.tableJob');
        Route::post('store', [TransportTypeController::class, 'store'])->name('transport-type.store');
        Route::post('edit', [TransportTypeController::class, 'edit'])->name('transport-type.edit');
        Route::post('update', [TransportTypeController::class, 'update'])->name('transport-type.update');
        Route::post('delete', [TransportTypeController::class, 'delete'])->name('transport-type.delete');
        // Route::post('get-data', [TransportTypeController::class, 'getData'])->name('transport-type.get-data');
    });
});