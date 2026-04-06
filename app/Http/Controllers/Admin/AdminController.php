<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CabEnquiry;
use App\Models\Package;
use App\Models\Destination;
// use App\Models\Enquiry; // No longer needed
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => CabEnquiry::count(),
            'pending_enquiries' => CabEnquiry::where('status', 'pending')->count(),
        ];

        $recentBookings = CabEnquiry::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        $recentEnquiries = CabEnquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentEnquiries'));
    }
}
