<?php

namespace Database\Seeders;

use App\Models\Click;
use App\Models\ShortLink;
use Illuminate\Database\Seeder;

class ClickSeeder extends Seeder
{
    public function run(): void
    {
        $links = ShortLink::all();

        foreach ($links as $link) {
            Click::factory(rand(3, 10))->create([
                'short_link_id' => $link->id,
            ]);

            $link->update([
                'clicks_count' => $link->clicks()->count(),
            ]);
        }

        $this->command->info('Clicks seeded.');
    }
}
