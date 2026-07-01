<?php

namespace Database\Factories;

use App\Models\Click;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClickFactory extends Factory
{
    protected $model = Click::class;

    public function definition(): array
    {
        return [
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'created_at' => fake()->dateTimeBetween('-30 days'),
        ];
    }
}
