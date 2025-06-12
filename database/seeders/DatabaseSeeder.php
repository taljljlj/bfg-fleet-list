<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Refit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FactionSeeder::class,
            FleetListSeeder::class,
            RulesSeeder::class,
            RefitsSeeder::class,
            ShipSeeder::class,
        ]);
    }
}
