<?php

use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InspectionController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

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
});
Route::prefix('client')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Cliente'
])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('cliente.dashboard');
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
});
