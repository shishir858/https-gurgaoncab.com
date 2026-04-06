<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Top 10 Travel Tips for Gurgaon',
                'meta_title' => 'Top 10 Travel Tips for Gurgaon',
                'meta_description' => 'Discover the best travel tips for Gurgaon to make your journey smooth and enjoyable.',
                'meta_keywords' => 'gurgaon travel, tips, guide',
                'meta_canonical' => 'https://gurgaoncab.com/blog/top-10-travel-tips-for-gurgaon',
                'feature_image' => '/images/blogs/travel-tips.jpg',
                'content' => '<p>Here are the top 10 travel tips for Gurgaon...</p>',
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Best Places to Visit in Gurgaon',
                'meta_title' => 'Best Places to Visit in Gurgaon',
                'meta_description' => 'Explore the must-visit places in Gurgaon for tourists and locals.',
                'meta_keywords' => 'gurgaon places, sightseeing',
                'meta_canonical' => 'https://gurgaoncab.com/blog/best-places-to-visit-in-gurgaon',
                'feature_image' => '/images/blogs/best-places.jpg',
                'content' => '<p>Discover the best places to visit in Gurgaon...</p>',
                'is_active' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'How to Book a Cab in Gurgaon',
                'meta_title' => 'How to Book a Cab in Gurgaon',
                'meta_description' => 'Step-by-step guide to booking a cab in Gurgaon easily.',
                'meta_keywords' => 'gurgaon cab, booking, taxi',
                'meta_canonical' => 'https://gurgaoncab.com/blog/how-to-book-a-cab-in-gurgaon',
                'feature_image' => '/images/blogs/book-cab.jpg',
                'content' => '<p>Booking a cab in Gurgaon is simple...</p>',
                'is_active' => true,
                'published_at' => now()->subDays(5),
            ],
        ];
        foreach ($blogs as $data) {
            $data['slug'] = Str::slug($data['title']);
            Blog::create($data);
        }
    }
}
