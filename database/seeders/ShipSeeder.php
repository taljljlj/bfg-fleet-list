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
        $json = file_get_contents(database_path('seeders/data/ships.json'));
        $shipList = json_decode($json, true);


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
