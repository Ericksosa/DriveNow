<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index(){
        return view('admin.client.index');
    }
    public function create(){
        $genders = config('constants.sex');
        $people_type = config('constants.people_type');
        return view('admin.client.create', compact('people_type', 'genders'));
    }
    public function edit(Customer $customer){
        $genders = config('constants.sex');
        $people_type = config('constants.people_type');
        return view('admin.client.edit', compact('people_type', 'genders', 'customer'));
    }
    public function store(CustomerRequest $request)
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
            Customer::create([
                'id_card_number' => $request->id_card_number,
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'person_type' => $request->person_type,
                'credit_card_number' => $request->credit_card_number,
                'credit_limit' => $request->credit_limit,
                'driver_license_number' => $request->driver_license_number,
                'driver_license_expiration_date' => $request->driver_license_expiration_date,
            ]);
            $user->assignRole('Cliente');
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Cliente creado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error', 'Error al crear el cliente');
        }
    }
    public function update(CustomerRequest $request, Customer $customer)
    {
        DB::beginTransaction();
        try {
            // Actualizar el usuario relacionado
            $user = User::findOrFail($customer->user_id);
            $user->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt("12345678"), // Considera permitir al usuario cambiar su contraseña
                'gender' => $request->gender,
            ]);

            // Actualizar el empleado
            $customer->update([
                'id_card_number' => $request->id_card_number,
                'phone_number' => $request->phone_number,
                'person_type' => $request->person_type,
                'credit_card_number' => $request->credit_card_number,
                'credit_limit' => $request->credit_limit,
                'driver_license_number' => $request->driver_license_number,
                'driver_license_expiration_date' => $request->driver_license_expiration_date,
            ]);

            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Empleado actualizado correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error', 'Error al actualizar el empleado');
        }
    }
    public function destroy(){

    }

    public function loadPremiumVehicles()
    {
        $premiumVehicles = Vehicle::where('category', 'Lujo')
            ->take(3)
            ->get()
            ->map(function ($vehicle) {
                $vehicle->rating = $vehicle->ratings()
                    ->selectRaw('ROUND(AVG(rating), 1) as average_rating')
                    ->value('average_rating') ?? "N/A"; // Si no hay ratings, asignar 0
                return $vehicle;
            });

        return view('welcome', compact('premiumVehicles'));
    }
    public function showVehicles()
    {
        $loadVehiclesBrands = $this->loadVehicleBrands();
        $loadVehiclesCategories = $this->loadVehicleCategories();
        return view('vehicles-show-rent', compact('loadVehiclesBrands', 'loadVehiclesCategories'));
    }

    public function loadVehicles()
    {
        $vehicles = Vehicle::with(['vehicleModel', 'fuelType', 'media']) // Cargar relaciones necesarias
            ->get()
            ->map(function ($vehicle) {
                $isAvailable = !$vehicle->returnsAndRents()
                    ->whereIn('status', ['Reservado', 'Pendiente de aprobación'])
                    ->exists(); // Verificar si hay una renta con estado "Reservado" o "En mantenimiento"

                return [
                    'id' => $vehicle->id,
                    'name' => $vehicle->name,
                    'brand' => $vehicle->vehicleModel->brand->name, // Relación con la marca
                    'category' => $vehicle->category,
                    'price' => $vehicle->amount_per_day,
                    'rating' => $vehicle->ratings()
                        ->selectRaw('ROUND(AVG(rating), 1) as average_rating')
                        ->value('average_rating'),
                    'image' => $vehicle->getFirstMediaUrl('vehicle_images', 'thumb') ?: 'N/A', // Usar Spatie Media Library
                    'features' => [
                        $vehicle->transmission, // Transmisión
                        "{$vehicle->number_of_seats} asientos", // Número de asientos
                        $vehicle->fuelType->name, // Tipo de combustible
                        $vehicle->color, // Color
                    ],
                    'status' => $isAvailable, // true si está disponible, false si no
                ];
            });

        return response()->json($vehicles);
    }

    private function loadVehicleBrands()
    {
        // Accede a la tabla de vehículos y agrupa por marca a través de vehicle_model_id
        $brands = Vehicle::join('vehicle_model', 'vehicles.vehicle_model_id', '=', 'vehicle_model.id')
            ->join('brands', 'vehicle_model.brand_id', '=', 'brands.id')
            ->select('brands.name as brand', DB::raw('COUNT(vehicles.id) as amount'))
            ->groupBy('brands.name')
            ->orderBy('amount', 'desc') // Opcional: Ordenar por cantidad en orden descendente
            ->get();

        // Devuelve las marcas con sus cantidades
        return $brands;
    }

    private function loadVehicleCategories()
    {
        $categories = Vehicle::select('category', DB::raw('COUNT(vehicles.id) as amount'))
            ->groupBy('category')
            ->orderBy('amount', 'desc')
            ->get();
        return $categories;
    }
    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }

    public function exportPdf()
    {
        $customers = Customer::all();
        $pdf = Pdf::loadView('admin.client.pdf.export-pdf', compact('customers'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('Customers.pdf');
    }
}
