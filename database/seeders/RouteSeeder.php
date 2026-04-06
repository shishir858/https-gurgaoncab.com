<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Route::query()->delete();
        $routes = [
            [ 'name' => 'Gurgaon to Haridwar Cab', 'slug' => 'gurgaon-to-haridwar-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Haridwar', 'distance' => 240, 'duration' => '5-6 hours', 'base_price' => 3500.00, 'image' => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Dehradun Cab', 'slug' => 'gurgaon-to-dehradun-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Dehradun', 'distance' => 260, 'duration' => '5-6 hours', 'base_price' => 3700.00, 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Rishikesh Cab', 'slug' => 'gurgaon-to-rishikesh-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Rishikesh', 'distance' => 270, 'duration' => '5-6 hours', 'base_price' => 3800.00, 'image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Shimla Cab', 'slug' => 'gurgaon-to-shimla-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Shimla', 'distance' => 340, 'duration' => '7-8 hours', 'base_price' => 4500.00, 'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Manali Cab', 'slug' => 'gurgaon-to-manali-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Manali', 'distance' => 570, 'duration' => '12-14 hours', 'base_price' => 8500.00, 'image' => 'https://images.unsplash.com/photo-1580845694930-0795e0064ae7?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Dharamshala Cab', 'slug' => 'gurgaon-to-dharamshala-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Dharamshala', 'distance' => 500, 'duration' => '10-11 hours', 'base_price' => 7000.00, 'image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Chandigarh Cab', 'slug' => 'gurgaon-to-chandigarh-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Chandigarh', 'distance' => 300, 'duration' => '5-6 hours', 'base_price' => 4000.00, 'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Jaipur Cab', 'slug' => 'gurgaon-to-jaipur-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Jaipur', 'distance' => 240, 'duration' => '4-5 hours', 'base_price' => 3500.00, 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Udaipur Cab', 'slug' => 'gurgaon-to-udaipur-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Udaipur', 'distance' => 650, 'duration' => '11-12 hours', 'base_price' => 11000.00, 'image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Alwar Cab', 'slug' => 'gurgaon-to-alwar-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Alwar', 'distance' => 130, 'duration' => '2-3 hours', 'base_price' => 2200.00, 'image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Agra Cab', 'slug' => 'gurgaon-to-agra-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Agra', 'distance' => 230, 'duration' => '4-5 hours', 'base_price' => 3500.00, 'image' => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Mathura Cab', 'slug' => 'gurgaon-to-mathura-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Mathura', 'distance' => 180, 'duration' => '3-4 hours', 'base_price' => 2500.00, 'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
            [ 'name' => 'Gurgaon to Khatushyam Cab', 'slug' => 'gurgaon-to-khatushyam-cab', 'from_location' => 'Gurgaon', 'to_location' => 'Khatushyam', 'distance' => 90, 'duration' => '2 hours', 'base_price' => 1800.00, 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=600&q=80', 'is_active' => true ],
        ];
        foreach ($routes as $route) {
            Route::updateOrCreate([
                'slug' => $route['slug']
            ], $route);
        }
    }
}
