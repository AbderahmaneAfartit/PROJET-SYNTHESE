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

        // Seed Services
        $servicesData = [
            ['name' => 'Développement Web', 'description' => 'Création de sites et applications web', 'image' => 'web.jpg'],
            ['name' => 'Design Graphique', 'description' => 'Logos, affiches et identité visuelle', 'image' => 'design.jpg'],
            ['name' => 'Mécanique', 'description' => 'Réparation et entretien de véhicules', 'image' => 'meca.jpg'],
            ['name' => 'Plomberie', 'description' => 'Installation et dépannage de tuyauterie', 'image' => 'plomberie.jpg'],
            ['name' => 'Électricité', 'description' => 'Travaux électriques et maintenance', 'image' => 'elec.jpg'],
        ];

        foreach ($servicesData as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service);
        }

        $webService = Service::where('name', 'Développement Web')->first();

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

        User::updateOrCreate(
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

        // Seed some Posts
        Post::updateOrCreate(
            ['title' => 'Développement de site E-commerce'],
            [
                'user_id' => $manjobUser->id,
                'service_id' => $webService->id,
                'description' => 'Je propose mes services pour créer votre boutique en ligne avec Laravel.',
                'image' => 'ecommerce.jpg'
            ]
        );
    }
}
