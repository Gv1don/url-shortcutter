<?php

namespace Database\Factories;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortLinkFactory extends Factory
{
    protected $model = ShortLink::class;

    public function definition(): array
    {
        return [
            'original_url' => fake()->url(),
            'short_code' => Str::random(6),
            'clicks_count' => 0,
        ];
    }
}
