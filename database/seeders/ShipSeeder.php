<?php

namespace Database\Seeders;

use App\Models\Armament;
use App\Models\Faction;
use App\Models\Modification;
use App\Models\Refit;
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null]
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5, "misc" => null]
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
                        ["name" => "shark_assault", "points" => 5, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "F: 30cm, B: 20cm"
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Retribution Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 12, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9, "misc" => null]
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "torpedoes_over_nova_cannon", "points" => -10, "pivots" => [
                                [
                                    "firepower" => 9, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Oberon Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 335,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5, "misc" => null],
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
                        ["name" => "shark_assault", "points" => 5, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "F: 30cm, B: 20cm, A: 30cm"
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Vanquisher Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 5, "points" => 300,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 10, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 10, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Prow"
                    ],
                    "refits" => [
                        ["name" => "shark_assault", "points" => 10, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "F: 30cm, B: 20cm, A: 30cm"
                                ]
                            ]
                        ],
                        ["name" => "short_range_weapons_battery", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 10, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Avenger Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 200,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 16, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 16, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "targeting_matrix", "points" => 15, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "turrets", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 3, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Dominion Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Up-rated Engineering Plants"
                    ],
                    "refits" => [
                        ["name" => "torpedoes_over_nova_cannon", "points" => -20, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "long_range_weapons_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => 60, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Armageddon Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 235,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "nova_cannon_over_torpedoes", "points" => 20, "pivots" => [
                                [
                                    "firepower" => 1, "range_speed" => null, "misc" => "30-150"
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Overlord Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 220,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "turrets", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 3, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "targeting_matrix", "points" => 15, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                //Cruisers
                [
                    "class" => "Dictator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 220,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "long_range_weapons_battery_low_firepower", "points" => -5, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Tyrant Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 185,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 4, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [],
                    "refits" => [
                        ["name" => "long_range_weapons_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "nova_cannon_over_torpedoes", "points" => 20, "pivots" => [
                                [
                                    "firepower" => 1, "range_speed" => null, "misc" => "30-150"
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Gothic Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 180,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["name" => "nova_cannon_over_torpedoes", "points" => 20, "pivots" => [
                                [
                                    "firepower" => 1, "range_speed" => null, "misc" => "30-150"
                                ]
                            ]
                        ],
                    ]
                ],
                //Light Cruisers
                [
                    "class" => "Endeavour Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 3, "is_reserve" => 0],
                        ["fleet_list_id" => 8, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 1],
                        ["fleet_list_id" => 34, "is_reserve" => 1]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "increased_front_armour", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "6+ front / 5+"
                                ],
                                [
                                    "firepower" => 45, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Endeavour Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "increased_front_armour", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "6+ front / 5+"
                                ],
                                [
                                    "firepower" => 45, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["name" => "increased_front_armour", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "6+ front / 5+"
                                ],
                                [
                                    "firepower" => 45, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 4, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Resilient Mid-ship Corridor"
                    ],
                    "refits" => [
                        ["name" => "increased_front_armour", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "6+ front / 5+"
                                ],
                                [
                                    "firepower" => 45, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Defiant Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 120,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["name" => "increased_front_armour", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => "6+ front / 5+"
                                ],
                                [
                                    "firepower" => 45, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Dauntless Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 110,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 1, "is_reserve" => 0],
                        ["fleet_list_id" => 2, "is_reserve" => 0],
                        ["fleet_list_id" => 13, "is_reserve" => 0],
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 1],
                        ["fleet_list_id" => 34, "is_reserve" => 1]
                    ],
                    "rules" => [
                        "Improved Thrusters"
                    ],
                    "refits" => [
                        ["name" => "torpedoes_over_lance_battery", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Siluria Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 100,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4, "misc" => null]
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
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null]
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
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["name" => "long_range_sensors", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Imperial Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2, "misc" => null]
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
                        ["type" => "Bombardment Cannon", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 20cm"],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F/B: 20cm"],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 20cm"],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
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
                        ["name" => "torpedoes_over_launch_bays", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "bombardment_cannon_over_launch_bays", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 5, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "lance_battery_over_bombardment_cannon", "points" => 20, "pivots" => [
                                [
                                    "firepower" => 1, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "shields", "points" => 15, "pivots" => [
                                [
                                    "firepower" => 2, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                    ]
                ],
                //Escorts
                [
                    "class" => "Nova Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 35, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 45,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4, "misc" => null]
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
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                    "class" => "Omnissiah's Victory, Ark Mechanicus", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 415,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 10, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 10, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 1, "misc" => "30-150"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 8, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Massive"
                    ],
                    "refits" => [
                        ["name" => "launch_bays_over_lance_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 2, "range_speed" => null, "misc" => "F: 30cm, B: 20cm"
                                ],
                                [
                                    "firepower" => 2, "range_speed" => null, "misc" => "F: 30cm, B: 20cm"
                                ]
                            ]
                        ],
                    ]
                ],
            ],
            "Inquisition" => [
                [
                    "class" => "Grey Knights Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+", "turrets" => 3, "points" => 440,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 12, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F/B: 20cm"],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
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
                    "class" => "Blackship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 5, "armour" => "6+ front / 5+", "turrets" => 5, "points" => 300,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 10, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 10, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 20cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Exterminatus"
                    ],
                    "refits" => [
                        ["name" => "torpedoes_over_launch_bays", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "lance_battery_over_bombardment_cannon", "points" => 15, "pivots" => [
                                [
                                    "firepower" => 2, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Grey Knights Strike Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 2, "armour" => "6+", "turrets" => 2, "points" => 165,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 20cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 9, "is_reserve" => 0]
                    ],
                    "rules" => [
                        "Improved Thrusters",
                        "Grey Knights"
                    ],
                    "refits" => [
                        ["name" => "torpedoes_over_launch_bays", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 6, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "bombardment_cannon_over_launch_bays", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 5, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                    ]
                ],
            ],
            "Rogue Traders" => [
                [
                    "class" => "Fra'al Battleship", "type" => "Battleship", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 250,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 14, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 14, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null],
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
                    "class" => "Rogue Trader Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 185,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
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
                        ["name" => "rogue_trader_cruiser_class_refit", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ],
                            "children-refits" => [
                                [
                                    "name" => "class_refit_lunar", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                [
                                    "name" => "class_refit_tyrant", "points" => 0, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                [
                                    "name" => "class_refit_carnage", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                [
                                    "name" => "class_refit_murder", "points" => 0, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Heavy Transport", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 15, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 40,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 3, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 3, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2, "misc" => null],
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
                        ["name" => "xenotech_refit", "points" => 10, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ],
                            "children-refits" => [
                                ["name" => "xenotech_long_range_sensors", "points" => 0, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                ["name" => "xenotech_targeting_matrix", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                ["name" => "shields", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => 3, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                ["name" => "turrets", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => 3, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                ["name" => "advanced_drive_technology", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => 20, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                                ["name" => "gravitic_thrusters", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => 90, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        ["name" => "fuel_tanker", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "repair_tender", "points" => 50, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "super_heavy_transport", "points" => 50, "pivots" => [
                                [
                                    "firepower" => 10, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Xenos Vessel", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Front", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Disruptor Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Whisperlance Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null]
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
                        ["name" => "fast_clipper", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ],
                            "children-refits" => [
                                ["name" => "advanced_drive_technology", "points" => 0, "pivots" => [
                                        [
                                            "firepower" => 30, "range_speed" => null, "misc" => null
                                        ],
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Escort Carrier", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 60,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Q-Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 60,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Armed Freighter", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 20,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 15, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Stryxis Caravan Vessel", "type" => "Defence", "hitpoints" => 8, "speed" => 10, "turns" => 0, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 80,
                                    "armaments" => [
                        ["type" => "Ghost-Light Macrobattery", "placement" => "", "fire_arc" => "All Round", "range_speed" => 45, "firepower" => 10, "misc" => null],
                        ["type" => "Ghost-Light Lance", "placement" => "", "fire_arc" => "All Round", "range_speed" => 30, "firepower" => 3, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 9, "misc" => null],
                        ["type" => "Armageddon Gun", "placement" => "", "fire_arc" => "Front", "range_speed" => 90, "firepower" => 0, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
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
                        ["name" => "chaos_lord", "points" => 25, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "chaos_space_marines", "points" => 35, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ],
                            ],
                            "children-refits" => [
                                ["name" => "chosen_terminators", "points" => 10, "pivots" => [
                                        [
                                            "firepower" => null, "range_speed" => null, "misc" => null
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        ["name" => "short_range_weapons_battery", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 8, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "short_range_weapons_battery", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 10, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "torpedoes_over_lance_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 8, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "short_range_dorsal_lance_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 4, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Scion Of Prospero, Thousand Sons Battle Barge", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 450,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 9, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 9, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9, "misc" => null],
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
                        ["type" => "Hives Of Nurgle", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Hives Of Nurgle", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
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
                        ["name" => "torpedoes_over_lance_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => 8, "range_speed" => 30, "misc" => null
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Desolator Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 25, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 4, "points" => 300,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
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
                        ["name" => "improved_thrusters", "points" => 0, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Repulsive Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 230,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 14, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 14, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["name" => "long_range_lance_battery", "points" => 10, "pivots" => [
                                [
                                    "firepower" => null, "range_speed" => 45, "misc" => null
                                ]
                            ]
                        ],
                        ["name" => "shields", "points" => 15, "pivots" => [
                                [
                                    "firepower" => 3, "range_speed" => null, "misc" => null
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "class" => "Executor Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 210,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 10, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 10, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 60, "firepower" => 2, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
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
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
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
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 10, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 10, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 60, "firepower" => 2, "misc" => null],

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
                        ["name" => "weapons_battery_and_lance_battery_over_weapons_battery", "points" => 0, "pivots" => [
                                [
                                    "firepower" => 4, "range_speed" => 45, "misc" => null
                                ],
                                [
                                    "firepower" => 2, "range_speed" => 45, "misc" => null
                                ],
                                [
                                    "firepower" => 2, "range_speed" => 45, "misc" => null
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    "class" => "Slaughter Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 30, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 2, "points" => 165,
                    "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null]
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
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2, "misc" => null]
                    ],
                    "fleet_lists" => [],
                    "rules" => [
                        "Transport Thrusters",
                        "Reduced Ld"
                    ],
                    "refits" => []
                ],

            ],
            "Eldar" => [
                [
                    "class" => "Void Stalker Class Battleship", "type" => "Battleship", "hitpoints" => 10, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 380,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Keel", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Weapons Battery", "placement" => "Keel", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Eclipse Class Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 250,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Keel", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm"],
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Shadow Class Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 210,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Keel", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 12, "misc" => null]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Aurora Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => '15/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 140,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Keel", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Solaris Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => '15/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 130,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 8, "misc" => null]
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Hellebore Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => '10/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 65,
                    "armaments" => [
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Keel", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Aconite Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => '10/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 55,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 5, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Hemlock Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => '15/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 40,
                    "armaments" => [
                        ["type" => "Pulsar Lance", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [
                        "Boarding Weakness"
                    ],
                    "refits" => []
                ],
                [
                    "class" => "Nightshade Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => '15/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 40,
                    "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Keel", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 22, "is_reserve" => 0],
                        ["fleet_list_id" => 23, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Flame Of Asuryan, Yriel's Flagship", "type" => "Cruiser", "hitpoints" => 8, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "5+", "turrets" => 0, "points" => 320,
                    "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Keel", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm, A: 30cm"],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 16, "misc" => null],
                        ["type" => "Pulsar Lance", "placement" => "Keel", "fire_arc" => "Left/Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Pulsar Lance", "placement" => "Keel", "fire_arc" => "Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 24, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Dragonship", "type" => "Cruiser", "hitpoints" => 6, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "5+", "turrets" => 0, "points" => 260,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 14, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Keel", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 30cm, B: 20cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 24, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Wraithship", "type" => "Cruiser", "hitpoints" => 6, "speed" => '10/20/25', "turns" => null, "shields" => null, "armour" => "5+", "turrets" => 0, "points" => 160,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Keel", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 30cm, B: 20cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 24, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Shadowhunter", "type" => "Escort", "hitpoints" => 1, "speed" => '15/20/30', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 40,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 24, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Eldar Transport", "type" => "Escort", "hitpoints" => 1, "speed" => '10/10/15', "turns" => null, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 0,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Dark Eldar" => [
                [
                    "class" => "Torture Class Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 35, "turns" => 90, "shields" => null, "armour" => "5+", "turrets" => 0, "points" => 210,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 12, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 25, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Corsair Class Escort", "type" => "Escort", "hitpoints" => 1, "speed" => 40, "turns" => 90, "shields" => null, "armour" => "4+", "turrets" => 0, "points" => 50,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 25, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Orks" => [
                [
                    "class" => "Hammer Class Battlekroozer", "type" => "Battlecruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 245,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => "D3+1", "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => [
                        #There is OR armament refit needed for Bombardment Cannon
                    ]
                ],
                [
                    "class" => "Deathdeala Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 275,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Bombardment Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => "D3+1", "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6+4", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6+4", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Gorbag's Revenge Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 310,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => "D3+1", "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 25cm, A: 30cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Slamblasta Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 295,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => "D3+1", "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6+6", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kroolboy Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 270,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+6", "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => "D3+1", "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Terror Ship", "type" => "Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 5+ sides / 4+ rear", "turrets" => 1, "points" => 185,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F/B: 25cm, A: 30cm"],
                        ["type" => "Heavy Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+2", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Zukov's Klaw Assault Kroozer", "type" => "Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 5+ sides / 4+ rear", "turrets" => 1, "points" => 210,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => "2/Special", "misc" => "A: 30cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => "2/Special", "misc" => "A: 30cm"],
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+2", "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => "D6+2", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kill Kroozer", "type" => "Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 5+ sides / 4+ rear", "turrets" => 1, "points" => 155,
                    "armaments" => [
                        ["type" => "Heavy Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 15, "firepower" => 4, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 15, "firepower" => 4, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 6, "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => "D6+2", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lite Kroozer", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 5+ sides / 4+ rear", "turrets" => 1, "points" => 90,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => "D3+1", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => "D3+1", "misc" => null],
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Heavy Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 4, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Onslaught Attack Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 4+", "turrets" => 1, "points" => 35,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Savage Gunship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 45, "shields" => 1, "armour" => "6+ front / 4+", "turrets" => 1, "points" => 30,
                    "armaments" => [
                        ["type" => "Heavy Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => 4, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Ravager Attack Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "6+ front / 4+", "turrets" => 2, "points" => 40,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => "D6", "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Brute Ram Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "6+ front / 4+", "turrets" => 1, "points" => 25,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Grunt Assault Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 45, "shields" => 1, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 30,
                    "armaments" => [
                        ["type" => "Gunz Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 26, "is_reserve" => 0],
                        ["fleet_list_id" => 27, "is_reserve" => 0],
                        ["fleet_list_id" => 28, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Necrons" => [
                [
                    "class" => "Cairn Class Tombship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => '4+ save', "armour" => "6+", "turrets" => 4, "points" => 500,
                    "armaments" => [
                        ["type" => "Lightning Arc", "placement" => null, "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Star Pulse Generator", "placement" => null, "fire_arc" => "All Around", "range_speed" => 20, "firepower" => '1 per enemy', "misc" => null],
                        ["type" => "Gauss Particle Whip", "placement" => null, "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Portal", "placement" => null, "fire_arc" => "All Around", "range_speed" => 10, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 29, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Scythe Class Harvest Ship", "type" => "Cruiser", "hitpoints" => 8, "speed" => 30, "turns" => 45, "shields" => '5+ save', "armour" => "6+", "turrets" => 3, "points" => 275,
                    "armaments" => [
                        ["type" => "Lightning Arc", "placement" => null, "fire_arc" => "Left/Right", "range_speed" => 30, "firepower" => 8, "misc" => null],
                        ["type" => "Star Pulse Generator", "placement" => null, "fire_arc" => "All Around", "range_speed" => 20, "firepower" => '1 per enemy', "misc" => null],
                        ["type" => "Gauss Particle Whip", "placement" => null, "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Portal", "placement" => null, "fire_arc" => "Left/Front/Right", "range_speed" => 10, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 29, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Shroud Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 30, "turns" => 45, "shields" => '5+ save', "armour" => "6+", "turrets" => 1, "points" => 155,
                    "armaments" => [
                        ["type" => "Lightning Arc", "placement" => null, "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 10, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 29, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Jackal Class Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 40, "turns" => 90, "shields" => '6+ save', "armour" => "6+", "turrets" => 1, "points" => 50,
                    "armaments" => [
                        ["type" => "Lightning Arc", "placement" => null, "fire_arc" => "Front", "range_speed" => 30, "firepower" => 4, "misc" => null],
                        ["type" => "Portal", "placement" => null, "fire_arc" => "All Around", "range_speed" => 10, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 29, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Dirge Class Raider", "type" => "Escort", "hitpoints" => 1, "speed" => 50, "turns" => 90, "shields" => '6+ save', "armour" => "6+", "turrets" => 1, "points" => 40,
                    "armaments" => [
                        ["type" => "Lightning Arc", "placement" => null, "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 29, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Tyranids" => [
                [
                    "class" => "Hive Ship", "type" => "Battleship", "hitpoints" => 10, "speed" => 15, "turns" => 45, "shields" => null, "armour" => "5+", "turrets" => 4, "points" => 200,
                    "armaments" => [],
                    "fleet_lists" => [
                        ["fleet_list_id" => 31, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Cruiser", "type" => "Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 45, "shields" => null, "armour" => "5+", "turrets" => 2, "points" => 80,
                    "armaments" => [],
                    "fleet_lists" => [
                        ["fleet_list_id" => 31, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kraken", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => null, "armour" => "6+", "turrets" => 0, "points" => 25,
                    "armaments" => [],
                    "fleet_lists" => [
                        ["fleet_list_id" => 30, "is_reserve" => 0],
                        ["fleet_list_id" => 31, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Vanguard Drone Ship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => null, "armour" => "5+", "turrets" => 1, "points" => 20,
                    "armaments" => [],
                    "fleet_lists" => [
                        ["fleet_list_id" => 30, "is_reserve" => 0],
                        ["fleet_list_id" => 31, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Escort Drone", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 90, "shields" => null, "armour" => "5+", "turrets" => 1, "points" => 10,
                    "armaments" => [],
                    "fleet_lists" => [
                        ["fleet_list_id" => 31, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ],
            "Tau" => [
                [
                    "class" => "Gal'leath/Explorer Class Starship (Vash'ya)", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+/ 4+ rear", "turrets" => 5, "points" => 230,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Gravitic Hook", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Gal'leath/Explorer Class Starship (Bork'an)", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+/ 4+ rear", "turrets" => 5, "points" => 230,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 8, "misc" => "20-40cm"],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Gravitic Hook", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Or'es El'leath/Custodian Class Battleship", "type" => "Battleship", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 330,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 1, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 1, "misc" => null],
                        ["type" => "Gravitic Hook", "placement" => "Stern", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:3 Wardens"],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 8, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "'Stronghold' Commerce Vessel", "type" => "Battleship", "hitpoints" => 10, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 350,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 3, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 3, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 14, "misc" => null],
                        ["type" => "Cutting Beam", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => "Special (max 8)", "misc" => null],
                        ["type" => "Torpedo Silos", "placement" => "Dorsal", "fire_arc" => "All Round", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => null, "range_speed" => null, "firepower" => 3, "misc" => "F: 30cm,B: 20cm,A: 30cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lar'shi/Hero Class Starship (Vash'ya)", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 180,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 6, "misc" => "20-40cm"],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lar'shi/Hero Class Starship (T'olku)", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "5+", "turrets" => 3, "points" => 180,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 6, "misc" => "20-40cm"],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lar'shi'vre/Protector Class Cruiser (T'olku)", "type" => "Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 185,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 6, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 5, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Lar'shi'vre/Protector Class Cruiser (Vior'la)", "type" => "Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 185,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 1, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 1, "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 1, "misc" => "F: 25cm,B: 20cm"],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 5, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "'Bastion' Commerce Vessel", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 255,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Cutting Beam", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => "Special (max 8)", "misc" => null],
                        ["type" => "Launch Bays", "placement" => "Dorsal", "fire_arc" => "All Around", "range_speed" => null, "firepower" => "3sq / 4tor", "misc" => "F: 25cm,B: 20cm; A: 30cm: T:30cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "'Citadel' Commerce Vessel", "type" => "Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 185,
                    "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6, "misc" => null],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 45, "firepower" => 8, "misc" => null],
                        ["type" => "Cutting Beam", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 15, "firepower" => "Special (max 8)", "misc" => null],
                        ["type" => "Torpedo Silos", "placement" => "Dorsal", "fire_arc" => "All Around", "range_speed" => null, "firepower" => 4, "misc" => "F: 25cm,B: 20cm; A: 30cm: T:30cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 14, "is_reserve" => 0],
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'fannor/Merchant Class Starship (Ke'lshan)", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 95,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Gravitic Hook", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Orca/Warden"],
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'fannor/Merchant Class Starship (Dal'yth)", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 95,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'porrui/Emissary Class Envoy Ship (Dal'yth)", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Gravitic Hook", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Warden"],
                        ["type" => "Launch Bays", "placement" => "Prow", "fire_arc" => null, "range_speed" => null, "firepower" => 2, "misc" => "F: 25cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'porrui/Emissary Class Envoy Ship (Bork'an)", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 4, "misc" => null],
                        ["type" => "Gravitic Hook", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Warden"],
                        ["type" => "Gravitic Hook", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => null, "misc" => "Capacity:1 Warden"],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 3, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'porrui/Emissary Class Envoy Ship (Sa'cea)", "type" => "Light Cruiser", "hitpoints" => 4, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 45, "firepower" => 3, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 45, "firepower" => 3, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Port", "fire_arc" => "Left/Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Starboard", "fire_arc" => "Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 3, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kir'qath/Defender Class Starship", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 45,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 2, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Skether'qan/Messenger Class Starship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kass'l/Orca Class Gunship", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 25,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kir'shashvre/Castellan Class Escort", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 50,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 45, "firepower" => 2, "misc" => null],
                        ["type" => "Gravitic Launcher", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => null, "firepower" => 2, "misc" => "20-40cm"],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Kir'la/Warden Class Gunship", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 30,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2, "misc" => null],
                        ["type" => "Ion Cannon", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Il'emaar/Courier Class Merchant Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2, "misc" => null],
                    ],
                    "fleet_lists" => [],
                    "rules" => [],
                    "refits" => []
                ],
                [
                    "class" => "Dhow", "type" => "Escort", "hitpoints" => 1, "speed" => 20, "turns" => 180, "shields" => 2, "armour" => "5+", "turrets" => 1, "points" => 45,
                    "armaments" => [
                        ["type" => "Railgun Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 3, "misc" => null],
                        ["type" => "Railgun Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 3, "misc" => null],
                    ],
                    "fleet_lists" => [
                        ["fleet_list_id" => 32, "is_reserve" => 0],
                        ["fleet_list_id" => 33, "is_reserve" => 0],
                        ["fleet_list_id" => 34, "is_reserve" => 0],
                    ],
                    "rules" => [],
                    "refits" => []
                ],
            ]
        ];


        foreach ($shipList as $faction=>$shipsData) {

            // Get faction id
            $factionId = Faction::getByName($faction)->id;

            foreach ($shipsData as $shipData) {
                //Extract related objects data
                $armamentsData = $shipData['armaments'];
                unset($shipData['armaments']);
                $fleetListsData = $shipData['fleet_lists'];
                unset($shipData['fleet_lists']);
                $rulesData = $shipData['rules'];
                unset($shipData['rules']);
                $refitsData = $shipData['refits'];
                unset($shipData['refits']);

                //Create ship
                $shipData['faction_id'] = $factionId;
                $ship = Ship::create($shipData);

                //Create armaments and attach them to ship
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

                //Attach fleet list to ship
                foreach ($fleetListsData as $fleetListData) {
                    $ship->fleetLists()->attach($fleetListData['fleet_list_id'], [
                        'is_reserve' => $fleetListData['is_reserve'],
                    ]);
                }

                //Attach rules to ship
                foreach ($rulesData as $ruleName) {
                    $rule = Rules::getRuleByName($ruleName);

                    $ship->rules()->attach($rule->id);
                }

                //Attach refits and modifications to ship
                foreach ($refitsData as $refitData) {
                    try {
                        //Attach refit to ship
                        $refit = Refit::getByName($refitData['name']);

                        $ship->refits()->attach($refit->id, [
                            'points' => $refitData['points']
                        ]);

                        $lastPivot = $ship->refits()->newPivotStatement()
                            ->select('id')
                            ->where('ship_id', $ship->id)
                            ->where('refit_id', $refit->id)
                            ->latest('id')
                            ->first();

                        //Attach modification to ship
                        $modifications = Modification::byRefitName($refitData['name'])->get();

                        for ($i = 0; $i < count($modifications); $i++) {
                            $ship->modifications()->attach($modifications[$i]->id, [
                                'ship_refit_id' => $lastPivot->id,
                                'firepower' => $refitData['pivots'][$i]['firepower'],
                                'range_speed' => $refitData['pivots'][$i]['range_speed'],
                                'misc' => $refitData['pivots'][$i]['misc'],
                            ]);

                            //If one of the modifications is of type group that means refit has children. Attach refit children to ship
                            if ($modifications[$i]->type == 'group') {
                                $childrenRefitsData = $refitData['children-refits'];
                                for ($j = 0; $j < count($childrenRefitsData); $j++) {
                                    $childrenRefit = Refit::getByName($childrenRefitsData[$j]['name']);

                                    $ship->refits()->attach($childrenRefit->id, [
                                        'points' => $childrenRefitsData[$j]['points']
                                    ]);

                                    $lastChildPivot = $ship->refits()->newPivotStatement()
                                        ->select('id')
                                        ->where('ship_id', $ship->id)
                                        ->where('refit_id', $childrenRefit->id)
                                        ->latest('id')
                                        ->first();

                                    //Attach modification for children refits to ship
                                    $childrenModifications = Modification::byRefitName($childrenRefitsData[$j]['name'])->get();
                                    $childrenModsData = $childrenRefitsData[$j]['pivots'];

                                    for ($k = 0; $k < count($childrenModifications); $k++) {
                                        $ship->modifications()->attach($childrenModifications[$k]->id, [
                                            'ship_refit_id' => $lastChildPivot->id,
                                            'firepower' => $childrenModsData[$k]['firepower'],
                                            'range_speed' => $childrenModsData[$k]['range_speed'],
                                            'misc' => $childrenModsData[$k]['misc'],
                                        ]);
                                    }
                                }
                            }
                        }


                    } catch (\Exception $exception) {
                        $this->command->getOutput()->error($exception->getMessage());
                        $this->command->getOutput()->error($refitData['name'] . ' ship: ' . $ship->class);
                    }
                }
            }
        }
    }
}
