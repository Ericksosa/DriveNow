<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeDashboardController;
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
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('administrador.dashboard');
    Route::get('brand/export-excel', [BrandController::class, 'exportExcel'])->name('brand.export');
    Route::get('brand/export-pdf', [BrandController::class, 'exportPdf'])->name('brand.export.pdf');
    Route::resource('brand', BrandController::class);
    Route::get('vehicle/export-excel', [VehicleController::class, 'exportExcel'])->name('vehicle.export');
    Route::get('vehicle/export-pdf', [VehicleController::class, 'exportPdf'])->name('vehicle.export.pdf');
    Route::resource('vehicle', VehicleController::class);
    Route::get('employee/export-excel', [EmployeeController::class, 'exportExcel'])->name('employee.export');
    Route::get('employee/export-pdf', [EmployeeController::class, 'exportPdf'])->name('employee.export.pdf');
    Route::resource('employee', EmployeeController::class);
    Route::get('vehicle-type/export-excel', [VehicleTypeController::class, 'exportExcel'])->name('vehicle-type.export');
    Route::get('vehicle-type/export-pdf', [VehicleTypeController::class, 'exportPdf'])->name('vehicle-type.export.pdf');
    Route::resource('vehicle-type', VehicleTypeController::class);
    Route::get('fuel-type/export-excel', [FuelTypeController::class, 'exportExcel'])->name('fuel-type.export');
    Route::get('fuel-type/export-pdf', [FuelTypeController::class, 'exportPdf'])->name('fuel-type.export.pdf');
    Route::resource('fuel-type', FuelTypeController::class);
    Route::get('vehicle-model/export-excel', [VehicleModelController::class, 'exportExcel'])->name('vehicle-model.export');
    Route::get('vehicle-model/export-pdf', [VehicleModelController::class, 'exportPdf'])->name('vehicle-model.export.pdf');
    Route::resource('vehicle-model', VehicleModelController::class);
    Route::get('customer/export-excel', [ClientController::class, 'exportExcel'])->name('customer.export');
    Route::get('customer/export-pdf', [ClientController::class, 'exportPdf'])->name('customer.export.pdf');
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
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('empleado.dashboard');
    Route::get('inspection/export-excel', [InspectionController::class, 'exportExcel'])->name('inspection.export');
    Route::get('inspection/export-pdf', [InspectionController::class, 'exportPdf'])->name('inspection.export.pdf');
    Route::resource('inspection', InspectionController::class);
    Route::get('return-and-rents/export-excel', [ReturnAndRentsController::class, 'exportExcel'])->name('return-and-rents.export');
    Route::get('return-and-rents/export-pdf', [ReturnAndRentsController::class, 'exportPdf'])->name('return-and-rents.export.pdf');
    Route::resource('return-and-rents', ReturnAndRentsController::class);
    Route::post('return-and-rents/approve/{id}', [ReturnAndRentsController::class, 'approve'])->name('return-and-rents.approve');
});
