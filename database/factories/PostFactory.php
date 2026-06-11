<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'image' => null,
        ];
    }
}
