<?php

use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReturnAndRentsController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleTypeController;
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

Route::get('/', [ClientController::class, 'loadPremiumVehicles'])->name('index');

Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Administrador'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('administrador.dashboard');
    Route::resource('brand', BrandController::class);
    Route::resource('vehicle', VehicleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('vehicle-type', VehicleTypeController::class);
    Route::resource('fuel-type', FuelTypeController::class);
    Route::resource('vehicle-model', VehicleModelController::class);
    Route::resource('customer', ClientController::class);
});
Route::prefix('client')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Cliente'
])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'loadPremiumVehicles'])->name('cliente.dashboard');
    Route::get('/vehicles-show', [ClientController::class, 'showVehicles'])->name('vehicles-show-rent');
    Route::get('/load-vehicles', [ClientController::class, 'loadVehicles'])->name('load-vehicles');
    Route::get('/my-reservations', [ReservationController::class, 'showReservations'])->name('showReservations');
    Route::post('/store-reservation', [ReservationController::class, 'storeReservation'])->name('storeReservation');
    Route::post('/store-rating', [ReservationController::class, 'storeRating'])->name('my-reservations.store-rating');
    Route::post('/reservations/{id}/finalize', [ReservationController::class, 'finalize'])->name('reservations.finalize');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('/reservations/show/{id}', [ReservationController::class, 'showVehicleReservation'])->name('reservations.show');
});
Route::prefix('employee')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Empleado'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('employee.dashboard');
    })->name('empleado.dashboard');
    Route::resource('inspection', InspectionController::class);
    Route::resource('return-and-rents', ReturnAndRentsController::class);
    Route::post('return-and-rents/approve/{id}', [ReturnAndRentsController::class, 'approve'])->name('return-and-rents.approve');
});
