<?php

namespace Database\Seeders;

use App\Models\Armament;
use App\Models\Faction;
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
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Emperor Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 365,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
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
                    ]
                ],
                [
                    "class" => "Victory Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Oberon Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 335,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
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
                    ]
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
                    ]
                ],
                [
                    "class" => "Exorcist Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0]
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
                    ]
                ],
                //Battlecruisers
                [
                    "class" => "Mars Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 270,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Dominion Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Jovian Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 1]
                    ]
                ],
                [
                    "class" => "Mercury Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 255,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
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
                    ]
                ],
                //Cruisers
                [
                    "class" => "Dictator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 220,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Dominator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 190,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0]
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
                    ]

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
                    ]
                ],
                [
                    "class" => "Defiant Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 120,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
                ],
                [
                    "class" => "Viper Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 35,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ]
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
                    ]
                ],
                [
                    "class" => "Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2]
                    ],
                    "fleet_lists" => [] //TODO [alpha]: implement some logic to have transport ships available for all fleet lists
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
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+", "turrets" => 3, "points" => 425,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0]
                    ]
                ],
                //Cruisers
                [
                    "class" => "Strike Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "6+", "turrets" => 2, "points" => 145,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 5, "is_reserve" => 0],
                        ["fleet_list_id" => 6, "is_reserve" => 0],
                        ["fleet_list_id" => 7, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0]
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
                    ]
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
                    ]
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
                    ]
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
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ]
                ],
            ],
            "Inquisition" => [
                [
                    "class" => "Grey Knights Battle barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+", "turrets" => 3, "points" => 440,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ]
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
                    ]
                ],
                [
                    "class" => "Inquisitorial Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "6+", "turrets" => 2, "points" => 270,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Grey Knights Strike Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 2, "armour" => "6+", "turrets" => 2, "points" => 165,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
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
                    ]
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
                    ]
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
                    ]
                ],
                [
                    "class" => "Fra'al Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
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
                    ]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
                ],
                [
                    "class" => "Chaos Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 410,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 16, "is_reserve" => 0],
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Scion Of Prospero, Thousand Sons Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 450,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 9],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 9],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 18, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Wage Of Sin, Emperor's Children Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 25, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 430,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 21, "is_reserve" => 0]
                    ]
                ],
                [
                    "class" => "Terminus Est, Death Guard Battle Barge", "type" => "Battleship", "hitpoints" => 13, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 430,
                    "armaments" => [
                        ["type" => "Hives Of Nurgle", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Hives Of Nurgle", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 19, "is_reserve" => 0]
                    ]
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
                    ]
                ],
                [
                    "class" => "Despoiler Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 400,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
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
                    ]
                ],
                //Grand Cruisers
                [
                    "class" => "Retaliator Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 17, "is_reserve" => 0],
                        ["fleet_list_id" => 18, "is_reserve" => 0],
                        ["fleet_list_id" => 19, "is_reserve" => 0],
                        ["fleet_list_id" => 20, "is_reserve" => 0],
                        ["fleet_list_id" => 21, "is_reserve" => 0]
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
                    ]
                ],
                //Heavy Cruisers
                [
                    "class" => "Styx Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
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
                    ]
                ],
                [
                    "class" => "Hecate Class Heavy Cruiser", "type" => "Heavy Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
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
                    ]
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
                    ]
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
                    ]
                ],
                //Cruisers
                [
                    "class" => "Devastation Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 190,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
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
                    ]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
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
                    ]
                ],
                [
                    "class" => "Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2]
                    ],
                    "fleet_lists" => []
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
            foreach ($faction as $shipData) {

                $armamentsData = $shipData['armaments'];
                unset($shipData['armaments']);
                $fleetListsData = $shipData['fleet_lists'];
                unset($shipData['fleet_lists']);

                $ship = Ship::create($shipData);

                foreach ($armamentsData as $armamentData) {
                    $armament = Armament::firstOrCreate([
                        "type" => $armamentData['type'],
                        'placement' => $armamentData['placement'],
                        'fire_arc' => $armamentData['fire_arc'],
                    ]);

                    $ship->armaments()->attach($armament->id, [
                        'range_speed' => $armamentData['range_speed'],
                        'firepower' => $armamentData['firepower'],
                    ]);
                }

                foreach ($fleetListsData as $fleetListData) {
                    $ship->fleetLists()->attach($fleetListData['fleet_list_id'], [
                        'is_reserve' => $fleetListData['is_reserve'],
                    ]);
                }
            }
        }
    }
}
