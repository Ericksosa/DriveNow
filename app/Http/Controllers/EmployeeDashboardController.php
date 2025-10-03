<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\ReturnsAndRents;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $activeRents = $this->getRentedVehicles();
        $pendingReturns = $this->getReturnedVehiclesToday();
        $inspectionsToday = $this->getInspectionsToday();
        $monthlyRevenue = $this->getMonthlyRevenue();
        $recentRents = ReturnsAndRents::orderBy('created_at', 'desc')->limit(5)->get();
        $recentInspections = Inspection::orderBy('created_at', 'desc')->limit(5)->get();
        $todayReturns = $this->getProgramedReturnsToday();
        return view('employee.dashboard', compact('activeRents', 'pendingReturns', 'inspectionsToday', 'monthlyRevenue', 'recentRents', 'recentInspections', 'todayReturns'));
    }
    private function getRentedVehicles()
    {
        $vehicles = Vehicle::whereHas('returnsAndRents', function ($query) {
            $query->whereIn('status', ['Reservado']);
        })->count();

        return $vehicles;
    }
    private function getReturnedVehiclesToday()
    {
        $vehicles = Vehicle::whereHas('returnsAndRents', function ($query) {
            $query->whereDate('return_date', now()->toDateString()); // Filtra por la fecha de retorno igual a hoy
        })->count();

        return $vehicles;
    }
    private function getInspectionsToday()
    {
        $inspections = Inspection::where('created_at', '>=', now()->subDay())->count();

        return $inspections;
    }

    private function getMonthlyRevenue(){
        $revenue = ReturnsAndRents::where('created_at', '>=', now()->subMonth())->sum('total_amount');
        return $revenue;
    }
    private function getProgramedReturnsToday(){
        $returns = ReturnsAndRents::whereDate('return_date', now()->toDateString())->get();
        return $returns;
    }
}
