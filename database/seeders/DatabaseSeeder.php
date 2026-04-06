<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gurgaoncab.com',
            'phone' => '+91 345 533 865',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Create Test Customer
        User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '+91 987 654 3210',
            'role' => 'customer',
            'password' => bcrypt('customer123'),
        ]);

        // Call Seeders
        $this->call([
            CategorySeeder::class,
            DestinationSeeder::class,
            PackageSeeder::class,
            VehicleSeeder::class,
            RouteSeeder::class,
        ]);
    }
}
