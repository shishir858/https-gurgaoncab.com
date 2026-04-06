<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('id', 'asc')->paginate(20);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_canonical' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
            // Ensure unique slug
            $original = $data['slug'];
            $i = 1;
            while (\App\Models\Location::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $original.'-'.$i++;
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/locations'), $imageName);
            $data['image'] = '/images/locations/' . $imageName;
        }
        Location::create($data);
        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug,' . $location->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_canonical' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
            // Ensure unique slug
            $original = $data['slug'];
            $i = 1;
            while (\App\Models\Location::where('slug', $data['slug'])->where('id', '!=', $location->id)->exists()) {
                $data['slug'] = $original.'-'.$i++;
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/locations'), $imageName);
            $data['image'] = '/images/locations/' . $imageName;
        }
        $location->update($data);
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully.');
    }
}
