<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Gurgaon',
                'title' => 'Gurgaon',
                'slug' => 'gurgaon',
                'description' => 'Gurgaon is a major city in Haryana, known for its business hubs, shopping malls, and vibrant nightlife. It is a key destination for corporate travelers and tourists alike.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-29',
                'title' => 'Sector-29',
                'slug' => 'sector-29',
                'description' => 'Sector-29 is famous for its restaurants, pubs, and entertainment options. It is a popular spot for food lovers and nightlife enthusiasts in Gurgaon.',
                'is_active' => true,
            ],
            [
                'name' => 'Dlf Cyber City',
                'title' => 'Dlf Cyber City',
                'slug' => 'dlf-cyber-city',
                'description' => 'DLF Cyber City is the IT and business hub of Gurgaon, hosting major multinational companies and offering modern infrastructure for professionals.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-56',
                'title' => 'Sector-56',
                'slug' => 'sector-56',
                'description' => 'Sector-56 is a residential and commercial area with easy access to schools, hospitals, and shopping centers. It is ideal for families and working professionals.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-45',
                'title' => 'Sector-45',
                'slug' => 'sector-45',
                'description' => 'Sector-45 is a well-developed locality in Gurgaon, offering a mix of residential complexes and commercial establishments.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-14',
                'title' => 'Sector-14',
                'slug' => 'sector-14',
                'description' => 'Sector-14 is one of the oldest and most established areas in Gurgaon, known for its markets, schools, and connectivity.',
                'is_active' => true,
            ],
            [
                'name' => 'Sohna Road',
                'title' => 'Sohna Road',
                'slug' => 'sohna-road',
                'description' => 'Sohna Road is a major arterial road in Gurgaon, lined with commercial complexes, hotels, and residential projects.',
                'is_active' => true,
            ],
            [
                'name' => 'Udyog Vihar',
                'title' => 'Udyog Vihar',
                'slug' => 'udyog-vihar',
                'description' => 'Udyog Vihar is an industrial area in Gurgaon, home to numerous manufacturing units and corporate offices.',
                'is_active' => true,
            ],
            [
                'name' => 'Palam Vihar',
                'title' => 'Palam Vihar',
                'slug' => 'palam-vihar',
                'description' => 'Palam Vihar is a residential locality with parks, schools, and shopping options, making it a preferred area for families.',
                'is_active' => true,
            ],
            [
                'name' => 'Mg Road',
                'title' => 'Mg Road',
                'slug' => 'mg-road',
                'description' => 'MG Road is a prime commercial stretch in Gurgaon, known for its malls, offices, and easy connectivity to Delhi.',
                'is_active' => true,
            ],
            [
                'name' => 'Manesar',
                'title' => 'Manesar',
                'slug' => 'manesar',
                'description' => 'Manesar is an industrial town near Gurgaon, famous for its factories, resorts, and proximity to major highways.',
                'is_active' => true,
            ],
            [
                'name' => 'Gurugram',
                'title' => 'Gurugram',
                'slug' => 'gurugram',
                'description' => 'Gurugram is the modern name for Gurgaon, reflecting its growth as a global city with world-class amenities and infrastructure.',
                'is_active' => true,
            ],
            [
                'name' => 'Gurgaon',
                'slug' => 'gurgaon',
                'description' => 'Gurgaon is a major city in Haryana, known for its business hubs, shopping malls, and vibrant nightlife. It is a key destination for corporate travelers and tourists alike.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-29',
                'slug' => 'sector-29',
                'description' => 'Sector-29 is famous for its restaurants, pubs, and entertainment options. It is a popular spot for food lovers and nightlife enthusiasts in Gurgaon.',
                'is_active' => true,
            ],
            [
                'name' => 'Dlf Cyber City',
                'slug' => 'dlf-cyber-city',
                'description' => 'DLF Cyber City is the IT and business hub of Gurgaon, hosting major multinational companies and offering modern infrastructure for professionals.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-56',
                'slug' => 'sector-56',
                'description' => 'Sector-56 is a residential and commercial area with easy access to schools, hospitals, and shopping centers. It is ideal for families and working professionals.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-45',
                'slug' => 'sector-45',
                'description' => 'Sector-45 is a well-developed locality in Gurgaon, offering a mix of residential complexes and commercial establishments.',
                'is_active' => true,
            ],
            [
                'name' => 'Sector-14',
                'slug' => 'sector-14',
                'description' => 'Sector-14 is one of the oldest and most established areas in Gurgaon, known for its markets, schools, and connectivity.',
                'is_active' => true,
            ],
            [
                'name' => 'Sohna Road',
                'slug' => 'sohna-road',
                'description' => 'Sohna Road is a major arterial road in Gurgaon, lined with commercial complexes, hotels, and residential projects.',
                'is_active' => true,
            ],
            [
                'name' => 'Udyog Vihar',
                'slug' => 'udyog-vihar',
                'description' => 'Udyog Vihar is an industrial area in Gurgaon, home to numerous manufacturing units and corporate offices.',
                'is_active' => true,
            ],
            [
                'name' => 'Palam Vihar',
                'slug' => 'palam-vihar',
                'description' => 'Palam Vihar is a residential locality with parks, schools, and shopping options, making it a preferred area for families.',
                'is_active' => true,
            ],
            [
                'name' => 'Mg Road',
                'slug' => 'mg-road',
                'description' => 'MG Road is a prime commercial stretch in Gurgaon, known for its malls, offices, and easy connectivity to Delhi.',
                'is_active' => true,
            ],
            [
                'name' => 'Manesar',
                'slug' => 'manesar',
                'description' => 'Manesar is an industrial town near Gurgaon, famous for its factories, resorts, and proximity to major highways.',
                'is_active' => true,
            ],
            [
                'name' => 'Gurugram',
                'slug' => 'gurugram',
                'description' => 'Gurugram is the modern name for Gurgaon, reflecting its growth as a global city with world-class amenities and infrastructure.',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate([
                'slug' => $location['slug']
            ], $location);
        }
    }
}
