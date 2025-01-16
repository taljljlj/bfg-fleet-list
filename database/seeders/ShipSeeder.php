<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ships = [
            "Imperium" => [
                //Battleships
                [
                    "class" => "Apocalypse Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 365, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6]
                    ]
                ],
                [
                    "class" => "Emperor Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 365, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5]
                    ]
                ],
                [
                    "class" => "Retribution Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 12],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 9]
                    ]
                ],
                [
                    "class" => "Victory Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 20, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 4, "points" => 345, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Oberon Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "5+", "turrets" => 5, "points" => 335, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 5],
                    ]
                ],
                [
                    "class" => "Vanquisher Class Battleship", "type" => "Battleship", "hitpoints" => 12, "speed" => 15, "turns" => 45, "shields" => 4, "armour" => "6+ front / 5+", "turrets" => 5, "points" => 300, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                //Grand Cruisers
                [
                    "class" => "Vengeance Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 230, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 10],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 10],
                    ]
                ],
                [
                    "class" => "Exorcist Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 230, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 8],
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Avenger Class Grand Cruiser", "type" => "Grand Cruiser", "hitpoints" => 10, "speed" => 20, "turns" => 45, "shields" => 3, "armour" => "5+", "turrets" => 3, "points" => 200, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 16],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 16],
                    ]
                ],
                //Battlecruisers
                [
                    "class" => "Mars Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 270, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Dominion Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                [
                    "class" => "Jovian Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 260, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 3],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Mercury Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 25, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 255, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Armageddon Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 235, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Overlord Class Battlecruiser", "type" => "Battlecruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 220, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 60, "firepower" => 8],
                        ["type" => "Lance Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 60, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                //Cruisers
                [
                    "class" => "Dictator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 3, "points" => 220, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                [
                    "class" => "Dominator Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 190, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 12],
                        ["type" => "Nova Cannon", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 150, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Tyrant Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 185, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 45, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                [
                    "class" => "Gothic Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 180, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                [
                    "class" => "Lunar Class Cruiser", "type" => "Cruiser", "hitpoints" => 8, "speed" => 20, "turns" => 45, "shields" => 2, "armour" => "6+ front / 5+", "turrets" => 2, "points" => 180, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 6],
                    ]
                ],
                //Light Cruisers
                [
                    "class" => "Endeavour Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Endeavour Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 110, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Endurance Class Light Cruiser (Bakka)", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 3, "points" => 115, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Lance Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Defiant Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 20, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 120, "armaments" => [
                        ["type" => "Launch Bays", "placement" => "Port", "fire_arc" => null, "range_speed" => null, "firepower" => 1],
                        ["type" => "Launch Bays", "placement" => "Starboard", "fire_arc" => null, "range_speed" => null, "firepower" => 1],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Dauntless Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 110, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 4],
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3],
                    ]
                ],
                [
                    "class" => "Siluria Class Light Cruiser", "type" => "Light Cruiser", "hitpoints" => 6, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 100, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Port", "fire_arc" => "Left", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Starboard", "fire_arc" => "Right", "range_speed" => 30, "firepower" => 6],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                //Escorts
                [
                    "class" => "Firestorm Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 40, "armaments" => [
                        ["type" => "Lance Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Falchion Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 35, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Havoc Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 35, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 3],
                        ["type" => "Weapons Battery", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                    ]
                ],
                [
                    "class" => "Sword Class Frigate", "type" => "Escort", "hitpoints" => 1, "speed" => 25, "turns" => 90, "shields" => 1, "armour" => "5+", "turrets" => 2, "points" => 35, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 4]
                    ]
                ],
                [
                    "class" => "Viper Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 35, "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 3]
                    ]
                ],
                [
                    "class" => "Cobra Class Destroyer", "type" => "Escort", "hitpoints" => 1, "speed" => 30, "turns" => 90, "shields" => 1, "armour" => "4+", "turrets" => 1, "points" => 30, "armaments" => [
                        ["type" => "Torpedoes", "placement" => "Prow", "fire_arc" => "Front", "range_speed" => 30, "firepower" => 2],
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 30, "firepower" => 1],
                    ]
                ],
                [
                    "class" => "Transport", "type" => "Escort", "hitpoints" => 1, "speed" => 15, "turns" => 45, "shields" => 1, "armour" => "5+", "turrets" => 1, "points" => 0, "armaments" => [
                        ["type" => "Weapons Battery", "placement" => "Dorsal", "fire_arc" => "Left/Front/Right", "range_speed" => 15, "firepower" => 2]
                    ]
                ],
            ],
            "Space Marines" => [
                [
                    "class" => "", "type" => "", "hitpoints" => , "speed" => , "turns" => , "shields" => , "armour" => "", "turrets" => , "points" => , "armaments" => [
                        ["type" => "", "placement" => "", "fire_arc" => "", "range_speed" => , "firepower" => ]
                    ]
                ],
            ]
        ];


        //Imperial ships
        $factionId = Faction::getByName('Imperium')->id;
        $ships = array_merge($ships, [
           ["faction_id" => $factionId, "class" => "", "type" => "", "hitpoints" => , "speed" => , "turns" => , "shields" => , "armour" => "", "turrets" => , "points" => ],
        ]);
    }
}
