<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer|min:2000|max:2030',
            'capacity' => 'required|integer|min:1',
            'seating_capacity' => 'required|integer|min:1',
            'luggage_capacity' => 'nullable|integer|min:0',
            'price_per_km' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|url',
        ]);

        // Handle image upload or URL
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/vehicles'), $imageName);
            $validated['image'] = '/images/vehicles/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } else {
            return back()->with('error', 'Please provide an image file or URL')->withInput();
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['has_ac'] = $request->has('has_ac');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_active'] = $request->has('is_active');

        unset($validated['image_file'], $validated['image_url']);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed for admin
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer|min:2000|max:2030',
            'capacity' => 'required|integer|min:1',
            'seating_capacity' => 'required|integer|min:1',
            'luggage_capacity' => 'nullable|integer|min:0',
            'price_per_km' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|url',
        ]);

        // Handle image upload or URL
            if ($request->hasFile('image_file')) {
                $image = $request->file('image_file');
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $sanitizedName = Str::slug($originalName);
                $imageName = time() . '_' . $sanitizedName . '.' . $extension;
                $image->move(public_path('images/vehicles'), $imageName);
                $validated['image'] = '/images/vehicles/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['has_ac'] = $request->has('has_ac');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_active'] = $request->has('is_active');

        unset($validated['image_file'], $validated['image_url']);

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully!');
    }
}
