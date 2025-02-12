<?php

namespace Database\Seeders;

use App\Models\Rules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            [
                'name' => 'Massive',
                'text' => 'Come To A New Heading disabled',
                'text_long' => 'Battleships are a slow and ponderous vessels and cannot use Come to New Heading special orders',
            ],
            [
                'name' => 'Lock On Lances',
                'text' => 'Lances 60cm range on Lock On. Suffers Thrusters Damaged (0 HP dmg) when fired >=45cm',
                'text_long' => 'If the ship is given Lock On special orders, it may increase the range of its lances to 60 cm for that Shooting Phase only. However, if this option is used and the lances are fired at 45 cm or greater, the ship will suffer an immediate Thrusters Damaged critical hit (but does NOT take 1 damage from the critical hit) as soon as the lances are fired',
            ],
            [
                'name' => 'Prow Sensors',
                'text' => 'Prow Sensors: +1 Ld',
                'text_long' => 'The ship dispenses with the normal armoured prow and instead carries a mass of sensor probes and forward turrets, giving it +1 to its Leadership rating',
            ],
            [
                'name' => 'Resilient Prow',
                'text' => 'Prow critical damage ignored',
                'text_long' => 'The ship completely ignores prow critical damage, regardless of the cause. If any critical damage rolled against the table results in a Prow Armament Damaged critical hit, it is assumed the critical damage did not take place, and it does not move up to the next higher critical damage. If the critical damage is caused by the ship taking a hit, the hit itself still counts normally',
            ],
            [
                'name' => 'Sensor Array',
                'text' => '+2 Ld when enemy on special orders',
                'text_long' => 'The ship was fitted with an improved sensor array during its conversion to accurately control its prodigious squadrons of attack craft. It gains a +2 bonus when the enemy is on special orders instead of +1',
            ],
            [
                'name' => 'Up-rated Engineering Plants',
                'text' => 'Catastrophic damage table rolls use 3D6',
                'text_long' => 'These ships are fitted with up-rated engineering plants that increase its speed and provide it with greater firepower at the expense of survivability. When reduced to zero hits, it rolls 3D6 for catastrophic damage and adds the result (any roll greater than 12 counts as 12)',
            ],
            [
                'name' => 'Resilient Mid-ship Corridor',
                'text' => '+1 when defending against boarding action',
                'text_long' => 'Ship gets a +1 to their dice roll when defending against a boarding action, because the mid-ship corridor is easy to defend and restricts access to vital parts of the ship',
            ],
            [
                'name' => 'Improved Thrusters',
                'text' => 'Improved Thrusters: +1D6 cm on All Ahead Full',
                'text_long' => 'Improved thrusters (+D6 cm on All Ahead Full special orders)',
            ],
            [
                'name' => 'Transport Thrusters',
                'text' => 'Transport Thrusters: rolls 3D6 cm on All Ahead Full',
                'text_long' => 'Transports do not have the powerful drives routinely fitted to warships. Transports using All Ahead Full orders only add +3D6 cm to their speed',
            ],
            [
                'name' => 'Reduced Ld',
                'text' => 'Randomly rolled Ld reduced by 1',
                'text_long' => 'Their randomly rolled Leadership is reduced by one, so they will have a Leadership value of between 5 and 8',
            ],
            [
                'name' => 'Grey Knights',
                'text' => 'Grey Knights: re-roll any boarding action result',
                'text_long' => 'Grey Knights are fearsome warriors even among other Space Marines; they may r-roll any boarding action result (the second roll stands)',
            ],
            [
                'name' => 'Blackship Crew 1',
                'text' => 'Cannot initiate boarding action. +2 when defending.',
                'text_long' => 'They will never attempt to board an enemy vessel, but their embarked Adepta Sororitas Mission and platoons of Inquisitorial Storm Troopers adds +2 to their roll when defending against a boarding action',
            ],
            [
                'name' => 'Blackship Crew 2',
                'text' => 'Hit & Run attacks of any type -1',
                'text_long' => 'Hit and run attacks of any type suffer a -1 modifier',
            ],
            [
                'name' => 'Gellar Field',
                'text' => 'When Shield Collapse critical on 4+ roll Gellar Shields also damaged. Cannot disengage until repaired',
                'text_long' => 'Gellar Field: The ship is sheathed in an especially powerful Gellar Field to shield the presence of its cargo of untrained psykers from the ravages of the warp. If the ship takes a Shields Collapsed critical hit, roll a D6. On a 4+, the Gellar Field is also damaged and must be repaired before the ship departs the table or disengages, or the ship counts as being destroyed! The Gellar Field is repaired normally as would be any other repairable critical damage, though this does not repair the Shields Collapsed critical',
            ],
            [
                'name' => 'Prized Objective',
                'text' => '500pts if destroyed; +3 Renown (+2 if crippled) if it survives',
                'text_long' => 'These vessels are especially rare and fulfil one of the most important missions in all the Imperium. They are as carefully protected by Imperial forces as they are prized by the Emperor’s enemies, and it is not uncommon that they in and of themselves will be the object of a battle. This vessel counts as 500 victory points if destroyed. However, it provides the owning player +3 Renown if it survives the battle (+2 Renown if crippled)',
            ],
            [
                'name' => 'Heavy Transport',
                'text' => 'Worth: 4 (2 if crippled) assault pts if <=30cm from planet edge in planetary assault, 2 (1 if crippled) regular transports in transport scenarios',
                'text_long' => 'They are worth four assault points (two if crippled) in planetary assault scenarios when within 30 cm of the planet edge and have the value of two regular transports (one if crippled) in scenarios that require transports',
            ],
            [
                'name' => 'Disruptor Cannon',
                'text' => 'Disruptor Cannon = Lance Battery',
                'text_long' => 'The Pthuxutl disruptor cannon is an inefficient and cumbersome but easily-duplicated weapon system. It functions as a standard lance in all respects',
            ],
            [
                'name' => 'Xenotech Included 1',
                'text' => 'Xenotech: Ship Defense Grid already included',
                'text_long' => 'The Pthuxutl War Cruiser has a Xenotech: Ship Defense Grid (turrets +1) already included in its profile',
            ],
            [
                'name' => 'Fra’al Targeting Matrix',
                'text' => 'Weapons Battery: targets <30cm count as closing; no column shift for >30cm',
                'text_long' => 'Fra’al utilize a complex targeting matrix that greatly improves the accuracy of their weapon batteries at long range; they treat all targets less than 30 cm as closing and do not suffer a column shift for firing at targets greater than 30 cm',
            ],
            [
                'name' => 'Xenotech Included 2',
                'text' => 'Xenotech: Targeting Matrix already included',
                'text_long' => 'The Fra’al Raider has a Xenotech: Targeting Matrix, see the special ability above',
            ],
            [
                'name' => 'Whisperlance Cannon',
                'text' => 'Whisperlance Cannon = Lance Battery',
                'text_long' => 'While highly efficient, a whisperlance cannon behaves as a lance battery in all respects',
            ],
            [
                'name' => 'Xenotech Included 3',
                'text' => 'Xenotech: Advanced Shielding already included',
                'text_long' => 'The Nekulli Whip has a Xenotech: Advanced Shielding (shields +1) already included in its profile',
            ],
            [
                'name' => 'Cargo Vessel',
                'text' => 'Worth: 1 assault pts if <=30cm from planet edge in planetary assault, 1/2 (rounding down) regular transports in transport scenarios',
                'text_long' => 'They are worth one assault point in planetary assault scenarios when within 30 cm of the planet edge and count as a half-transport (rounding DOWN) in scenarios that require transports. This means that if it is the only one remaining in a convoy scenario, it counts as zero',
            ],
            [
                'name' => 'Ordnance Vessel',
                'text' => 'When in escort squad +1 Ld for Reload Ordnance (does not stack)',
                'text_long' => 'When included in a Rogue Trader escort squadron and not being used as a transport in scenarios that require them, it offers +1 Ld to Reload Ordnance by ensuring escorts have a ready supply of torpedoes before the battle. This effect is not cumulative if there is more than one Rogue Trader cargo vessel in the escort squadron',
            ],
            [
                'name' => 'Fra’al Pirate',
                'text' => 'Cannot use fleet re-rolls. Attempts disengage when crippled (+1 Ld for disengage)',
                'text_long' => 'When taken in a pirate fleet list, they may not use any fleet re-rolls, and they will attempt to disengage when crippled (+1 Ld bonus when doing so)',
            ],
            [
                'name' => 'Ghost-Light',
                'text' => 'Ghost-Light: Weapons dont cause critical damage',
                'text_long' => 'The Stryxis rely on weapon technology called “Ghost-Light” that when striking unshielded vessels inflict horrific crew casualties while only minimally affecting a ship’s hull. In damage terms they function as standard weapon batteries and lances in all respects but will not roll for or inflict critical damage',
            ],
            [
                'name' => 'Stryxis Movement',
                'text' => 'Follows special movement rules',
                'text_long' => '',
            ],
            [
                'name' => 'Mark Of Tzeentch',
                'text' => 'Mark Of Tzeentch',
                'text_long' => 'Ship bears a Mark Of Tzeentch',
            ],
            [
                'name' => 'Vortex Of Chaos',
                'text' => 'At the end of movement phase any ship <15cm from this vessel must place a blast marker in contact',
                'text_long' => 'Vortex of Chaos: Favoured horrors of Tzeentch writhe and cavort amidst the very bulkheads and girders, and a swirling vortex of Chaos surrounds this vessel. At the end of each Movement Phase, any ship within 15 cm of this vessel (friend or foe!) must place a blast marker in base contact with it',
            ],
            [
                'name' => 'Vagaries Of Fate',
                'text' => '+1 ship re-rolls; suffers 1 dmg if re-roll fails',
                'text_long' => 'Vagaries of Fate: The Changer of Ways provides for command of the Fates, affording its auguries snatched glimpses of the future. The ship is gifted with an additional reroll added to that from the Mark of Tzeentch, but the daemons bound to the hull are easily enraged by a commander’s inability to use this foresight and inflict 1 damage if this ship’s or its Lord’s re-rolls fail for any reason',
            ],
            [
                'name' => 'Mark Of Slaanesh',
                'text' => 'Mark Of Slaanesh',
                'text_long' => 'Ship bears a Mark Of Slaanesh',
            ],
            [
                'name' => 'Palace Of Pleasure',
                'text' => 'Emperor’s Children Chaos Space Marines',
                'text_long' => 'Ship has Emperor’s Children Chaos Space Marines on board',
            ],
            [
                'name' => 'Mark Of Nurgle',
                'text' => 'Mark Of Nurgle',
                'text_long' => 'Ship bears a Mark Of Nurgle',
            ],
            [
                'name' => 'Miasma Of Pestilence',
                'text' => 'Turrets no effect vs torpedoes; enemy <15cm no beneficial column shift',
                'text_long' => 'Miasma of Pestilence: The Terminus Est is surrounded by vast swarming clouds of the same Warp-spawned flies which buzz and howl through its interior and first transformed Typhus into the Host of the Destroyer Hive. This miasma permeates outwards from the ship through blisters, boils and fractures in its surface or through corroded discharge tubes and weapon barrels. It replaces the ship’s turrets and works in exactly the same way as turrets against attack craft but has no effect against torpedoes. The miasma is so thick that it obscures and distorts the shape of the Terminus Est, meaning that vessels within 15cm do not benefit from a left column shift when firing at it',
            ],
            [
                'name' => 'Mark Of Khorne',
                'text' => 'Mark Of Khorne',
                'text_long' => 'Ship bears a Mark Of Khorne',
            ],
            [
                'name' => 'World Eaters Chaos Space Marines',
                'text' => 'World Eaters Chaos Space Marines',
                'text_long' => 'Ship has World Eaters Chaos Space Marines on board',
            ],
            [
                'name' => 'Berzerker Horde',
                'text' => 'Khorn Berzerkers: +2 boarding action',
                'text_long' => 'Ship embarks a retinue of Khorne Berzerkers, giving it a boarding modifier of +2 in addition to its improved boarding value',
            ],
            [
                'name' => 'Chosen Terminators',
                'text' => 'Chosen Terminators: teleport hit & runs roll 2D6 - pick highest D6',
                'text_long' => 'Ship is embarked with Chosen Terminators and may roll 2D6 and pick the highest D6 when conducting a teleport Hit and Run attack each turn',
            ],
            [
                'name' => 'Long Range Targeting Matrix',
                'text' => 'No range penalty for >30cm',
                'text_long' => 'Does not suffer a column shift for firing over 30 cm',
            ],
            [
                "name" => "Exterminatus",
                "text" => "If torpedo refit is taken ship serves as Exterminatus: exterminate a planet on roll 3+",
                "text_long" => "If the torpedo refit is taken, the ship does not have to be modified to serve as an Exterminatus vessel, as they are always equipped with virus bombs and cyclotronic warheads as standard. As such, when in position to exterminate a planet, it may do so on a roll of 3+ instead of 4+",
            ],
            [
                'name' => 'Hives Of Nurgle',
                'text' => 'May place 1 Blast along ship’s path after it moved',
                'text_long' => '',
            ],
//            [
//                'name' => '',
//                'text' => '',
//                'text_long' => '',
//            ],
//            [
//                'name' => '',
//                'text' => '',
//                'text_long' => '',
//            ],

        ];

        foreach ($rules as $rule) {
            Rules::create($rule);
        }
    }
}
