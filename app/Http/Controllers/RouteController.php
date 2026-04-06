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
        return view('routes.index', compact('routes'));
    }

    public function popular()
    {
        $routes = Route::where('is_popular', true)
            ->where('is_active', true)
            ->paginate(12);
        return view('routes.popular', compact('routes'));
    }

    public function show($slug)
    {
        $route = Route::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('routes.show', compact('route'));
    }
}
