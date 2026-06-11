<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        // Seed Services as requested
        $servicesData = [
            ['name' => 'Logo Design', 'category' => 'Design', 'description' => 'Professional logo design and brand identity.', 'image' => 'logo_design.jpg'],
            ['name' => 'Web Development', 'category' => 'Tech', 'description' => 'Building responsive and modern websites.', 'image' => 'web_dev.jpg'],
            ['name' => 'Video Editing', 'category' => 'Multimedia', 'description' => 'High-quality video editing and post-production.', 'image' => 'video_editing.jpg'],
            ['name' => 'Writing & Translation', 'category' => 'Content', 'description' => 'Content writing and professional translation services.', 'image' => 'writing.jpg'],
            ['name' => 'Social Media', 'category' => 'Marketing', 'description' => 'Social media management and strategy.', 'image' => 'social_media.jpg'],
            ['name' => 'SEO', 'category' => 'Marketing', 'description' => 'Search engine optimization to improve visibility.', 'image' => 'seo.jpg'],
        ];

        foreach ($servicesData as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service);
        }

        $webService = Service::where('name', 'Web Development')->first();
        $designService = Service::where('name', 'Logo Design')->first();

        // Seed Users
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => $password,
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
        );

        $clientUser = User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'Client User',
                'password' => $password,
                'role' => 'client',
                'email_verified_at' => now(),
            ],
        );

        $manjobUser = User::updateOrCreate(
            ['email' => 'manjob@example.com'],
            [
                'name' => 'Manjob User',
                'password' => $password,
                'role' => 'manjob',
                'contact' => '+212 600 000 000',
                'service_id' => $webService->id,
                'email_verified_at' => now(),
            ],
        );

        // Seed Posts
        \App\Models\Post::updateOrCreate(
            ['title' => 'E-commerce Website Development'],
            [
                'user_id' => $manjobUser->id,
                'service_id' => $webService->id,
                'description' => 'Expert web development services for your e-commerce business.',
                'image' => 'posts/web_dev_sample.jpg'
            ]
        );

        \App\Models\Post::updateOrCreate(
            ['title' => 'Modern Logo Design'],
            [
                'user_id' => $manjobUser->id,
                'service_id' => $designService->id,
                'description' => 'Creating modern and impactful logos for startups.',
                'image' => 'posts/logo_design_sample.jpg'
            ]
        );

        // Seed Client Jobs
        \App\Models\ClientJob::updateOrCreate(
            ['title' => 'Need a professional logo for my blog'],
            [
                'user_id' => $clientUser->id,
                'status' => 'open',
            ]
        );

        \App\Models\ClientJob::updateOrCreate(
            ['title' => 'Looking for a Laravel developer'],
            [
                'user_id' => $clientUser->id,
                'status' => 'open',
            ]
        );
    }
}
