<?php
// Service Enquiry Route
Route::post('/service-enquiry', [App\Http\Controllers\ServiceController::class, 'storeEnquiry'])->name('service-enquiry.store');
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RouteController as AdminRouteController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabEnquiryController;
// Blog Frontend
use App\Http\Controllers\BlogController;


// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// 301 Redirects (fix legacy 404 URLs)
Route::permanentRedirect('/service', '/services');
Route::permanentRedirect('/vehicle', '/vehicles');
Route::permanentRedirect('/cab/gurgaon/cab-in-gurgaon', '/locations/gurgaon');

// Services (Frontend)
use App\Http\Controllers\ServiceController;
Route::get('/services', [ServiceController::class, 'archive'])->name('services.archive');
Route::get('/services/{slug}', [ServiceController::class, 'details'])->name('service.details');

// Vehicles

// Locations
use App\Http\Controllers\LocationController;
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/{slug}', [LocationController::class, 'show'])->name('locations.show');

// Vehicles
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/luxury', [VehicleController::class, 'luxury'])->name('vehicles.luxury');
Route::permanentRedirect('/vehicles/tempo-traveler', '/vehicles/tempo-traveller-16-seater');
Route::get('/vehicles/{slug}', [VehicleController::class, 'show'])->name('vehicles.show');

// Routes
Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
Route::get('/routes/popular', [RouteController::class, 'popular'])->name('routes.popular');
// Route::get('/routes/{slug}', [RouteController::class, 'show'])->name('routes.show');
Route::permanentRedirect('/cab/gurgaon-to-jaipur', '/cab/gurgaon-to-jaipur-cab');
Route::permanentRedirect('/cab/gurgaon-to-rishikesh', '/cab/gurgaon-to-rishikesh-cab');
Route::permanentRedirect('/cab/gurgaon-to-dharamshala', '/cab/gurgaon-to-dharamshala-cab');
Route::permanentRedirect('/cab/gurgaon-to-dehradun', '/cab/gurgaon-to-dehradun-cab');
Route::permanentRedirect('/cab/gurgaon-to-mathura', '/cab/gurgaon-to-mathura-cab');
Route::permanentRedirect('/cab/gurgaon-to-hardwar', '/cab/gurgaon-to-hardwar-cab');
Route::permanentRedirect('/cab/gurgaon-to-haridwar', '/cab/gurgaon-to-mathura-cab');
Route::permanentRedirect('/cab/gurgaon-to-haridwar/', '/cab/gurgaon-to-mathura-cab');
Route::permanentRedirect('/cab/gurgaon-to-alwar', '/cab/gurgaon-to-alwar-cab');
Route::permanentRedirect('/cab/gurgaon-to-chandigarh', '/cab/gurgaon-to-chandigarh-cab');
Route::permanentRedirect('/cab/gurgaon-to-agra', '/cab/gurgaon-to-agra-cab');
Route::permanentRedirect('/cab/gurgaon-to-khatushyam', '/cab/gurgaon-to-khatushyam-cab');
Route::permanentRedirect('/cab/gurgaon-to-khatu-shyam', '/cab/gurgaon-to-khatushyam-cab');
Route::permanentRedirect('/cab/gurgaon-to-khatu-shyam/', '/cab/gurgaon-to-khatushyam-cab');
Route::permanentRedirect('/cab/gurgaon-to-udaipur', '/cab/gurgaon-to-udaipur-cab');
Route::permanentRedirect('/cab/gurgaon-to-manali', '/cab/gurgaon-to-manali-cab');
Route::get('/cab/{slug}', [RouteController::class, 'show'])->name('routes.show');

// Guest Routes (Login/Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin Routes
// Sitemap XML
Route::get('/sitemap', [App\Http\Controllers\SitemapController::class, 'htmlIndex']);
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'sitemapIndexXml']);
Route::get('/sitemap-pages.xml', [App\Http\Controllers\SitemapController::class, 'pagesXml']);
Route::get('/sitemap-blog.xml', [App\Http\Controllers\SitemapController::class, 'blogXml']);
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    // Resource Routes
    Route::resource('vehicles', AdminVehicleController::class);
    Route::resource('routes', AdminRouteController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('locations', \App\Http\Controllers\Admin\LocationController::class);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    // TinyMCE image upload
    Route::post('/tinymce-upload', [\App\Http\Controllers\Admin\TinyMCEUploadController::class, 'upload'])->name('tinymce.upload');

    // FAQ routes nested under locations
    Route::prefix('locations/{location}')->name('faqs.')->group(function () {
        Route::get('faqs', [\App\Http\Controllers\Admin\FaqController::class, 'index'])->name('index');
        Route::get('faqs/create', [\App\Http\Controllers\Admin\FaqController::class, 'create'])->name('create');
        Route::post('faqs', [\App\Http\Controllers\Admin\FaqController::class, 'store'])->name('store');
        Route::get('faqs/{faq}/edit', [\App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('edit');
        Route::put('faqs/{faq}', [\App\Http\Controllers\Admin\FaqController::class, 'update'])->name('update');
        Route::delete('faqs/{faq}', [\App\Http\Controllers\Admin\FaqController::class, 'destroy'])->name('destroy');
    });
    // Enquiry Routes
    Route::get('/enquiries', [App\Http\Controllers\Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{id}', [App\Http\Controllers\Admin\EnquiryController::class, 'show'])->name('enquiries.show');
    Route::put('/enquiries/{id}', [App\Http\Controllers\Admin\EnquiryController::class, 'update'])->name('enquiries.update');
});

// Cab Enquiry Routes
Route::post('/cab-enquiry', [CabEnquiryController::class, 'store'])->name('cab-enquiry.store');
Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');

// Frontend Routes
Route::get('/blog', [BlogController::class, 'archive'])->name('blog.archive');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
