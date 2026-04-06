<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = \App\Models\Service::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $featuredVehicles = Vehicle::where('is_active', true)
            ->take(6)
            ->get();

        $routes = \App\Models\Route::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('home', compact('featuredServices', 'featuredVehicles', 'routes', 'settings'));
    }
}
