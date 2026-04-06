<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Location;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Location $location)
    {
        $faqs = $location->faqs()->orderBy('order')->get();
        return view('admin.faqs.index', compact('location', 'faqs'));
    }

    public function create(Location $location)
    {
        return view('admin.faqs.create', compact('location'));
    }

    public function store(Request $request, Location $location)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        $data['location_id'] = $location->id;
        Faq::create($data);
        return redirect()->route('admin.faqs.index', $location)->with('success', 'FAQ added successfully.');
    }

    public function edit(Location $location, Faq $faq)
    {
        return view('admin.faqs.edit', compact('location', 'faq'));
    }

    public function update(Request $request, Location $location, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        $faq->update($data);
        return redirect()->route('admin.faqs.index', $location)->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Location $location, Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index', $location)->with('success', 'FAQ deleted successfully.');
    }
}
