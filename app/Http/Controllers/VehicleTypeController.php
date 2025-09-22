<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleTypeRequest;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiclesTypes = VehicleType::paginate(15);
        return view('admin.vehicle-type.index', compact('vehiclesTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicle-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            VehicleType::create($request->all());
            DB::commit();
            return redirect()->route('vehicle-type.index')->with('success', 'Tipo de vehículo creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-type.index')->with('error', 'Error al crear el tipo de vehículo');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleType $vehicleType)
    {
        return view('admin.vehicle-type.edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleTypeRequest $request, VehicleType $vehicleType)
    {
        DB::beginTransaction();
        try {
            $vehicleType->update($request->all());
            DB::commit();
            return redirect()->route('vehicle-type.index')->with('success', 'Tipo de vehículo actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-type.index')->with('error', 'Error al actualizar el tipo de vehículo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleType $vehicleType)
    {
        DB::beginTransaction();
        try {
            $vehicleType->delete();
            DB::commit();
            return redirect()->route('vehicle-type.index')->with('success', 'Tipo de vehículo eliminado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-type.index')->with('error', 'Error al eliminar el tipo de vehículo');
        }
    }
}
