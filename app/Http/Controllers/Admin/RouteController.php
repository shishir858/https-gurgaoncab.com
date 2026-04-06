<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.routes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'from_location' => 'nullable|string|max:255',
            'to_location' => 'nullable|string|max:255',
            'distance' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'base_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'key_stops' => 'nullable|string',
            'best_season' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
        ]);

        // Handle image upload or URL
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/routes'), $imageName);
            $validated['image'] = '/images/routes/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } else {
            return back()->with('error', 'Please provide an image file or URL')->withInput();
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        unset($validated['image_file'], $validated['image_url']);

        // Make sure from_location and to_location are present
        // Do NOT unset them

        Route::create($validated);

        return redirect()->route('admin.routes.index')
            ->with('success', 'Route created successfully!');
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
    public function edit(Route $route)
    {
        return view('admin.routes.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'key_stops' => 'nullable|string',
            'best_season' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
        ]);

        // Handle image upload or URL
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/routes'), $imageName);
            $validated['image'] = '/images/routes/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->image_url;
        } else {
            $validated['image'] = $route->image;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        unset($validated['image_file'], $validated['image_url']);

        $route->update($validated);

        return redirect()->route('admin.routes.index')
            ->with('success', 'Route updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('admin.routes.index')
            ->with('success', 'Route deleted successfully!');
    }
}
