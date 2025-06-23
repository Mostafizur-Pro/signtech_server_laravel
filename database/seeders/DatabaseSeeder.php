<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            CategoriesSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'number' => '01950165017',
            'email' => 'm@ph.com',
            'password' => '12345678',
            'image' => 'https://avatars.githubusercontent.com/u/108386566?v=4',
            'status' => 'active',
        ]);
    }
}
