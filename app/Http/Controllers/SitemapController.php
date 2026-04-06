<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Location;
use App\Models\Blog;

class SitemapController extends Controller
{
    // Human-friendly HTML sitemap page
    public function htmlIndex()
    {
        $pagesLastMod = max(
            Service::max('updated_at') ?? now(),
            Vehicle::max('updated_at') ?? now(),
            Route::max('updated_at') ?? now(),
            Location::max('updated_at') ?? now()
        );
        $blogLastMod = Blog::max('updated_at') ?? now();

        return view('sitemap.index-html', [
            'pagesLastMod' => date('Y-m-d\TH:i:sP', strtotime($pagesLastMod)),
            'blogLastMod' => date('Y-m-d\TH:i:sP', strtotime($blogLastMod)),
        ]);
    }

    // XML sitemap index for search engines
    public function sitemapIndexXml()
    {
        $pagesLastMod = Service::max('updated_at') ?? now();
        $blogLastMod = Blog::max('updated_at') ?? now();

        $xml = view('sitemap.index-xml', [
            'pagesLastMod' => date('Y-m-d\TH:i:sP', strtotime($pagesLastMod)),
            'blogLastMod' => date('Y-m-d\TH:i:sP', strtotime($blogLastMod)),
        ])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    // XML for pages
    public function pagesXml()
    {
        $urls = [];
        $urls[] = url('/');
        $urls[] = url('/about');
        $urls[] = url('/contact');
        $urls[] = url('/services');
        $urls[] = url('/vehicles');
        $urls[] = url('/routes');
        $urls[] = url('/locations');

        foreach (Service::where('is_active', 1)->get() as $service) {
            $urls[] = url('/services/' . $service->slug);
        }
        foreach (Vehicle::where('is_active', 1)->get() as $vehicle) {
            $urls[] = url('/vehicles/' . $vehicle->slug);
        }
        foreach (Route::where('is_active', 1)->get() as $route) {
            $urls[] = url('/cab/' . $route->slug);
        }
        foreach (Location::where('is_active', 1)->get() as $location) {
            $urls[] = url('/locations/' . $location->slug);
        }

        // Exclude admin and sensitive URLs
        $urls = array_filter($urls, function($url) {
            return !preg_match('#/(admin|login|register|dashboard|password)#i', $url);
        });
        $xml = view('sitemap.index', compact('urls'))->render();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    // XML for blogs
    public function blogXml()
    {
        $urls = [];
        foreach (Blog::where('is_active', 1)->get() as $blog) {
            $urls[] = url('/blog/' . $blog->slug);
        }
        $xml = view('sitemap.index', compact('urls'))->render();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
