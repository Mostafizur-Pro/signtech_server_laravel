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

        User::factory()->create([
            'name' => 'Test User',
            'number' => '01950165017',
            'email' => 'test@example.com',
            'password' => '123456',
            'image' => 'https://avatars.githubusercontent.com/u/108386566?v=4',
            'status' => 'active',
        ]);
    }
}
