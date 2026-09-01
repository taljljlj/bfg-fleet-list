<?php

namespace App\Http\Controllers;

use App\Helpers\FleetBuilderUtils;
use App\Models\Commander;
use App\Models\CommanderRerolls;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetBuilder\FleetCommander;
use App\Models\FleetList;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Ship;
use App\Services\FleetBuilderService;
use App\Services\RefitService;
use App\Services\ShipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;
    private RefitService $refitService;
    private ShipService $shipService;

    /**
     * @param FleetBuilderService $fleetBuilderService
     * @param RefitService $refitService
     * @param ShipService $shipService
     */
    public function __construct(FleetBuilderService $fleetBuilderService, RefitService $refitService, ShipService $shipService) {
        $this->fleetBuilderService = $fleetBuilderService;
        $this->refitService = $refitService;
        $this->shipService = $shipService;
    }

    /**
     * Fleet builder landing page. Shows user fleets and their CRUD actions.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index() {
        if (auth()->check()) {
            $fleets = auth()->user()->fleets()
                ->with(['faction', 'fleetList'])
                ->latest('updated_at')->get();
        } else {
            $guestFleetIds = session()->get('guestFleetIds');
            if ($guestFleetIds) {
                $fleets = Fleet::whereKey($guestFleetIds)
                    ->with(['faction', 'fleetList'])
                    ->latest('updated_at')->get();
            } else {
                $fleets = collect();
            }
        }

        return view('pages.fleet-index', compact(['fleets']));
    }

    /**
     * @param Fleet $fleet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function show(Fleet $fleet) {
        $fleet->load('faction', 'fleetList', 'commanders', 'user');

        $ships = null;
        if ($fleet->ships()->exists()) {
            $ships = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships(), true, false, true);
            $ships = $ships->sortBy('order');
        }

        $commanders = null;
        if ($fleet->commanders()->exists()) {
            $commanders = $fleet->commanders()
                ->withPivot('id', 'fleet_ship_id', 'points', 'rolls')
                ->get();
        }

        $fleet->setRelation('ships', $ships);
        $fleet->setRelation('commanders', $commanders);

        return view('pages.fleet-view', compact(['fleet']));
    }

    /**
     * Create a new fleet. Creates the new blank fleet template and redirects to edit page.
     * @return RedirectResponse
     */
    public function create() : RedirectResponse
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    /**
     * Soft-delete fleet. Detach it from user and reset fleet and ship names to defaults, but keep the fleet record.
     * @param Fleet $fleet
     * @return RedirectResponse
     */
    public function destroy(Fleet $fleet) : RedirectResponse
    {
        if (Gate::denies('delete', $fleet)) {
            return redirect()->route('builder.view', $fleet);
        }

        $this->fleetBuilderService->deleteFleet($fleet);

        return redirect()->route('builder.index');
    }

    /**
     * Soft-delete fleet. Detach it from user and reset fleet and ship names to defaults, but keep the fleet record.
     * @param Fleet $fleet
     * @return JsonResponse
     */
    public function destroyApi(Fleet $fleet) : JsonResponse
    {
        if (Gate::denies('delete', $fleet)) {
            return response()->json(
                ['message' => '+++ Deletion Rite Denied +++\r\nAccess to purge this fleet is forbidden. The muster rolls recognize no authority in your seal. Only the rightful master may enact the purge protocol.'],
                403
            );
        }

        $this->fleetBuilderService->deleteFleet($fleet);

        return response()->json(['redirectUrl' => route('builder.index')]);
    }

    /**
     * The first step in opening fleet builder if faction hotpick was selected - create new fleet, prefill fleet-faction relation
     * Redirects to fleet edit page
     * @param Faction $faction
     * @return RedirectResponse
     */
    public function hotpickIndex(Faction $faction) : RedirectResponse
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();
        $fleet = $this->fleetBuilderService->hotpickFaction($fleet, $faction->id);

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    /**
     * @param Fleet $fleet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse|\Illuminate\View\View|object
     */
    public function edit(Fleet $fleet)
    {
        if (Gate::denies('update', $fleet)) {
            return redirect()->route('builder.view', $fleet);
        }

        $factions = Faction::all();

        //If fleet has selected faction (hotpick and edit fleet)
        $fleetLists = null;
        if ($fleet->faction_id) {
            $fleetLists = FleetList::getByFactionId($fleet->faction_id);
        }

        //If fleet has selected fleet list
        $selectedFleetList = null;
        $shipList = null;
        $commanderList = null;
        if ($fleet->fleet_list_id) {
            $selectedFleetList = FleetList::findOrFail($fleet->fleet_list_id);
            $shipList = $this->fleetBuilderService->getShipsByFleetList($selectedFleetList);
            $commanderList = $this->fleetBuilderService->getCommandersByFleetList($selectedFleetList);
        }

        //If fleet has attached ships return full list and assign order for frontend
        $ships = null;
        if ($fleet->ships()->exists()) {
            $ships = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships(), true);
        }

        //If fleet has attached commanders return full list
        $commanders = null;
        if ($fleet->commanders()->exists()) {
            $commanders = $fleet->commanders()
                ->withPivot('id', 'fleet_ship_id', 'points', 'rolls', 'commander_reroll_id')
                ->with('commanderRerolls')
                ->get();
        }

        return view('pages.fleet-builder', compact(
            'fleet',
            'factions',
            'fleetLists',
            'selectedFleetList',
            'shipList',
            'ships',
            'commanderList',
            'commanders',
        ));
    }

    /**
     * @param Fleet $fleet
     * @return RedirectResponse
     */
    public function cloneAndEdit(Fleet $fleet)
    {
        if (Gate::allows('update', $fleet)) {
            return redirect()->route('builder.edit', $fleet);
        }

        $fleetClone = $this->fleetBuilderService->cloneFleet($fleet);

        return redirect()->route('builder.edit', ['fleet' => $fleetClone]);
    }

    /**
     * @param Fleet $fleet
     * @param Faction $faction
     * @return JsonResponse
     */
    public function setFaction(Fleet $fleet, Faction $faction) : JsonResponse
    {
        $fleetLists = $faction->fleetLists()->get();

        $fleet->points = 0;
        $fleet->faction()->associate($faction);
        $fleet->fleetList()->dissociate();
        $fleet->ships()->detach();
        $fleet->commanders()->detach();
        $fleet->save();

        return response()->json([
            'message' => 'Faction selected.',
            'faction' => $faction,
            'fleetLists' => $fleetLists
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetList $fleetList
     * @return JsonResponse
     */
    public function setFleetList(Fleet $fleet, FleetList $fleetList) : JsonResponse
    {
        $shipList = $this->fleetBuilderService->getShipsByFleetList($fleetList);
        $commanderList = $this->fleetBuilderService->getCommandersByFleetList($fleetList);

        $fleet->fleetList()->associate($fleetList);
        $fleet->commanders()->detach();
        $fleet->save();

        $msg = "Fleet list selected.";

        $excludedShipsData = null;
        if ($fleet->ships()->exists()) {
            $syncShips = $fleet->ships()->sync($fleet->shipsInFleetList($fleetList)->pluck('ships.id')->toArray());

            if ($syncShips['detached']) {
                $msg .= " Some ships have been removed as they are not compatible with selected fleet list.";

                $fleet->points = $fleet->ships()->sum('fleet_ship.points');
                $fleet->save();

                $excludedShipsData = [
                    'points' => $fleet->points,
                    'shipIds' => collect($syncShips['detached'])->unique()->values()->toArray(),
                ];
            }
        }

        return response()->json([
            'message' => $msg,
            'fleetList' => $fleetList,
            'shipList' => $shipList,
            'excludedShipsData' => $excludedShipsData,
            'commanderList' => $commanderList,
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param Ship $ship
     * @return JsonResponse
     */
    public function attachShipToFleet(Fleet $fleet, Ship $ship) : JsonResponse
    {
        //Prepare Ship object
        $ship->load(['armaments', 'rules', 'refits', 'modifications']);
        $ship = $this->refitService->rebuildRefitRelation($ship);

        //Prepare ship profile vars
        $shipOrder = $this->fleetBuilderService->shipTypeOrder[$ship->type];
        $shipPoints = $ship->points;

        //Update fleet
        $fleet->ships()->attach(
            $ship,
            [
                'points' => $shipPoints,
                'speed' => $ship->speed,
                'turns' => $ship->turns,
                'shields' => $ship->shields,
                'armour' => $ship->armour,
                'turrets' => $ship->turrets,
                'squadron_counter' => ($ship->type == 'Escort') ? 1 : null
            ]
        );
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $shipPoints);
        $fleet->save();

        //Get last attached ship id for frontend data attribute
        $shipPivot = FleetShip::where('ship_id', $ship->id)
            ->where('fleet_id', $fleet->id)
            ->latest('id')
            ->first();
        $ship->setRelation('pivot', $shipPivot);

        // Add order to the ship for frontend
        $ship->order = $shipOrder;

        return response()->json([
            'message' => $ship->class . ' added to fleet.',
            'ship' => $ship,
            'fleetPoints' => $fleet->points
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param int $shipPivotId
     * @return JsonResponse
     */
    public function detachShipFromFleet(Fleet $fleet, int $shipPivotId) : JsonResponse
    {
        //Use pivot id as there can be multiple relations of the same ship and fleet, so we need to remove specific one
        $fleetShip = FleetShip::findOrFail($shipPivotId);

        if ($fleetShip->ships()->first()->type == 'Escort') {
            $shipPoints = $fleetShip->squadron_points;
        } else {
            $shipPoints = $fleetShip->points;
        }

        $fleetShip->delete();

        //Cleanup
        $fleetCommander = FleetCommander::where('fleet_ship_id', $shipPivotId)->first();
        if ($fleetCommander) {
            $fleetCommander->fleet_ship_id = null;
            $fleetCommander->save();
        }

        //Update fleet points
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, -($shipPoints));
        $fleet->save();

        return response()->json([
            'message' => 'Ship removed from fleet.',
            'points' => $fleet->points
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetShip $fleetShip
     * @param Request $request
     * @return JsonResponse
     */
    public function refitShip(Fleet $fleet, FleetShip $fleetShip, Request $request) : JsonResponse
    {
        $selectedRefits = $request->get('selected-refits');

        $syncResult = $fleetShip->appliedRefits()->sync($selectedRefits);

        $this->refitService->handleAppliedRefits($syncResult, $fleetShip, $fleet);

        $ship = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships()->wherePivot('id', $fleetShip->id), true, true);

        return response()->json([
            'message' => 'Ship refits applied.',
            'ship' => $ship,
            'fleetPoints' => $fleet->points
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetShip $fleetShip
     * @param Request $request
     * @return JsonResponse
     */
    public function updateSquadronCounter(Fleet $fleet, FleetShip $fleetShip, Request $request) : JsonResponse
    {
        $counterValue = $request->get('squadron-counter');

        $counterDiff = $counterValue - $fleetShip->squadron_counter;

        $fleetShip->squadron_counter = $counterValue;
        $fleetShip->save();

        $pointDiff = $counterDiff * $fleetShip->points;
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $pointDiff);
        $fleet->save();

        return response()->json([
            'fleetPoints' => $fleet->points,
            'squadronCounter' => $fleetShip->squadron_counter,
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetShip $fleetShip
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function updateShipFields(Fleet $fleet, FleetShip $fleetShip, Request $request) : Response|JsonResponse
    {
        $attr = $request->get('attr');
        $value = $request->get('value');
        $shipPoints = $fleetShip->points;

        $fleetShip = $this->shipService->modifyShipAttribute($fleetShip, $attr, $value);

        if ($attr == 'points') {
            $pointDiff = $value - $shipPoints;
            $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $pointDiff);
            $fleet->save();

            return response()->json([
                'fleetPoints' => $fleet->points
            ]);
        }

        return response()->noContent();
    }

    /**
     * @param Fleet $fleet
     * @param Commander $commander
     * @return JsonResponse
     */
    public function attachCommanderToFleet(Fleet $fleet, Commander $commander) : JsonResponse
    {
        $fleet->commanders()->attach(
            $commander,
            [
                'points' => $commander->points,
                'rolls' => $commander->rolls
            ]
        );

        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $commander->points);
        $fleet->save();

        //Get last attached ship id for frontend data attribute
        $commanderPivot = FleetCommander::where('commander_id', $commander->id)
            ->where('fleet_id', $fleet->id)
            ->latest('id')
            ->first();
        $commander->setRelation('pivot', $commanderPivot);

        $commander->load('commanderRerolls');

        return response()->json([
            'message' => 'Commander added to fleet.',
            'commander' => $commander,
            'fleetPoints' => $fleet->points
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetCommander $fleetCommander
     * @return JsonResponse
     */
    public function detachCommanderFromFleet(Fleet $fleet, FleetCommander $fleetCommander) : JsonResponse
    {
        $fleetCommanderPoints = $fleetCommander->commander->points;

        $unassignedFleetShip = $this->shipService->resetUnassignedShip($fleetCommander);

        $fleetCommander->delete();

        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, -($fleetCommanderPoints));
        $fleet->save();

        if ($unassignedFleetShip) {
            $unassignedShip = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships()->wherePivot('id', $unassignedFleetShip->id), true, true);
        }

        return response()->json([
            'message' => 'Commander removed from fleet.',
            'fleetPoints' => $fleet->points,
            'unassignedShip' => $unassignedFleetShip ? $unassignedShip : null,
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetCommander $fleetCommander
     * @param FleetShip $fleetShip
     * @return JsonResponse
     */
    public function commanderAssignShip (Fleet $fleet, FleetCommander $fleetCommander, FleetShip $fleetShip) : JsonResponse
    {
        $unassignedFleetShip = $this->shipService->resetUnassignedShip($fleetCommander);

        $fleetCommander->fleet_ship_id = $fleetShip->id;
        $fleetCommander->save();

        $commander = $fleetCommander->commander()->first();

        if($commander->leadership_type === 'value') {
            $fleetShip = $this->shipService->modifyShipAttribute($fleetShip, 'leadership', $commander->leadership);
        } else if ($commander->leadership_type === 'rule') {
            $rule = $commander->rule()->first();
            $fleetShip->additionalRules()->create([
                'text' => $rule->text,
                'text_long' => $rule->text_long,
            ]);
        }

        $ship = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships()->wherePivot('id', $fleetShip->id), true, true);
        if($unassignedFleetShip) {
            $unassignedShip = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships()->wherePivot('id', $unassignedFleetShip->id), true, true);
        }

        return response()->json([
            'message' => 'Ship assigned to commander.',
            'ship' => $ship,
            'unassignedShip' => $unassignedFleetShip ? $unassignedShip : null,
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param FleetCommander $fleetCommander
     * @param int|null $commanderRerollId
     * @return JsonResponse
     */
    public function commanderApplyExtraRerolls (Fleet $fleet, FleetCommander $fleetCommander, ?int $commanderRerollId) : JsonResponse
    {
        $commander = $fleetCommander->commander()->first();

        if($commanderRerollId) {
            $commanderReroll = CommanderRerolls::findOrFail($commanderRerollId);

            $rerollId = $commanderReroll->id;
            $rerollPoints = $commanderReroll->points;
            $rerollModifier = $commanderReroll->modifier;
        } else {
            $rerollId = null;
            $rerollPoints = $rerollModifier = 0;
        }

        $pointsDiff = ($commander->points + $rerollPoints) - $fleetCommander->points;
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $pointsDiff);
        $fleet->save();

        $fleetCommander->points = $commander->points + $rerollPoints;
        $fleetCommander->rolls = (int)$commander->rolls + (int)$rerollModifier;
        $fleetCommander->commander_reroll_id = $rerollId;

        $fleetCommander->save();

        $commander->setRelation('pivot', $fleetCommander);
        $commander->load('commanderRerolls');

        return response()->json([
            'message' => 'Extra re-rolls choice applied.',
            'commander' => $commander,
            'fleetPoints' => $fleet->points
        ]);
    }

    /**
     * @param Fleet $fleet
     * @param string $name
     * @return JsonResponse
     */
    public function updateFleetName(Fleet $fleet, string $name) : JsonResponse
    {
        $fleet->name = $name;
        $fleet->save();

        return response()->json([
            'message' => 'Fleet name updated.',
        ]);
    }

    /**
     * Generates the PDF file with fleet data. Suitable for viewing and printing.
     * @param Fleet $fleet
     * @return JsonResponse|Pdf
     */
    public function getFleetAsPdf(Fleet $fleet)
    {
        try {
            $ships = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships(), true, false, true)->sortBy('order');

            $faction = $fleet->faction()->first();
            $fleetList = $fleet->fleetList()->first();
            $commanders = $fleet->commanders()->withPivot('id', 'fleet_ship_id', 'points', 'rolls')->orderBy('points', 'desc')->get();

            $pdfObject = Pdf::view('pages.fleet-export', compact('faction', 'ships', 'fleetList', 'fleet', 'commanders'));

            if (config('app.env') == 'local' && config('laravel-pdf.driver') == 'browsershot') {
                $pdfObject->withBrowsershot(fn(Browsershot $browsershot) =>
                $browsershot
                    ->noSandbox() //PDF generation stalls with sandbox on Windows. Might be redundant if hosted on Linux. Nevertheless, security implications are N/A on localhost
                );
            }

            return $pdfObject->format('a4')->download('fleet-export-' . $fleet->id . '.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Grayscale readonly fleet page. Ready for printing. Visually the same as exported PDF.
     * @param Fleet $fleet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function showPrintable(Fleet $fleet)
    {
        $ships = $this->fleetBuilderService->loadAndPrepareShips($fleet->ships(), true, false, true)->sortBy('order');

        $faction = $fleet->faction()->first();
        $fleetList = $fleet->fleetList()->first();
        $commanders = $fleet->commanders()->withPivot('id', 'fleet_ship_id', 'points', 'rolls')->orderBy('points', 'desc')->get();

        return view('pages.fleet-export', compact('faction', 'ships', 'fleetList', 'fleet', 'commanders'));
    }
}
