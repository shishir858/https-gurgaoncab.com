<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabEnquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\CabEnquiryNotification;

class CabEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passenger' => 'nullable|string|max:255',
            'pickup_location' => 'required|string|max:255',
            'drop_location' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'pickup_time' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string|max:1000',
        ]);
        CabEnquiry::create($validated);
        // Send email notification
        Mail::to(config('mail.admin_email', env('ADMIN_EMAIL', 'shishir4.gurgaoncab@gmail.com')))
            ->send(new CabEnquiryNotification($validated));
        return redirect()->route('thankyou');
    }
}
