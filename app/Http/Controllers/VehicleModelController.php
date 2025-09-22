<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleModelRequest;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleModels = VehicleModel::paginate(15);
        return view('admin.vehicle-model.index', compact('vehicleModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.vehicle-model.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleModelRequest $request)
    {
        DB::beginTransaction();
        try {
            VehicleModel::create($request->all());
            DB::commit();
            return redirect()->route('vehicle-model.index')->with('success', 'Modelo creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-model.index')->with('error', 'Error al crear el modelo');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleModel $vehicleModel)
    {
        $brands = Brand::all();
        return view('admin.vehicle-model.edit', compact('brands', 'vehicleModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleModelRequest $request, VehicleModel $vehicleModel)
    {
        DB::beginTransaction();
        try {
            $vehicleModel->update($request->all());
            DB::commit();
            return redirect()->route('vehicle-model.index')->with('success', 'Modelo actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-model.index')->with('error', 'Error al actualizar el modelo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        DB::beginTransaction();
        try {
            $vehicleModel->delete();
            DB::commit();
            return redirect()->route('vehicle-model.index')->with('success', 'Modelo eliminado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vehicle-model.index')->with('error', 'Error al eliminar el modelo');
        }
    }
}
