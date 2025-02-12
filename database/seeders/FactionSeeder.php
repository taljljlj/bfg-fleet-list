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
            [
                "name" => "Imperium",
                "img_url" => "imperium-logo.png"
            ],
            [
                "name" => "Space Marines",
                "img_url" => "space-marines-logo.png"
            ],
            [
                "name" => "Adeptus Mechanicus",
                "img_url" => "adeptus-mechanicus-logo.png"
            ],
            [
                "name" => "Inquisition",
                "img_url" => "inquisition-logo.png"
            ],
            [
                "name" => "Rogue Traders",
                "img_url" => "rogue-traders-logo.png"
            ],
            [
                "name" => "Chaos",
                "img_url" => "chaos-logo.png"
            ],
            [
                "name" => "Eldar",
                "img_url" => "eldar-logo.png"
            ],
            [
                "name" => "Dark Eldar",
                "img_url" => "dark-eldar-logo.png"
            ],
            [
                "name" => "Orks",
                "img_url" => "orks-logo.png"
            ],
            [
                "name" => "Necrons",
                "img_url" => "necrons-logo.png"
            ],
            [
                "name" => "Tyranids",
                "img_url" => "tyranids-logo.png"
            ],
            [
                "name" => "Tau",
                "img_url" => "tau-logo.png"
            ],
        ];

        foreach ($factions as $faction) {
            Faction::create($faction);
        }
    }
}
