<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $cabServices = Service::where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->unique(function (Service $service) {
                $title = Str::lower(trim($service->title ?? ''));

                return $title !== '' ? $title : 'slug:' . $service->slug;
            })
            ->values()
            ->take(6);

        $featuredVehicles = Vehicle::where('is_active', true)
            ->take(6)
            ->get();

        $routes = \App\Models\Route::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('home', compact('featuredServices', 'cabServices', 'featuredVehicles', 'routes', 'settings'));
    }
}
