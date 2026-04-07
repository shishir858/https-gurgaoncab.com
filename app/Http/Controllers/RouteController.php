<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Package;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::where('is_active', true)->paginate(12);

        $meta_title = 'Cab Routes from Gurgaon - Outstation Taxi Routes | Gurgaon Cab Service';
        $meta_description = 'Explore outstation cab routes from Gurgaon: Shimla, Manali, Jaipur, Chandigarh, Haridwar and more. Distance, duration and book a taxi for your trip.';
        $meta_keywords = 'Gurgaon cab routes, outstation taxi Gurgaon, Gurgaon to Shimla cab, Gurgaon to Manali taxi, weekend trip cabs, one way cab routes';

        return view('routes.index', compact('routes', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function popular()
    {
        $routes = Route::where('is_popular', true)
            ->where('is_active', true)
            ->paginate(12);

        $meta_title = 'Popular Cab Routes from Gurgaon | Gurgaon Cab Service';
        $meta_description = 'Most booked outstation routes from Gurgaon. Compare distances and travel times and reserve a reliable cab for hill stations, pilgrimage and city trips.';
        $meta_keywords = 'popular routes Gurgaon, best cab routes, trending outstation trips Gurgaon, Gurgaon taxi routes';

        return view('routes.popular', compact('routes', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function show($slug)
    {
        $route = Route::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('routes.show', compact('route'));
    }
}
