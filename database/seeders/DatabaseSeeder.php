<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Team;
use App\Models\TeamMember;
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
            'email' => 'test@example.com',
        ]);

        Team::factory()->has(TeamMember::factory()->count(8))->create();

        Product::factory()->count(5)->create();
    }
}
