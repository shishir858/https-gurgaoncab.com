<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function archive()
    {
        $services = Service::where('is_active', true)->orderByDesc('created_at')->paginate(12);
        return view('services.archive', compact('services'));
    }

    public function details($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $settings = cache()->remember('site_settings', 3600, function() {
            return \App\Models\Setting::pluck('value', 'key')->toArray();
        });
        return view('services.details', compact('service', 'settings'));
    }
    public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'pickup_location' => 'nullable|string|max:255',
            'drop_location' => 'nullable|string|max:255',
            'vehicle_type' => 'nullable|string|max:255',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        $enquiry = \App\Models\Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'pickup_location' => $validated['pickup_location'] ?? null,
            'drop_location' => $validated['drop_location'] ?? null,
            'vehicle_type' => $validated['vehicle_type'] ?? null,
            'date' => $validated['date'],
            'message' => $validated['message'] ?? null,
            'type' => 'service',
        ]);

        // Send notification email to admin
        \Mail::to(config('mail.from.address'))->send(new \App\Mail\CabEnquiryNotification($enquiry));
        // Send confirmation email to user
        \Mail::to($enquiry->email)->send(new \App\Mail\EnquiryConfirmation($enquiry));

        return redirect('/thankyou');
    }
}
