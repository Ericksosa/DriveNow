<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(15);
        return view('admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = config('constants.sex');
        $shifts = config('constants.shifts');
        return view('admin.employee.create', compact('genders', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt("12345678"),
                'gender' => $request->gender,
            ]);
            Employee::create([
                'id_card_number' => $request->id_card_number,
                'user_id' => $user->id,
                'shift' => $request->shift,
                'commission_percentage' => $request->commission_percentage,
                'entry_date' => $request->entry_date
            ]);
            $user->assignRole('Empleado');
            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Empleado creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('employee.index')->with('error', 'Error al crear el empleado');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $genders = config('constants.sex');
        $shifts = config('constants.shifts');
        return view('admin.employee.edit', compact('employee', 'genders', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();
        try {
            // Actualizar el usuario relacionado
            $user = User::findOrFail($employee->user_id);
            $user->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt("12345678"), // Considera permitir al usuario cambiar su contraseña
                'gender' => $request->gender,
            ]);

            // Actualizar el empleado
            $employee->update([
                'id_card_number' => $request->id_card_number,
                'shift' => $request->shift,
                'commission_percentage' => $request->commission_percentage,
                'entry_date' => $request->entry_date,
            ]);

            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Empleado actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('employee.index')->with('error', 'Error al actualizar el empleado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            // Eliminar el usuario relacionado
            $user = User::findOrFail($employee->user_id);
            $user->delete(); // Esto elimina el usuario relacionado

            // Eliminar el empleado (soft delete)
            $employee->delete();

            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Empleado y usuario eliminado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('employee.index')->with('error', 'Error al eliminar el empleado y su usuario.');
        }
    }
}
