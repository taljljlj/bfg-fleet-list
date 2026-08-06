<?php

namespace Database\Seeders;

use App\Models\Commander;
use App\Models\CommanderRerolls;
use App\Models\Faction;
use App\Models\FleetList;
use App\Models\Rules;
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
            $commanderRerolls = $commanderData['extra_rerolls'];
            unset($commanderData['extra_rerolls']);

            if ($commanderData['rule']) {
                $commanderData['rule_id'] = Rules::where('name', $commanderData['rule'])->first()->id;
            } else {
                $commanderData['rule_id'] = null;
            }
            unset($commanderData['rule']);

            $commanderData['faction_id'] = Faction::where('name', $factionData)->first()->id;

            $commander = Commander::create($commanderData);

            $fleetListIds = FleetList::whereIn('name', $fleetListsData)->get();

            foreach ($fleetListIds as $fleetListId) {
                $commander->fleetLists()->attach($fleetListId);
            }

            $modifier = 0;
            foreach ($commanderRerolls as $rerollPoints) {
                $modifier++;
                CommanderRerolls::create([
                    'commander_id' => $commander->id,
                    'modifier' => $modifier,
                    'points' => $rerollPoints,
                ]);
            }
        }
    }
}
