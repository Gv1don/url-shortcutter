<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShortLinkSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@shortcutter.test',
            'password' => bcrypt('password'),
        ]);

        ShortLink::factory(5)->create([
            'user_id' => $user->id,
        ]);

        $this->command->info('Demo user created: demo@shortcutter.test / password');
        $this->command->info('5 short links seeded.');
    }
}
