<?php

namespace Database\Seeders;

use App\Models\Commander;
use App\Models\Faction;
use App\Models\FleetList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommandersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/commanders.json'));
        $commandersData = json_decode($json, true);

        foreach ($commandersData as $commanderData) {
            $fleetListsData = $commanderData['fleetlist'];
            unset($commanderData['fleetlist']);
            $factionData = $commanderData['faction'];
            unset($commanderData['faction']);

            $commanderData['faction_id'] = Faction::where('name', $factionData)->first()->id;

            $commander = Commander::create($commanderData);

            $fleetListIds = FleetList::whereIn('name', $fleetListsData)->get();

            foreach ($fleetListIds as $fleetListId) {
                $commander->fleetLists()->attach($fleetListId);
            }
        }
    }
}
