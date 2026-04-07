<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::where('is_active', true);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $vehicles = $query->paginate(12);

        $meta_title = 'Our Vehicles - Taxi Fleet in Gurgaon | Gurgaon Cab Service';
        $meta_description = 'Browse sedan, SUV, Innova Crysta, Tempo Traveller and more. Well-maintained cabs for local and outstation travel from Gurgaon with transparent per-km rates.';
        $meta_keywords = 'Gurgaon cab vehicles, taxi fleet Gurgaon, sedan SUV hire, Innova Crysta Gurgaon, Tempo Traveller booking, airport cab Gurgaon';

        return view('vehicles.index', compact('vehicles', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function luxury()
    {
        $vehicles = Vehicle::where('is_active', true)
            ->where('type', 'luxury')
            ->paginate(12);

        $meta_title = 'Luxury Vehicles - Premium Cabs in Gurgaon | Gurgaon Cab Service';
        $meta_description = 'Premium luxury cars for corporate travel, events and special occasions in Gurgaon. Book comfortable high-end cabs with professional drivers.';
        $meta_keywords = 'luxury cab Gurgaon, premium taxi Gurgaon, luxury car hire, executive travel Gurgaon';

        return view('vehicles.index', compact('vehicles', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function show($slug)
    {
        $vehicle = Vehicle::where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();
        return view('vehicles.show', compact('vehicle'));
    }
}
