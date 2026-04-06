<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contact_email',
                'value' => 'info@example.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Primary email address for contact',
                'order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+91 456 453 345',
                'type' => 'tel',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Primary phone number for contact',
                'order' => 2,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '+91 345 533 865',
                'type' => 'tel',
                'group' => 'contact',
                'label' => 'WhatsApp Number',
                'description' => 'WhatsApp number for quick contact',
                'order' => 3,
            ],
            [
                'key' => 'whatsapp_link',
                'value' => 'https://wa.me/919876543210',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp Link',
                'description' => 'Full WhatsApp link for floating button',
                'order' => 4,
            ],
            [
                'key' => 'contact_address',
                'value' => '2nd Floor, MG Road, Near Metro Station, Connaught Place, New Delhi 110001, India',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Office Address',
                'description' => 'Complete office address',
                'order' => 5,
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page link',
                'order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile link',
                'order' => 2,
            ],
            [
                'key' => 'social_linkedin',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'LinkedIn page link',
                'order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'YouTube channel link',
                'order' => 4,
            ],


        // ...existing contact and social settings...
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
