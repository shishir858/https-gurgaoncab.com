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

        return view('vehicles.index', compact('vehicles'));
    }

    public function luxury()
    {
        $vehicles = Vehicle::where('is_active', true)
            ->where('type', 'luxury')
            ->paginate(12);

        return view('vehicles.index', compact('vehicles'));
    }

    public function show($slug)
    {
        $vehicle = Vehicle::where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();
        return view('vehicles.show', compact('vehicle'));
    }
}
