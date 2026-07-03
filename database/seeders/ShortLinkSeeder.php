<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShortLinkSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'demo@shortcutter.test'],
            [
                'name' => 'Demo User',
                'password' => bcrypt('password'),
                'role' => User::ROLE_USER,
            ],
        );

        User::updateOrCreate(
            ['email' => 'admin@shortcutter.test'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => User::ROLE_ADMIN,
            ],
        );

        ShortLink::factory(5)->create([
            'user_id' => $user->id,
        ]);

        $this->command->info('Demo user created: demo@shortcutter.test / password');
        $this->command->info('Admin user created: admin@shortcutter.test / password');
        $this->command->info('5 short links seeded.');
    }
}
