<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::where('is_active', true)->orderBy('title')->get();
        return view('locations.index', compact('locations'));
    }

    public function show($slug)
    {
        $location = Location::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('locations.show', compact('location'));
    }
}
