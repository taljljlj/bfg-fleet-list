<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArmamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $armaments = [];

        $armaments = array_merge($ships, [
            ["faction_id" => $factionId, "class" => "", "type" => "", "hitpoint" => , "speed" => , "turns" => , "shields" => , "armour" => "", "turrets" => , "points" => ],
        ]);
    }
}
