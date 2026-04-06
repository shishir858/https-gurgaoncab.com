<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\CabEnquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Enquiry::latest();
        $query = CabEnquiry::latest();
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $enquiries = $query->paginate(20);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enquiry = CabEnquiry::findOrFail($id);
        return view('admin.enquiries.show', compact('enquiry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enquiry = CabEnquiry::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $enquiry->update($validated);

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enquiry = CabEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully!');
    }

    public function create()
    {
        // Not needed for enquiries
    }

    public function store(Request $request)
    {
        // Not needed for enquiries
    }

    public function edit(string $id)
    {
        // Not needed for enquiries
    }
}
