<?php

namespace Database\Seeders;

use App\Models\Refits;
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
                "name" => "Shark Assault",
                "text" => "Include Shark assault boats",
                "text_long" => "Ship may carry squadrons of Shark assault boats",
                "module" => "Launch Bays",
            ],
            [
                "name" => "Torpedoes>Nova Cannon",
                "text" => "Nova Cannon replaced by Torpedoes",
                "text_long" => "Can replace Nova Cannon with torpedo launchers",
                "module" => "Nova Cannon",
            ],
            [
                "name" => "Short Range Weapons Battery",
                "text" => "Weapons Battery: range-- firepower++",
                "text_long" => "Can be fitted with shorter range but more powerful weapons batteries. Reduce the range of the weapons batteries and increase their firepower",
                "module" => "Weapons Battery",
            ],
            [
                "name" => "Targeting Matrix",
                "text" => "Weapons Battery: Left column shift",
                "text_long" => "Can be retrofitted with a targeting matrix. It gives its weapons batteries a left column shift on the Gunnery table",
                "module" => "Special",
            ],
            [
                "name" => "Turrets",
                "text" => "Turrets +1",
                "text_long" => "May purchase additional turret",
                "module" => "Turrets",
            ],
            [
                "name" => "Long Range Weapons Battery",
                "text" => "Weapons Battery: range++",
                "text_long" => "Can be refitted with improved weapons batteries. Its weapons batteries increase their range",
                "module" => "Weapons Battery",
            ],
            [
                "name" => "Nova Cannon>Torpedoes",
                "text" => "Torpedoes replaced by Nova Cannon",
                "text_long" => "May replace its prow torpedoes for a Nova Cannon",
                "module" => "Torpedoes",
            ],
            [
                "name" => "Increased Front Armour",
                "text" => "Front Armor 6+ / Turn 45°",
                "text_long" => "May increase the prow armour to 6+ for no additional cost. However, if this option is taken, the turning radius of these vessels is reduced to 45 degrees",
                "module" => "Armour|6+ f / 5+;Turns|45",
            ],
            [
                "name" => "Torpedoes>Lance Battery",
                "text" => "Lance Battery replaced by torpedoes",
                "text_long" => "Can replace their prow lances with prow torpedoes",
                "module" => "Lance Battery",
            ],
            [
                "name" => "Long Range Sensors",
                "text" => "Enemy contacts Ld bonus doubled",
                "text_long" => "Squadrons can carry experimental long range detection gear. This doubles the Leadership test bonus for enemy contacts (ie, enemy on special orders) from +1 to +2 but removes the squadron's weapons batteries",
                "module" => "Special|Enemy contacts Ld bonus doubled;Weapons Battery|remove",
            ],
            [
                "name" => "Torpedoes>Launch Bays",
                "text" => "Launch bays replaced by torpedoes",
                "text_long" => "May replace its launch bays for torpedo tubes",
                "module" => "Launch Bays",
            ],
            [
                "name" => "Bombardment Cannon>Launch Bays",
                "text" => "Launch bays replaced by bombardment cannon battery",
                "text_long" => "May replace its launch bays for a bombardment cannon battery",
                "module" => "Launch Bays",
            ],
            [
                "name" => "Lance Battery>Bombardment Cannon",
                "text" => "Bombardment cannon replaced by lance battery",
                "text_long" => "May replace its prow bombardment cannon for a lance battery",
                "module" => "Bombardment Cannon",
            ],
            [
                "name" => "Shields",
                "text" => "Shields +1",
                "text_long" => "May take an additional shield",
                "module" => "Shields",
            ],
            [
                "name" => "Launch Bays>Lance Battery",
                "text" => "Lance battery replaced by launch bays",
                "text_long" => "May exchange its broadside lance batteries for launch bays",
                "module" => "Broadside Lance Battery",
            ],
            [
                "name" => "Rogue Trader Cruiser Class Refit",
                "text" => "Change cruiser class",
                "text_long" => "Rogue Trader cruisers in an Exploration fleet may also be of the following Imperial or Chaos ship classes: Lunar, Tyrant, Carnage or Murder (even if used as a loyalist ship), for their normal point cost, +15 points if the ship is equipped with lances or 60 cm weapons due to the additional expense maintaining such weapons, as reflected in the fleet list. Chaos vessels used as loyalist ships must be painted as such, and no special variants in the notes of these ships' profiles can be used. For example, the Tyrant can’t take boosted batteries or a Nova Cannon, etc",
                "module" => "Unique",
            ],
            [
                "name" => "Xenotech Refit",
                "text" => "Add Xenotech refit from the table",
                "text_long" => "When included in a Rogue Trader fleet in a campaign or one-off game, they may take one refit from the Xenotech systems table",
                "module" => "Special",
            ],
            [
                "name" => "Fuel Tanker",
                "text" => "Renown +1; Critical dmg on 5+; Critical table 3D6",
                "text_long" => "Heavy transport can be a fuel tanker. In addition to the special rules above, fuel tankers suffer critical damage on a roll of 5+ instead of a 6 normally. If a fuel tanker is reduced to zero hits, it rolls 3D6 on the catastrophic damage table instead of 2D6, adding the result of all three dice together. These vessels are especially critical to a Rogue Trader and the operations of a given fleet in general; every one that survives at the end of the game without disengaging earns +1 renown to the owning player, even if crippled",
                "module" => "Special",
            ],
            [
                "name" => "Repair Tender",
                "text" => "Renown +1 or 2 repair points; Enemy renown +2 destroyed/+1 crippled",
                "text_long" => "These ships are vital for quickly repairing and refitting warships close to the battlezone. Ship adds +1 renown or two repair points to the owning player at the end of every battle (even if crippled), but the enemy gains +1 renown for crippling or +2 renown for destroying it",
                "module" => "Special",
            ],
            [
                "name" => "Super-Heavy Transport",
                "text" => "+4HP; Counts as 3 transports/2 crippled; Battleship rules apply",
                "text_long" => "Some heavy transports are extraordinarily vast behemoths of the stars, serving the core worlds of the Imperium as supertankers or as bulk ore carriers bound for the foundries of Mechanicus worlds. Such vessels add +4HP to their profile and count as three normal transports (two if crippled). However, they turn like battleships and are mounted on a large base. Their profile and special rules are otherwise unchanged",
                "module" => "Special",
            ],
            [
                "name" => "Fast Clipper",
                "text" => "Free Xenotech: Advanced Drive Technology",
                "text_long" => ": Instead of taking a Xenotech refit normally, for no extra cost this vessel type can be converted to a fast clipper by entirely removing its primary battery armament for the Advanced Drive Technology refit on",
                "module" => "Speed|30;Special|Xenotech: Advanced Drive Technology (+1D6 All Ahead Full);Weapons Battery|remove",
            ],
            [
                "name" => "Improved Thrusters",
                "text" => "All Ahead Full +1D6",
                "text_long" => "Can be equipped with improved thrusters and may move 5D6 cm when on All Ahead Full orders",
                "module" => "Special",
            ],
            [
                "name" => "Short Range Lance Battery",
                "text" => "Lance Battery: range-- firepower++",
                "text_long" => "Can be fitted with shorter range but more powerful lance batteries. Reduce the range of the lance batteries and increase their firepower",
                "module" => "Lance Battery",
            ],
            [
                "name" => "Long Range Lance Battery",
                "text" => "Lance Battery: range++",
                "text_long" => "Can be refitted with improved lance batteries. Its lance batteries increase their range",
                "module" => "Lance Battery",
            ],
            [
                "name" => "Weapons Battery&Lance Battery>Weapons Battery",
                "text" => "Replace Weapons Battery with Weapons/Lance Battery",
                "text_long" => "Can replace its weapons batteries with weapons batteries lance batteries combo",
                "module" => "Weapons Battery|4;Lance Battery|add(2,45)",
            ],
            [
                "name" => "Chaos Lord",
                "text" => "Chaos Lord +1Ld",
                "text_long" => "Chaos battle barges can be led by a Chaos Lord having +1 leadership. This is an alternative to the Chaos Lord of the Incursion Fleet list",
                "module" => "Ld",
            ],
            [
                "name" => "Chaos Space Marines",
                "text" => "Chaos Space Marines",
                "text_long" => "Can embark Chaos Space Marines",
                "module" => "Special",
            ],
            [
                "name" => "Chosen Terminators",
                "text" => "Chosen Terminators",
                "text_long" => "If Chaos Space Marines are taken, it may embark Chosen Terminators",
                "module" => "Special",
            ],
            [
                "name" => "",
                "text" => "",
                "text_long" => "",
                "module" => "",
            ],

        ];

        foreach ($refits as $refit) {
            Refits::create($refit);
        }
    }
}
