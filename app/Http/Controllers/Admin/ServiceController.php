<?php
namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByDesc('created_at')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services',
            'feature_image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature_image_url' => 'nullable|url',
            'highlights' => 'nullable|string',
            'offer' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'included' => 'nullable|string',
            'excluded' => 'nullable|string',
            'more_contents' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_canonical' => 'nullable|string',
        ]);
        // Handle image upload or URL
        if ($request->hasFile('feature_image_upload')) {
            $image = $request->file('feature_image_upload');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/services'), $imageName);
            $data['feature_image'] = '/images/services/' . $imageName;
        } elseif ($request->filled('feature_image_url')) {
            $data['feature_image'] = $request->feature_image_url;
        } else {
            return back()->with('error', 'Please provide an image file or URL')->withInput();
        }
        unset($data['feature_image_upload'], $data['feature_image_url']);
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,' . $service->id,
            'feature_image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature_image_url' => 'nullable|url',
            'highlights' => 'nullable|string',
            'offer' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'included' => 'nullable|string',
            'excluded' => 'nullable|string',
            'more_contents' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_canonical' => 'nullable|string',
        ]);
        // Handle image upload or URL
        if ($request->hasFile('feature_image_upload')) {
            $image = $request->file('feature_image_upload');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/services'), $imageName);
            $data['feature_image'] = '/images/services/' . $imageName;
        } elseif ($request->filled('feature_image_url')) {
            $data['feature_image'] = $request->feature_image_url;
        } else {
            $data['feature_image'] = $service->feature_image;
        }
        unset($data['feature_image_upload'], $data['feature_image_url']);
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully');
    }
}
