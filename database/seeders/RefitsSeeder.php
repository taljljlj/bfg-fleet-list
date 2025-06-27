<?php

namespace Database\Seeders;

use App\Models\Modification;
use App\Models\Refit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refits = [
            [
                "name" => "shark_assault",
                "text" => "Include Shark assault boats",
                "text_long" => "Ship may carry squadrons of Shark assault boats",
                "data" => [
                    [
                      "type" => "rule",
                      "module" => null,
                      "action" => "add",
                      "value" => "+ Shark Assault",
                    ],
                    [
                      "type" => "arm",
                      "module" => json_encode([
                          "type" => "Launch Bays",
                          "placement" => null,
                          "fire_arc" => null,
                      ]),
                      "action" => "modify",
                      "value" => null,
                    ],
                ]
            ],
            [
                "name" => "torpedoes_over_nova_cannon",
                "text" => "Replace Nova Cannon with Torpedoes",
                "text_long" => "Can replace Prow Nova Cannon with Torpedo launchers",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Nova Cannon",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Torpedoes",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "short_range_weapons_battery",
                "text" => "Weapons Battery range-- firepower++",
                "text_long" => "Can be fitted with shorter range but more powerful weapons batteries. Reduce the range of the weapons batteries and increase their firepower",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "targeting_matrix",
                "text" => "Weapons Battery left column shift",
                "text_long" => "Can be retrofitted with a targeting matrix. It gives it`s weapons batteries a left column shift on the Gunnery table",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Targeting Matrix: Left column shift",
                    ],
                ]
            ],
            [
                "name" => "turrets",
                "text" => "Turrets +1",
                "text_long" => "The vessel increases the strength of its turrets by +1",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "turrets",
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "long_range_weapons_battery",
                "text" => "Weapons Battery range++",
                "text_long" => "Can be refitted with improved weapons batteries. Its weapons batteries increase their range",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "long_range_weapons_battery_low_firepower",
                "text" => "Weapons Battery range++ firepower--",
                "text_long" => "Can be refitted with long range weapons batteries. It's firepower is reduced",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "nova_cannon_over_torpedoes",
                "text" => "Replace Torpedoes with Nova Cannon",
                "text_long" => "May replace its Prow Torpedoes for a Nova Cannon",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Torpedoes",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Nova Cannon",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "increased_front_armour",
                "text" => "Front Armor 6+ / Turn 45°",
                "text_long" => "May increase the prow armour to 6+ for no additional cost. However, if this option is taken, the turning radius of these vessels is reduced to 45 degrees",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "armour",
                        "action" => "modify",
                        "value" => null,
                    ],
                    [
                        "type" => "ship",
                        "module" => "turns",
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "torpedoes_over_lance_battery",
                "text" => "Replace Lance Battery with Torpedoes",
                "text_long" => "Can replace their Prow Lances with Torpedoes",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Torpedoes",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "long_range_sensors",
                "text" => "Enemy contacts Ld bonus doubled",
                "text_long" => "Squadrons can carry experimental long range detection gear. This doubles the Leadership test bonus for enemy contacts (ie, enemy on special orders) from +1 to +2 but removes the squadron's weapons batteries",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Enemy contacts Ld bonus doubled",
                    ],
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "remove",
                        "value" => null,
                    ]
                ]
            ],
            [
                "name" => "torpedoes_over_launch_bays",
                "text" => "Replace Launch Bays with Torpedoes",
                "text_long" => "May replace its Prow Launch Bays for Torpedo tubes",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Launch Bays",
                            "placement" => "Prow",
                            "fire_arc" => null,
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Torpedoes",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "bombardment_cannon_over_launch_bays",
                "text" => "Replace Launch Bays with Bombardment Cannon Battery",
                "text_long" => "May replace its Launch Bays for a Bombardment Cannon Battery",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Launch Bays",
                            "placement" => "Prow",
                            "fire_arc" => null,
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Bombardment Cannon",
                            "placement" => "Prow",
                            "fire_arc" => "Front",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "lance_battery_over_bombardment_cannon",
                "text" => "Replace Bombardment Cannon with Lance Battery",
                "text_long" => "May replace its Prow Bombardment Cannon for a Lance Battery",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Bombardment Cannon",
                            "placement" => "Prow",
                            "fire_arc" => "Left/Front/Right",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Prow",
                            "fire_arc" => "Left/Front/Right",
                        ]),
                    ],
                ]
            ],
            [
                "name" => "shields",
                "text" => "Shields +1",
                "text_long" => "The vessel increases the strength of its shields by +1",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "shields",
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "launch_bays_over_lance_battery",
                "text" => "Replace Lance Battery with Launch Bays",
                "text_long" => "May exchange its broadside Lance Batteries for Launch Bays",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Port",
                            "fire_arc" => "Left",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Launch Bays",
                            "placement" => "Port",
                            "fire_arc" => null,
                        ]),
                    ],
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Starboard",
                            "fire_arc" => "Right",
                        ]),
                        "action" => "replace",
                        "value" => json_encode([
                            "type" => "Launch Bays",
                            "placement" => "Starboard",
                            "fire_arc" => null,
                        ]),
                    ]
                ]
            ],
            [
                "name" => "class_refit_lunar",
                "text" => "Refit cruiser to Lunar class",
                "text_long" => "Refit ship to Lunar class cruiser. Only default ship profile will be available",
                "data" => [
                    [
                        "type" => "class",
                        "module" => "Rogue Trader Cruiser",
                        "action" => "replace",
                        "value" => "Lunar Class Cruiser",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Lunar class profile used",
                    ],
                ]
            ],
            [
                "name" => "class_refit_tyrant",
                "text" => "Refit cruiser to Tyrant class",
                "text_long" => "Refit ship to Tyrant class cruiser. Only default ship profile will be available",
                "data" => [
                    [
                        "type" => "class",
                        "module" => "Rogue Trader Cruiser",
                        "action" => "replace",
                        "value" => "Tyrant Class Cruiser",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Tyrant class profile used",
                    ],
                ]
            ],
            [
                "name" => "class_refit_carnage",
                "text" => "Refit cruiser to Carnage class",
                "text_long" => "Refit ship to Carnage class cruiser. Only default ship profile will be available",
                "data" => [
                    [
                        "type" => "class",
                        "module" => "Rogue Trader Cruiser",
                        "action" => "replace",
                        "value" => "Carnage Class Cruiser",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Carnage class profile used",
                    ],
                ]
            ],
            [
                "name" => "class_refit_murder",
                "text" => "Refit cruiser to Murder class",
                "text_long" => "Refit ship to Murder class cruiser. Only default ship profile will be available",
                "data" => [
                    [
                        "type" => "class",
                        "module" => "Rogue Trader Cruiser",
                        "action" => "replace",
                        "value" => "Murder Class Cruiser",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Murder class profile used",
                    ],
                ]
            ],
            [
                "name" => "rogue_trader_cruiser_class_refit",
                "text" => "Cruiser class refit",
                "text_long" => "Rogue Trader cruisers in an Exploration fleet may also be of the following Imperial or Chaos ship classes: Lunar, Tyrant, Carnage or Murder (even if used as a loyalist ship), for their normal point cost, +15 points if the ship is equipped with lances or 60 cm weapons due to the additional expense maintaining such weapons, as reflected in the fleet list. Chaos vessels used as loyalist ships must be painted as such, and no special variants in the notes of these ships' profiles can be used. For example, the Tyrant can't take boosted batteries or a Nova Cannon, etc",
                "data" => [
                    [
                        "type" => "group",
                        "value" => json_encode([
                            'class_refit_lunar',
                            'class_refit_tyrant',
                            'class_refit_carnage',
                            'class_refit_murder'
                        ]),
                    ],
                ]
            ],
            [
                "name" => "xenotech_long_range_sensors",
                "text" => "Long Range Sensors: +1 Ld",
                "text_long" => "Long Range Sensors: The vessel adds +1 to its base leadership (max. of Ld 10)",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Long Range Sensors: +1 Ld",
                    ],
                ]
            ],
            [
                "name" => "xenotech_targeting_matrix",
                "text" => "Targeting Matrix: <30cm all targets closing | >30cm no range penalty",
                "text_long" => "Targeting Matrix: The vessel counts all targets as closing when using the gunnery table within 30cm and ignores right-shift modifiers for shooting greater than 30 cm",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Targeting Matrix: <30cm all targets closing | >30cm no range penalty",
                    ],
                ]
            ],
            [
                "name" => "advanced_drive_technology",
                "text" => "Advanced Drive Technology: +5cm speed | +1D6 All Ahead Full",
                "text_long" => "Advanced Drive Technology: The vessel adds +5 cm to its speed as well as +1D6 when undergoing All Ahead Full special orders",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "speed",
                        "action" => "modify",
                        "value" => null,
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Advanced Drive Technology: +1D6 All Ahead Full",
                    ],
                ]
            ],
            [
                "name" => "gravitic_thrusters",
                "text" => "Gravitic Thrusters: x2 turning radius",
                "text_long" => "Gravitic Thrusters: The vessel can double the maximum rate of its normal turn",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "turns",
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "xenotech_refit",
                "text" => "Add Xenotech refit from the table",
                "text_long" => "When included in a Rogue Trader fleet in a campaign or one-off game, they may take one refit from the Xenotech systems table",
                "data" => [
                    [
                        "type" => "group",
                        "module" => null,
                        "action" => null,
                        "value" => json_encode([
                            'xenotech_long_range_sensors',
                            'xenotech_targeting_matrix',
                            'shields',
                            'turrets',
                            'advanced_drive_technology',
                            'gravitic_thrusters'
                        ]),
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Xenotech refit used",
                    ],
                ]
            ],
            [
                "name" => "fuel_tanker",
                "text" => "Renown +1; Critical dmg on 5+; Catastrophic table 3D6",
                "text_long" => "Heavy transport can be a fuel tanker. In addition to the ship's special rules, fuel tankers suffer critical damage on a roll of 5+ instead of a 6 normally. If a fuel tanker is reduced to zero hits, it rolls 3D6 on the catastrophic damage table instead of 2D6, adding the result of all three dice together. These vessels are especially critical to a Rogue Trader and the operations of a given fleet in general; every one that survives at the end of the game without disengaging earns +1 renown to the owning player, even if crippled",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Fuel Tanked: Renown +1; Critical dmg on 5+; Catastrophic table 3D6",
                    ],
                ]
            ],
            [
                "name" => "repair_tender",
                "text" => "Renown +1 or 2 repair points; Enemy renown +2 destroyed/+1 crippled",
                "text_long" => "These ships are vital for quickly repairing and refitting warships close to the battlezone. Ship adds +1 renown or two repair points to the owning player at the end of every battle (even if crippled), but the enemy gains +1 renown for crippling or +2 renown for destroying it",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Repair Tender: Renown +1 or 2 repair points; Enemy renown +2 destroyed/+1 crippled",
                    ],
                ]
            ],
            [
                "name" => "super_heavy_transport",
                "text" => "+4HP; Counts as 3 transports/2 crippled; Battleship rules apply",
                "text_long" => "Some heavy transports are extraordinarily vast behemoths of the stars, serving the core worlds of the Imperium as supertankers or as bulk ore carriers bound for the foundries of Mechanicus worlds. Such vessels add +4HP to their profile and count as three normal transports (two if crippled). However, they turn like battleships and are mounted on a large base. Their profile and special rules are otherwise unchanged",
                "data" => [
                    [
                        "type" => "ship",
                        "module" => "hitpoints",
                        "action" => "modify",
                        "value" => null,
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Super Heavy Transport: Counts as 3 transports (2 crippled)",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Super Heavy Transport: Battleship rules apply",
                    ],
                ]
            ],
            [
                "name" => "fast_clipper",
                "text" => "Free Xenotech: Advanced Drive Technology",
                "text_long" => ": Instead of taking a Xenotech refit normally, for no extra cost this vessel type can be converted to a fast clipper by entirely removing its primary battery armament for the Advanced Drive Technology refit on",
                "data" => [
                    [
                        "type" => "group",
                        "module" => null,
                        "action" => null,
                        "value" => json_encode(['advanced_drive_technology']),
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Xenotech refit used",
                    ],
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "remove",
                        "value" => null,
                    ],

                ]
            ],
            [
                "name" => "improved_thrusters",
                "text" => "Improved Thrusters: All Ahead Full +1D6",
                "text_long" => "Can be equipped with improved thrusters and may move 5D6 cm when on All Ahead Full orders",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Improved Thrusters: All Ahead Full +1D6",
                    ],
                ]
            ],
            [
                "name" => "short_range_dorsal_lance_battery",
                "text" => "Lance Battery: range-- firepower++",
                "text_long" => "Can be fitted with shorter range but more powerful lance batteries. Reduce the range of the lance batteries and increase their firepower",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Dorsal",
                            "fire_arc" => "Left/Front/Right",
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "long_range_lance_battery",
                "text" => "Lance Battery: range++",
                "text_long" => "Can be refitted with improved lance batteries. Its lance batteries increase their range",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                ]
            ],
            [
                "name" => "weapons_battery_and_lance_battery_over_weapons_battery",
                "text" => "Replace Weapons Battery with Weapons/Lance Battery",
                "text_long" => "Can replace its Weapons Batteries with Weapons-Lance Batteries combo",
                "data" => [
                    [
                        "type" => "arm",
                        "module" => json_encode([
                            "type" => "Weapons Battery",
                            "placement" => null,
                            "fire_arc" => null,
                        ]),
                        "action" => "modify",
                        "value" => null,
                    ],
                    [
                        "type" => "arm",
                        "module" => null,
                        "action" => "add",
                        "value" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Port",
                            "fire_arc" => "Left",
                        ]),
                    ],
                    [
                        "type" => "arm",
                        "module" => null,
                        "action" => "add",
                        "value" => json_encode([
                            "type" => "Lance Battery",
                            "placement" => "Starboard",
                            "fire_arc" => "Right",
                        ]),
                    ]
                ]
            ],
            [
                "name" => "chaos_lord",
                "text" => "Chaos Lord +1Ld",
                "text_long" => "Chaos battle barges can be led by a Chaos Lord having +1 leadership. This is an alternative to the Chaos Lord of the Incursion Fleet list",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Chaos Lord +1Ld",
                    ],
                ]
            ],
            [
                "name" => "chosen_terminators",
                "text" => "Chosen Terminators",
                "text_long" => "Ship with Chosen Terminator crew can roll 2 dice when conducting a Hit&Run Teleport attack and select which one they wish to count. All other Hit&Rum bonuses are applied",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Chosen Terminators: Teleport attacks roll 2 dice, select one to count",
                    ],
                ]
            ],
            [
                "name" => "chaos_space_marines",
                "text" => "Add Chaos Space Marines crew",
                "text_long" => "Can embark Chaos Space Marines crew. They add +1Ld, increase ship max Ld to 10. Boarding bonus +2. Hit&Run bonus +1, enemy conducting Hit&Run against ship -1",
                "data" => [
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Chaos Space Marines: +1Ld | max 10Ld",
                    ],
                    [
                        "type" => "rule",
                        "module" => null,
                        "action" => "add",
                        "value" => "Chaos Space Marines: Boarding +2 | Hit&Run +1, enemy -1",
                    ],
                    [
                        "type" => "group",
                        "value" => json_encode(['chosen_terminators']),
                    ]
                ]
            ],

            /* refits seeder template
            [
                "name" => "",
                "text" => "",
                "text_long" => "",
                "data" => [
                    "type" => "",
                    "module" => "",
                    "action" => "",
                    "value" => "",
                ],
            ],
            */
        ];

        foreach ($refits as $refit) {
            $modifications = $refit['data'];
            unset($refit['data']);
            $refitObj = Refit::create($refit);
            foreach ($modifications as $modification) {
                $modification['refit_id'] = $refitObj->id;
                Modification::create($modification);

                if ($modification['type'] == 'group') {
                    $names = json_decode($modification['value'], false);
                    $children = Refit::getByNames($names);
                    $refitObj->children()->attach($children->pluck('id'));
                }
            }
        }
    }
}
