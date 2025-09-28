<?php

namespace Database\Seeders;

use App\Models\Faction;
use App\Models\FleetList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FleetListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fleetLists = [];

        //get Imperium ID for imperial fleet lists
        $factionId = Faction::getByName('Imperium')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Gothic Sector Fleet List", "faction_id" => $factionId],
            ["name" => "Bastion Fleet List", "faction_id" => $factionId],
            ["name" => "Armageddon Sector Fleet List", "faction_id" => $factionId],
            ["name" => "Bakka Sector Fleet List", "faction_id" => $factionId]
        ]);

        //get Space Marine ID for space marine fleet lists
        $factionId = Faction::getByName('Space Marines')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Codex Astardes Fleet List", "faction_id" => $factionId],
            ["name" => "Crusade Fleet List", "faction_id" => $factionId],
            ["name" => "Dominion Fleet List", "faction_id" => $factionId],
        ]);

        //get Adeptus Mechanicus ID for adeptus mechanicus fleet lists
        $factionId = Faction::getByName('Adeptus Mechanicus')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Adeptus Mechanicus Fleet List", "faction_id" => $factionId],
        ]);

        //get Inquisition ID for Inquisition fleet lists
        $factionId = Faction::getByName('Inquisition')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "The Emperor's Inquisition", "faction_id" => $factionId],
            ["name" => "Ordo Hereticus", "faction_id" => $factionId],
            ["name" => "Ordo Xenos", "faction_id" => $factionId],
            ["name" => "Ordo Malleus", "faction_id" => $factionId],
        ]);

        //get Rogue Trader ID for Rogue Trader fleet lists
        $factionId = Faction::getByName('Rogue Traders')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Rogue Traders", "faction_id" => $factionId],
            ["name" => "Exploration Fleet List", "faction_id" => $factionId],
            ["name" => "Pirates and Wolf Packs", "faction_id" => $factionId],
        ]);

        //get Chaos ID for Chaos fleet lists
        $factionId = Faction::getByName('Chaos')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Chaos Incursion Fleet List", "faction_id" => $factionId],
            ["name" => "Black Crusade Fleet List", "faction_id" => $factionId],
            ["name" => "The Sorcerous Fleet", "faction_id" => $factionId],
            ["name" => "The Plaguefleet", "faction_id" => $factionId],
            ["name" => "The Berzerker Fleet", "faction_id" => $factionId],
            ["name" => "The Pleasurefleet", "faction_id" => $factionId],
        ]);

        //get Eldar ID for Eldar fleet lists
        $factionId = Faction::getByName('Eldar')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Eldar Corsairs Fleet List [Gothic Sector]", "faction_id" => $factionId],
            ["name" => "Eldar Corsairs Fleet List [Later Gothic War]", "faction_id" => $factionId],
            ["name" => "Iyanden Caftworld Fleet", "faction_id" => $factionId],
        ]);

        //get Dark Eldar ID for Dark Eldar fleet lists
        $factionId = Faction::getByName('Dark Eldar')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Pirates Fleet List", "faction_id" => $factionId],
        ]);

        //get Orks ID for Orks fleet lists
        $factionId = Faction::getByName('Orks')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Cyclops Fleet List", "faction_id" => $factionId],
            ["name" => "Ork Waaagh! Fleet List", "faction_id" => $factionId],
            ["name" => "Ork Clanz", "faction_id" => $factionId],
            ["name" => "Da Ork Clanz Fleet List", "faction_id" => $factionId],
        ]);

        //get Necrons ID for Necrons fleet lists
        $factionId = Faction::getByName('Necrons')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Harvest Fleet List", "faction_id" => $factionId],
        ]);

        //get Tyranids ID for Tyranids fleet lists
        $factionId = Faction::getByName('Tyranids')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Vanguard Fleet List", "faction_id" => $factionId],
            ["name" => "Hive Fleet List", "faction_id" => $factionId],
        ]);

        //get Tau ID for Tau fleet lists
        $factionId = Faction::getByName('Tau')->id;
        $fleetLists = array_merge($fleetLists, [
            ["name" => "Kor'vattra Fleet List", "faction_id" => $factionId],
            ["name" => "Commerce Protection Fleet List", "faction_id" => $factionId],
            ["name" => "Demiurg and Kroot Xenos Fleet List", "faction_id" => $factionId],
        ]);

        foreach ($fleetLists as $fleetList) {
            FleetList::create($fleetList);
        }

    }
}
