<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelTypeRequest;
use App\Models\FuelType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuelTypes = FuelType::paginate(15);
        return view('admin.fuel-type.index', compact('fuelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fuel-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FuelTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            FuelType::create($request->all());
            DB::commit();
            return redirect()->route('fuel-type.index')->with('success', 'Tipo de combustible creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('fuel-type.index')->with('error', 'Error al crear el tipo de combustible');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelType $fuelType)
    {
        return view('admin.fuel-type.edit', compact('fuelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelType $fuelType)
    {
        DB::beginTransaction();
        try {
            $fuelType->update($request->all());
            DB::commit();
            return redirect()->route('fuel-type.index')->with('success', 'Tipo de combustible actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('fuel-type.index')->with('error', 'Error al actualizar el tipo de combustible');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelType $fuelType)
    {
        try {
            $fuelType->delete();
            return redirect()->route('fuel-type.index')->with('success', 'Tipo de combustible eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('fuel-type.index')->with('error', 'Error al eliminar el tipo de combustible');
        }
    }
}
