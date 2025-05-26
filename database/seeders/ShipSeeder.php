<?php

namespace Database\Seeders;

use App\Models\Armament;
use App\Models\Faction;
use App\Models\Refits;
use App\Models\Rules;
use App\Models\Ship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //TODO [beta]: read the fine prints of the rulebook and fleets book, every fleet list has special rules, especially for reserves and mixing imperium factions. Figure out a way to implement this
        $shipList = [
            "Imperium" => [
                //Battleships
                [
                    "class" => "Apocalypse Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 365,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Lock On Lances"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Emperor Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 365,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Prow Sensors"
                    ],
                    "refits" => [
                        ["name" => "Shark Assault", "points" => 5, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Retribution Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 12],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Victory Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Nova Cannon", "points" => -10, "firepower" => 9, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Oberon Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 335,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Prow Sensors"
                    ],
                    "refits" => [
                        ["name" => "Shark Assault", "points" => 5, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Vanquisher Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 5, "points" => 300,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                //Grand Cruisers
                [
                    "class" => "Vengeance Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 10],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Exorcist Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => [
                        ["name" => "Shark Assault", "points" => 10, "firepower" => null, "range_speed" => null],
                        ["name" => "Short Range Weapons Battery", "points" => 0, "firepower" => 10, "range_speed" => 30]
                    ]
                ],
                [
                    "class" => "Avenger Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 200,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 16],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 16],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => []
                ],
                //Battlecruisers
                [
                    "class" => "Mars Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 270,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Targeting Matrix", "points" => 15, "firepower" => null, "range_speed" => null],
                        ["name" => "Turrets", "points" => 10, "firepower" => 1, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Dominion Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Jovian Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 1]
                    ],
                    "rules" => [
                        "Sensor Array",
                        "Resilient Prow"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Mercury Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 255,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Up-rated Engineering Plants"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Nova Cannon", "points" => -20, "firepower" => 6, "range_speed" => null],
                        ["name" => "Long Range Weapons Battery", "points" => 10, "firepower" => null, "range_speed" => 60]
                    ]
                ],
                [
                    "class" => "Armageddon Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 235,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Nova Cannon>Torpedoes", "points" => 20, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Overlord Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 220,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Turrets", "points" => 10, "firepower" => 1, "range_speed" => null],
                        ["name" => "Targeting Matrix", "points" => 15, "firepower" => null, "range_speed" => null]
                    ]
                ],
                //Cruisers
                [
                    "class" => "Dictator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 220,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Dominator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 190,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Long Range Weapons Battery", "points" => -5, "firepower" => 6, "range_speed" => 45]
                    ]
                ],
                [
                    "class" => "Tyrant Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 185,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Long Range Weapons Battery", "points" => 10, "firepower" => null, "range_speed" => 45],
                        ["name" => "Nova Cannon>Torpedoes", "points" => 20, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Gothic Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 180,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lunar Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 180,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Nova Cannon>Torpedoes", "points" => 20, "firepower" => null, "range_speed" => null]
                    ]
                ],
                //Light Cruisers
                [
                    "class" => "Endeavour Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 1],
                        ["fleet_list_id" => 35, "is_reserve" => 1]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "Increased Front Armour", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Endeavour Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "Increased Front Armour", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "Increased Front Armour", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "Increased Front Armour", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Defiant Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 120,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 1],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber", "firepower" => 1],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "Increased Front Armour", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Dauntless Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 110,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 1],
                        ["fleet_list_id" => 35, "is_reserve" => 1]
                    ],
                    "rules" => [
                        "Improved Thrusters"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Lance Battery", "points" => 0, "firepower" => 6, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Siluria Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 100,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Improved Thrusters"
                    ],
                    "refits" => []
                ],
                //Escorts
                [
                    "class" => "Firestorm Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 40,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Falchion Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 35,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Havoc Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 35,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Sword Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 35,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Viper Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 35,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Cobra Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 30,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Long Range Sensors", "points" => 0, "firepower" => null, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Imperial Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2]
                    ],
                    "fleet_lists" => [],
                    "rules" => [
                        "Transport Thrusters",
                        "Reduced Ld"
                    ],
                    "refits" => []
                    //TODO [alpha]: implement some logic to have transport ships available for all fleet lists
                ],
            ],
            "Space Marines" => [
                //Battleships TODO [alpha]: look into Venerable battle barges and how to include them in ship list
                [
                    "class" => "Sedition Opprimere, Venerable Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+", "turrets" => 4, "points" => 450,
                    "armaments" => [
                        ["type" => "Bombardment Cannon", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 8],
                        ["type" => "Bombardment Cannon", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 8],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+", "turrets" => 3, "points" => 425,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                //Light Cruisers
                [
                    "class" => "Strike Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "6+", "turrets" => 2, "points" => 145,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 2],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Torpedoes>Launch Bays", "points" => 0, "firepower" => 6, "range_speed" => 30],
                        ["name" => "Bombardment Cannon>Launch Bays", "points" => 0, "firepower" => 5, "range_speed" => 30],
                        ["name" => "Lance Battery>Bombardment Cannon", "points" => 20, "firepower" => 1, "range_speed" => 30],
                        ["name" => "Shields", "points" => 15, "firepower" => 1, "range_speed" => null],
                    ]
                ],
                //Escorts
                [
                    "class" => "Nova Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 35, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 45,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Gladius Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 40,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Hunter Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 35, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 35,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Adeptus Mechanicus" => [
                [
                    "class" => "Omnissiah's Victory, Ark Mechanicus", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ Front / 5+", "turrets" => 4, "points" => 415,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 10],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "misc" => "30-150cm", "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "Launch Bays>Lance Battery", "points" => 10, "firepower" => 2, "range_speed" => null],
                    ]
                ],
            ],
            "Inquisition" => [
                [
                    "class" => "Grey Knights Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+", "turrets" => 3, "points" => 440,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Grey Knights"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Blackship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 5, "armour" => "6+ Front / 5+", "turrets" => 5, "points" => 300,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 10],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Blackship Crew 1",
                        "Blackship Crew 2",
                        "Gellar Field",
                        "Prized Objective"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Inquisitorial Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "6+", "turrets" => 2, "points" => 270,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Exterminatus"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Launch Bays", "points" => 0, "firepower" => 6, "range_speed" => 30],
                        ["name" => "Lance Battery>Bombardment Cannon", "points" => 15, "firepower" => 2, "range_speed" => 45],
                    ]
                ],
                [
                    "class" => "Grey Knights Strike Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 2, "armour" => "6+", "turrets" => 2, "points" => 165,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Thunderhawk", "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Improved Thrusters",
                        "Grey Knights"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Launch Bays", "points" => 0, "firepower" => 6, "range_speed" => 30],
                        ["name" => "Bombardment Cannon>Launch Bays", "points" => 0, "firepower" => 5, "range_speed" => 30],
                    ]
                ],
            ],
            "Rogue Traders" => [
                [
                    "class" => "Fra'al Battleship", "type" => "Battleship", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 250,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 14],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 14],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 15, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Fra’al Targeting Matrix",
                        "Xenotech Included 2"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Rogue Trader Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ Front / 5+", "turrets" => 3, "points" => 185,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Rogue Trader Cruiser Class Refit", "points" => 0, "firepower" => null, "range_speed" => null],
                    ]
                ],
                [
                    "class" => "Heavy Transport", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 15, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 40,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 3],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 3],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Transport Thrusters",
                        "Heavy Transport"
                    ],
                    "refits" => [
                        ["name" => "Xenotech Refit", "points" => 10, "firepower" => null, "range_speed" => null],
                        ["name" => "Fuel Tanker", "points" => 0, "firepower" => null, "range_speed" => null],
                        ["name" => "Repair Tender", "points" => 50, "firepower" => null, "range_speed" => null],
                        ["name" => "Super-Heavy Transport", "points" => 50, "firepower" => null, "range_speed" => null],
                    ]
                ],
                [
                    "class" => "Xenos Vessel", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Front", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Pthuxutl War Cruiser", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Disruptor Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Disruptor Cannon",
                        "Xenotech Included 1"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Fra’al Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Fra’al Targeting Matrix",
                        "Xenotech Included 2"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Nekulli Whip", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Whisperlance Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Whisperlance Cannon",
                        "Xenotech Included 3"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Recommissioned Escort", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 30,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Cargo Vessel", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 20,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                        ["fleet_list_id" => 35, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Cargo Vessel",
                        "Ordnance Vessel"
                    ],
                    "refits" => [
                        ["name" => "Fast Clipper", "points" => 0, "firepower" => null, "range_speed" => null],
                    ]
                ],
                [
                    "class" => "Stryxis Caravan Vessel", "type" => "Defence", "hitpoints" => 8, "speed" => 10, "turns" => 0, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 80,
                                    "armaments" => [
                        ["type" => "Ghost-Light Macrobattery", "placement" => "", "fire_arc" => "All round", "range_speed" => 45, "firepower" => 10],
                        ["type" => "Ghost-Light Lance", "placement" => "", "fire_arc" => "All round", "range_speed" => 30, "firepower" => 3],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Ghost-Light",
                        "Stryxis Movement",
                    ],
                    "refits" => []
                ],
            ],
            "Chaos" => [
                //Battleships
                [
                    "class" => "The Planet Killer", "type" => "Battleship", "hitpoints" => 14, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 505,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 9],
                        ["type" => "Armageddon Gun", "placement" => "", "fire_arc" => "Front", "range_speed" => 90, "firepower" => 0],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Chaos Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 410,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "Chaos Lord", "points" => 25, "firepower" => 1, "range_speed" => null],
                        ["name" => "Chaos Space Marines", "points" => 35, "firepower" => null, "range_speed" => null],
                        ["name" => "Chosen Terminators", "points" => 10, "firepower" => null, "range_speed" => null],
                        ["name" => "Short Range Weapons Battery", "points" => 0, "firepower" => 8, "range_speed" => 45],
                        ["name" => "Short Range Weapons Battery", "points" => 0, "firepower" => 10, "range_speed" => 30],
                        ["name" => "Torpedoes>Lance Battery", "points" => 10, "firepower" => 8, "range_speed" => 30],
                        ["name" => "Short Range Lance Battery", "points" => 10, "firepower" => 4, "range_speed" => 45]
                    ]
                ],
                [
                    "class" => "Scion Of Prospero, Thousand Sons Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 450,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 9],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 9],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 18, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Mark Of Tzeentch",
                        "Vortex Of Chaos",
                        "Vagaries Of Fate"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Wage Of Sin, Emperor's Children Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 25, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 430,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Mark Of Slaanesh",
                        "Palace Of Pleasure"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Terminus Est, Death Guard Battle Barge", "type" => "Battleship", "hitpoints" => 13, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 430,
                    "armaments" => [
                        ["type" => "Hives Of Nurgle", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Hives Of Nurgle", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 19, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Mark Of Nurgle",
                        "Miasma Of Pestilence",
                        "Hives Of Nurgle",
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Slaverer, World Eaters Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 25, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 380,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 20, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive",
                        "Mark Of Khorne",
                        "World Eaters Chaos Space Marines",
                        "Berzerker Horde",
                        "Chosen Terminators"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Despoiler Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 400,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "Torpedoes>Lance Battery", "points" => 10, "firepower" => 8, "range_speed" => 30],
                    ]
                ],
                [
                    "class" => "Desolator Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 25, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 300,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => []
                ],
                //Grand Cruisers
                [
                    "class" => "Retaliator Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => [
                        ["name" => "Improved Thrusters", "points" => 0, "firepower" => null, "range_speed" => null],
                    ]
                ],
                [
                    "class" => "Repulsive Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 14],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 14],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Long Range Lance Battery", "points" => 10, "firepower" => null, "range_speed" => 45],
                        ["name" => "Shields", "points" => 15, "firepower" => 1, "range_speed" => null]
                    ]
                ],
                [
                    "class" => "Executor Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 210,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => []
                ],
                //Heavy Cruisers
                [
                    "class" => "Styx Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Hecate Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Hades Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 200,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 10],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 60, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Acheron Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 190,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                //Cruisers
                [
                    "class" => "Devastation Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 190,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "misc" => "Fighter,Bomber,Assault", "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Carnage Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 180,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Inferno Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 180,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Murder Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 170,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 10],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 60, "firepower" => 2],

                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "Weapons Battery&Lance Battery>Weapons Battery", "points" => 0, "firepower" => null, "range_speed" => null],
                    ]
                ],
                [
                    "class" => "Slaughter Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 30, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 165,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Improved Thrusters"
                    ],
                    "refits" => []
                ],
                //Escorts
                [
                    "class" => "Idolator Class Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 45,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Long Range Targeting Matrix"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Infidel Class Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 40,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Iconoclast Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 30,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Chaos Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2]
                    ],
                    "fleet_lists" => [],
                    "rules" => [
                        "Transport Thrusters",
                        "Reduced Ld"
                    ],
                    "refits" => []
                ],

            ]
        ];
