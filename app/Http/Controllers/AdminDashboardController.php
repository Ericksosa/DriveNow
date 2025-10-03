<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inspection;
use App\Models\ReturnsAndRents;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalCustomers = Customer::count();
        $totalEmployees = Employee::count();
        $totalRevenue = ReturnsAndRents::sum('total_amount');
        $availableVehicles = $this->getAvailableVehicles();
        $rentedVehicles = $this->getRentedVehicles();
        $newCustomersThisMonth = $this->getNewCustomers();
        $monthlyRevenue = $this->getMonthlyRevenue();
        $totalInspections = Inspection::count();
        $totalBrands = Brand::count();
        $totalModels = VehicleModel::count();
        $pendingApproval = $this->getPendingApprovalVehicles();
        $outOfServiceVehicles = $this->getOutOfServiceVehicles();
        $completedRentsThisMonth = $this->getMonthlyRentedVehicles();
        $todayRevenue = $this->getTodayRevenue();
        $averageRentAmount = $this->getAverageRevenue();
        $yearlyRevenue = $this->getYearlyRevenue();
        $recentRents = ReturnsAndRents::orderBy('created_at', 'desc')->limit(5)->get();
        $topVehicles = $this->getTopRents();
        $topCustomers = $this->getTopCustomers();
        return view('admin.dashboard', compact('totalVehicles', 'totalCustomers', 'totalEmployees', 'totalRevenue', 'availableVehicles', 'rentedVehicles', 'newCustomersThisMonth', 'monthlyRevenue', 'totalInspections', 'totalBrands', 'totalModels', 'pendingApproval', 'outOfServiceVehicles', 'completedRentsThisMonth', 'todayRevenue', 'averageRentAmount', 'yearlyRevenue', 'recentRents', 'topVehicles','topCustomers'));
    }
    private function getAvailableVehicles()
    {
        $vehicles = Vehicle::whereDoesntHave('returnsAndRents', function ($query) {
            $query->whereIn('status', ['Pendiente de aprobación', 'Reservado']);
        })->count();

        return $vehicles;
    }
    private function getRentedVehicles()
    {
        $vehicles = Vehicle::whereHas('returnsAndRents', function ($query) {
            $query->whereIn('status', ['Reservado']);
        })->count();

        return $vehicles;
    }
    private function getMonthlyRentedVehicles()
    {
        $rentedVehicles = ReturnsAndRents::where('created_at', '>=', now()->subMonth())->count();

        return $rentedVehicles;
    }
    private function getPendingApprovalVehicles()
    {
        $vehicles = Vehicle::whereHas('returnsAndRents', function ($query) {
            $query->whereIn('status', ['Pendiente de aprobación']);
        })->count();

        return $vehicles;
    }
    private function getNewCustomers()
    {
        $customers = Customer::where('created_at', '>=', now()->subMonth())->count();
        return $customers;
    }
    private function getMonthlyRevenue()
    {
        $revenue = ReturnsAndRents::where('created_at', '>=', now()->subMonth())->sum('total_amount');
        return $revenue;
    }
    private function getOutOfServiceVehicles()
    {
        $vehicles = Vehicle::where('status', 'Malo')->count();

        return $vehicles;
    }
    private function getTodayRevenue(){
        $revenue = ReturnsAndRents::where('created_at', '>=', now()->subDay())->sum('total_amount');
        return $revenue;
    }
    private function getAverageRevenue(){
        $revenue = ReturnsAndRents::sum('total_amount') / ReturnsAndRents::count();
        return $revenue;
    }
    private function getYearlyRevenue(){
        $revenue = ReturnsAndRents::where('created_at', '>=', now()->subYear())->sum('total_amount');
        return $revenue;
    }
    private function getTopRents(){
        $topRents = ReturnsAndRents::select('vehicle_id', DB::raw('COUNT(vehicle_id) as rent_count'))
            ->with('vehicle') // Carga la relación del vehículo
            ->groupBy('vehicle_id') // Agrupa por vehicle_id
            ->orderByDesc('rent_count') // Ordena por el total de rentas
            ->take(3) // Limita los resultados a los 3 primeros
            ->get();

        // Agregar el atributo rent_count al modelo vehicle
        $topRents = $topRents->map(function ($rent) {
            if ($rent->vehicle) {
                $rent->vehicle->rent_count = $rent->rent_count; // Asigna rent_count al vehículo
            }
            return $rent->vehicle; // Retorna el modelo vehicle con rent_count
        });

        return $topRents;
    }
    private function getTopCustomers(){
        $topCustomers = ReturnsAndRents::select(
                'customer_id',
                DB::raw('COUNT(*) as rent_count'),
                DB::raw('SUM(total_amount) as total_spent') // Calcula el total gastado por el cliente
            )
            ->with('customer') // Asegúrate de cargar la relación del cliente
            ->groupBy('customer_id') // Agrupa por customer_id
            ->orderByDesc('rent_count') // Ordena por el total de rentas
            ->take(3) // Limita los resultados a los 3 primeros
            ->get();

        // Agregar los atributos rent_count y total_spent al modelo customer
        $topCustomers = $topCustomers->map(function ($rent) {
            if ($rent->customer) {
                $rent->customer->rent_count = $rent->rent_count; // Asigna rent_count al cliente
                $rent->customer->total_spent = $rent->total_spent; // Asigna total_spent al cliente
            }
            return $rent->customer; // Retorna el modelo customer con rent_count y total_spent
        });

        return $topCustomers;
    }
}
