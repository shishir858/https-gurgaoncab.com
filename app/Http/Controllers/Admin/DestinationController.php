<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
            'duration' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_tours' => 'nullable|integer|min:0',
        ]);

        // Handle image upload or URL
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->storeAs('images/destinations', $imageName, 'public');
            $validated['image'] = '/storage/images/destinations/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } else {
            return back()->with('error', 'Please provide an image file or URL')->withInput();
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['rating'] = $validated['rating'] ?? 4.5;
        $validated['total_tours'] = $validated['total_tours'] ?? 0;

        unset($validated['image_file'], $validated['image_url']);

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully!');
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
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|string',
            'duration' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_tours' => 'nullable|integer|min:0',
        ]);

        // Handle image upload or URL
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->storeAs('images/destinations', $imageName, 'public');
            $validated['image'] = '/storage/images/destinations/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        unset($validated['image_file'], $validated['image_url']);

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
}
