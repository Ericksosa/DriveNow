<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionRequest;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspections = Inspection::paginate(15);
        return view('employee.inspection.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();
        $tireStatuses = config('constants.tire-statuses');
        $yesNo = config('constants.yes-no');
        $fuel_levels = config('constants.fuel_level');
        return view('employee.inspection.create', compact('vehicles', 'customers', 'tireStatuses', 'yesNo', 'fuel_levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InspectionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['employee_id'] = auth()->user()->id;
            Inspection::create($data);
            DB::commit();
            return redirect()->route('inspection.index')->with('success', 'Inspección creada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('inspection.index')->with('error', 'Error al crear la inspección');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspection $inspection)
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();
        $tireStatuses = config('constants.tire-statuses');
        $yesNo = config('constants.yes-no');
        $fuel_levels = config('constants.fuel_level');
        return view('employee.inspection.edit', compact('inspection', 'vehicles', 'customers', 'tireStatuses', 'yesNo', 'fuel_levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InspectionRequest $request, Inspection $inspection)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['employee_id'] = auth()->user()->id;
            $inspection->update($data);
            DB::commit();
            return redirect()->route('inspection.index')->with('success', 'Inspección actualizada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('inspection.index')->with('error', 'Error al actualizar la inspección');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        DB::beginTransaction();
        try {
            $inspection->delete();
            DB::commit();
            return redirect()->route('inspection.index')->with('success', 'Inspección eliminada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('inspection.index')->with('error', 'Error al eliminar la inspección');
        }
    }
}
