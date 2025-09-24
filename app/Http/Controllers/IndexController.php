<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $premiumVehicles = Vehicle::where('category', 'Lujo')
        ->take(3)->get();
        return view('welcome', compact('premiumVehicles'));
    }
}
