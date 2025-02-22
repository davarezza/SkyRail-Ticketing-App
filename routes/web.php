<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\BookingPassengerController;
use App\Http\Controllers\Management\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\Master\DestinationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Management\ManageBookingController;
use App\Http\Controllers\Management\ProfileController;
use App\Http\Controllers\Master\OfficerController;
use App\Http\Controllers\Master\PassengerController;
use App\Http\Controllers\Master\TransportationController;
use App\Http\Controllers\Master\TransportClassController;
use App\Http\Controllers\Master\TransportTypeController;
use App\Http\Controllers\Master\TravelRouteController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.authenticate');

    Route::get('register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.authenticate');

    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');

Route::prefix('dashboard')->group(function () {
    Route::get('/revenue-data', [DashboardController::class, 'getRevenueLast12Months']);
    Route::get('/ticket-sales', [DashboardController::class, 'getTicketSalesPerRoute']);
    Route::get('/ticket-class', [DashboardController::class, 'getTicketClassDistribution']);
    Route::get('/passenger-age', [DashboardController::class, 'getPassengerAgeDistribution']);
});

Route::prefix('booking')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.page');
    Route::get('{id}/detail', [BookingController::class, 'detail'])->name('booking.detail');
    Route::get('payment/{id}', [BookingController::class, 'payment'])->name('booking.payment');
    Route::get('success-payment/{id}', [BookingController::class, 'successPayment'])->name('booking.success-payment');
    Route::get('detail-facilities/{id}', [BookingController::class, 'detailFacilities'])->name('master.transportation.detail-facilities');
    Route::post('/first-booking', [BookingController::class, 'firstBooking'])->name('booking.first-booking')->middleware('auth');
    Route::post('/second-booking', [BookingController::class, 'secondBooking'])->name('booking.second-booking')->middleware('auth');
    Route::post('/third-booking', [BookingController::class, 'thirdBooking'])->name('booking.third-booking')->middleware('auth');
    Route::post('/fourth-booking', [BookingController::class, 'fourthBooking'])->name('booking.fourth-booking')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard-user.index');
        Route::get('/booking-history', [BookingHistoryController::class, 'index'])->name('booking-history.index');
    });
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

        Route::prefix('/transport-class')->group(function () {
            Route::get('/', [TransportClassController::class, 'index'])->name('master.transport-class.index');
            Route::post('table', [TransportClassController::class, 'table'])->name('master.transport-class.table');
            Route::post('store', [TransportClassController::class, 'store'])->name('master.transport-class.store');
            Route::post('delete', [TransportClassController::class, 'delete'])->name('master.transport-class.delete');
            Route::post('edit', [TransportClassController::class, 'edit'])->name('master.transport-class.edit');
            Route::post('update', [TransportClassController::class, 'update'])->name('master.transport-class.update');
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

        Route::prefix('/destination')->group(function () {
            Route::get('/', [DestinationController::class, 'index'])->name('master.destination.index');
            Route::post('table', [DestinationController::class, 'table'])->name('master.destination.table');
            Route::post('store', [DestinationController::class, 'store'])->name('master.destination.store');
            Route::post('delete', [DestinationController::class, 'delete'])->name('master.destination.delete');
            Route::post('edit', [DestinationController::class, 'edit'])->name('master.destination.edit');
            Route::post('update', [DestinationController::class, 'update'])->name('master.destination.update');
            Route::get('detail/{id}', [DestinationController::class, 'detail'])->name('master.destination.detail');
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

        Route::prefix('/passenger')->group(function () {
            Route::get('/', [PassengerController::class, 'index'])->name('master.passenger.index');
            Route::post('table', [PassengerController::class, 'table'])->name('master.passenger.table');
            Route::post('delete', [PassengerController::class, 'delete'])->name('master.passenger.delete');
            Route::get('detail/{id}', [PassengerController::class, 'detail'])->name('master.passenger.detail');
            Route::post('get-data-login', [PassengerController::class, 'getDataLogin'])->name('passenger.get-data-login');
            Route::post('save-data-profile', [PassengerController::class, 'saveDataProfile'])->name('passenger.save-data-profile');
        });
    });

    Route::prefix('management')->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('management.role.index');
            Route::post('/table', [RoleController::class, 'table'])->name('management.role.table');
            Route::post('/store', [RoleController::class, 'store'])->name('management.role.store');
            Route::post('/delete', [RoleController::class, 'delete'])->name('management.role.delete');
            Route::post('edit', [RoleController::class, 'edit'])->name('management.role.edit');
            Route::post('update', [RoleController::class, 'update'])->name('management.role.update');
        });

        Route::prefix('profile')->middleware('permission:Access Profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('management.profile.index');
            Route::patch('/update', [ProfileController::class, 'update'])->name('management.profile.update');
            Route::patch('/change-image', [ProfileController::class, 'changeImage'])->name('management.profile.changeImage');
            Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('management.profile.changePassword');
        });

        Route::prefix('manage-booking')->group(function () {
            Route::get('/', [ManageBookingController::class, 'index'])->name('management.manage-booking.index');
            Route::post('/table', [ManageBookingController::class, 'table'])->name('management.manage-booking.table');
            Route::post('/store', [ManageBookingController::class, 'store'])->name('management.manage-booking.store');
            Route::post('/delete', [ManageBookingController::class, 'delete'])->name('management.manage-booking.delete');
            Route::post('edit', [ManageBookingController::class, 'edit'])->name('management.manage-booking.edit');
            Route::post('update', [ManageBookingController::class, 'update'])->name('management.manage-booking.update');
            Route::get('/detail/{id}', [ManageBookingController::class, 'detail'])->name('management.manage-booking.detail');
            Route::post('verify', [ManageBookingController::class, 'verify'])->name('management.manage-booking.verify');
            Route::post('/export-excel', [ManageBookingController::class, 'exportToExcel'])->name('management.manage-booking.export-excel');
        });
    });

    Route::prefix('booking-passenger')->group(function () {
        Route::get('/{id}', [BookingPassengerController::class, 'detail'])->name('booking-passenger.detail');
        Route::get('/select-seat/{id}', [BookingPassengerController::class, 'bookingSeat'])->name('booking-passenger.booking-seat');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/get-permission/{id}', [RoleController::class, 'getPermission'])->name('get-permission');
Route::post('/{role}/store-permission', [RoleController::class, 'storePermission'])->name('management.role.store-permission');