// TODO: complete the ship seeder for remaining factions
//Single ship seeder template
//        [
//            "class" => "", "type" => "", "hitpoints" => , "speed" => , "turns" => , "shields" => , "armour" => "", "turrets" => , "points" => ,
//            "armaments" => [
//                ["type" => "", "placement" => "", "fire_arc" => "", "range_speed" => , "firepower" => ]
//            ],
//            "fleet_lists" => [
//                ["fleet_list_id" => , "is_reserve" => 0],
//            ]
//        ],


        foreach ($shipList as $faction) {
            //Faction layer of array was used before, leaving it as is in case it becomes useful again
            //$factionId = Faction::getByName($faction)->id;
            foreach ($faction as $shipData) {
                //$shipData['faction_id'] = $factionId;
                $armamentsData = $shipData['armaments'];
                unset($shipData['armaments']);
                $fleetListsData = $shipData['fleet_lists'];
                unset($shipData['fleet_lists']);
                $rulesData = $shipData['rules'];
                unset($shipData['rules']);
                $refitsData = $shipData['refits'];
                unset($shipData['refits']);

                $ship = Ship::create($shipData);

                foreach ($armamentsData as $armamentData) {
                    $armament = Armament::firstOrCreate([
                        "type" => $armamentData['type'],
                        'placement' => $armamentData['placement'],
                        'fire_arc' => $armamentData['fire_arc'],
                    ]);

                    $ship->armaments()->attach($armament->id, [
                        'range_speed' => $armamentData['range_speed'] ?: null,
                        'firepower' => $armamentData['firepower'],
                        'misc' => $armamentData['misc'] ?: null
                    ]);
                }

                foreach ($fleetListsData as $fleetListData) {
                    $ship->fleetLists()->attach($fleetListData['fleet_list_id'], [
                        'is_reserve' => $fleetListData['is_reserve'],
                    ]);
                }

                foreach ($rulesData as $ruleName) {
                    $rule = Rules::getRuleByName($ruleName);

                    $ship->rules()->attach($rule->id);
                }

                foreach ($refitsData as $refitData) {
                    $refit = Refits::getRuleByName($refitData['name']);

                    $ship->refits()->attach($refit->id, [
                        'points' => $refitData['points'],
                        'firepower' => $refitData['firepower'],
                        'range_speed' => $refitData['range_speed'],
                    ]);
                }
            }
        }
    }
}
