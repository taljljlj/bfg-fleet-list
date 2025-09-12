<?php

namespace App\Services;

use App\Models\FleetBuilder\FleetShipRule;
use App\Models\Rules;
use App\Models\Ship;
use Illuminate\Support\Collection;


class RuleService
{
    /**
     * Rebuild ship's rule relation by appending refit rules to default ones
     *
     * @param Ship $ship
     * @return Ship
     */
    public function rebuildRuleRelation(Ship $ship) : Ship
    {
        $refittedRules = FleetShipRule::where('fleet_ship_id', $ship->pivot->id)->get();

        $combinedRules = $ship->rules()->get();

        foreach ($refittedRules as $refittedRule) {
            $ruleObj = new Rules();
            $ruleObj->name = "refitted_rule_" . $refittedRule->fleet_ship_id . '_' . $refittedRule->id;
            $ruleObj->text = $refittedRule->text;
            $ruleObj->text_long = $refittedRule->text_long;

            $combinedRules->push($ruleObj);
        }

        $ship->setRelation('rules', $combinedRules);

        return $ship;
    }
}
