<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factions = [
            ["name" => "Imperium"],
            ["name" => "Space Marines"],
            ["name" => "Adeptus Mechanicus"],
            ["name" => "Inquisition"],
            ["name" => "Rogue Traders"],
            ["name" => "Chaos"],
            ["name" => "Eldar"],
            ["name" => "Dark Eldar"],
            ["name" => "Orks"],
            ["name" => "Necrons"],
            ["name" => "Tyranids"],
            ["name" => "Tau"],
        ];

        foreach ($factions as $faction) {
            Faction::create($faction);
        }
    }
}
