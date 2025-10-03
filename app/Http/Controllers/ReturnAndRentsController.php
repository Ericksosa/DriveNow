<?php

namespace App\Http\Controllers;

use App\Exports\RentsAndReturnsExport;
use App\Http\Requests\ReturnAndRentsRequest;
use App\Models\Customer;
use App\Models\ReturnsAndRents;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReturnAndRentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returnRents = ReturnsAndRents::paginate(15);
        return view('employee.return-rents.index', compact('returnRents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        $statuses = config('constants.returnRents-status');
        return view('employee.return-rents.create', compact('customers', 'vehicles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReturnAndRentsRequest $request)
    {
        DB::beginTransaction();
        try {
            // Agregar el employee_id basado en el usuario autenticado
            $data = $request->all();
            $data['employee_id'] = auth()->user()->id;

            ReturnsAndRents::create($data);

            DB::commit();
            return redirect()->route('return-and-rents.index')->with('success', 'Retorno creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('return-and-rents.index')->with('error', 'Error al crear el retorno');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnsAndRents $returnAndRent)
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        $statuses = config('constants.returnRents-status');
        return view('employee.return-rents.edit', compact('returnAndRent', 'customers', 'vehicles', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReturnAndRentsRequest $request, ReturnsAndRents $returnAndRent)
    {
        DB::beginTransaction();
        try {
            // Agregar el employee_id basado en el usuario autenticado
            $data = $request->all();
            $data['employee_id'] = auth()->user()->id;

            $returnAndRent->update($data);

            DB::commit();
            return redirect()->route('return-and-rents.index')->with('success', 'Retorno actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('return-and-rents.index')->with('error', 'Error al actualizar el retorno');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnsAndRents $returnAndRent)
    {
        DB::beginTransaction();
        try {
            $returnAndRent->delete();
            DB::commit();
            return redirect()->route('return-and-rents.index')->with('success', 'Retorno eliminado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('return-and-rents.index')->with('error', 'Error al eliminar el retorno');
        }
    }

    public function approve(string $id){
        DB::beginTransaction();
        try{
            ReturnsAndRents::where('id', $id)->update(['status' => 'Reservado',
            'employee_id' => auth()->user()->employee->id,
        ]);
            DB::commit();
            return redirect()->route('return-and-rents.index')->with('success', 'Retorno aprobado correctamente');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('return-and-rents.index')->with('error', 'Error al aprobar el retorno');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new RentsAndReturnsExport, 'return-and-rents.xlsx');
    }

    public function exportPdf()
    {
        $returnsAndRents = ReturnsAndRents::all();
        $pdf = Pdf::loadView('employee.return-rents.pdf.export-pdf', compact('returnsAndRents'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('ReturnAndRents.pdf');
    }
}
