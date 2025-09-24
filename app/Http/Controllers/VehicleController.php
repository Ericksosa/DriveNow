<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\FuelType;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(15);
        return view('admin.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $fuelTypes = FuelType::all();
        $vehicleModels = VehicleModel::all();
        $categories = config('constants.categories');
        $transmissions = config('constants.transmissions');
        $statuses = config('constants.vehicle-status');
        return view('admin.vehicle.create', compact('vehicleTypes', 'fuelTypes', 'vehicleModels', 'statuses','categories','transmissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        DB::beginTransaction();
        try {
            // Crear el vehículo sin incluir la imagen
            $vehicle = Vehicle::create($request->except('vehicle_image'));

            // Verificar si se subió una imagen
            $vehicle->addMedia($request->file('vehicle_image'))
                ->toMediaCollection('vehicle_images');


            DB::commit();
            return redirect()->route('vehicle.index')->with('success', 'Vehículo creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle.index')->with('error', 'Error al crear el vehículo');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicleTypes = VehicleType::all();
        $fuelTypes = FuelType::all();
        $vehicleModels = VehicleModel::all();
        $statuses = config('constants.vehicle-status');
        return view('admin.vehicle.edit', compact('vehicle', 'vehicleTypes', 'fuelTypes', 'vehicleModels', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        DB::beginTransaction();
        try {
            // Si el usuario marcó que desea eliminar la imagen
            if ($request->remove_image == '1') {
                $vehicle->clearMediaCollection('vehicle_images');
            }

            // Si se subió una nueva imagen
            if ($request->hasFile('vehicle_image')) {
                $vehicle->addMedia($request->file('vehicle_image'))->toMediaCollection('vehicle_images');
            }

            // Actualizar otros campos del vehículo
            $vehicle->update($request->except('vehicle_image', 'remove_image'));

            DB::commit();
            return redirect()->route('vehicle.index')->with('success', 'Vehículo actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle.index')->with('error', 'Error al actualizar el vehículo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        DB::beginTransaction();
        try {
            $vehicle->delete();
            DB::commit();
            return redirect()->route('vehicle.index')->with('success', 'Vehículo eliminado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle.index')->with('error', 'Error al eliminar el vehículo');
        }
    }
}
