<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetBuilderFormRequest;
use App\Models\Faction;
use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\Ship;
use App\Services\FleetBuilderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class FleetBuilderController extends Controller
{
    private FleetBuilderService $fleetBuilderService;

    public function __construct(FleetBuilderService $fleetBuilderService) {
        $this->fleetBuilderService = $fleetBuilderService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    public function hotpickIndex(Faction $faction)
    {
        $fleet = $this->fleetBuilderService->createFleetInitial();
        $fleet = $this->fleetBuilderService->hotpickFaction($fleet, $faction->id);

        return redirect()->route('builder.edit', ['fleet' => $fleet]);
    }

    public function edit(Fleet $fleet, Faction $factionHotpick) {
        $factions = Faction::all();

        return view('pages.fleet-builder', compact('factions', 'fleet', 'factionHotpick'));
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFleetListByFaction(Faction $faction) : JsonResponse
    {
        $fleetLists = $faction->fleetLists()->get();

        return response()->json([
            'message' => 'Faction selected.',
            'faction' => $faction,
            'fleetLists' => $fleetLists
        ]);
    }

    /**
     * @param FleetBuilderFormRequest $request
     * @return JsonResponse
     */
    public function getShipsByFleetList(FleetList $fleetList) : JsonResponse
    {
        $ships = $fleetList->ships()->with('armaments')->get()->groupBy('type');
        $shipsSorted = $this->fleetBuilderService->sortShips($ships);

        return response()->json([
            'message' => 'Fleet List selected.',
            'fleetList' => $fleetList,
            'ships' => $shipsSorted
        ]);
    }

    public function getShipById(Ship $ship) : JsonResponse
    {
        $ship->load(['armaments', 'rules']);
        $shipOrder = $this->fleetBuilderService->shipTypeOrder[$ship->type];

        return response()->json([
            'message' => 'Ship added to fleet.',
            'html' => View::make('components.fleet-builder.ship-profile-card', compact('ship', 'shipOrder'))->render(),
            'points' => $ship->points
        ]);
    }

    public function getFleetAsPdf(Faction $faction, FleetList $fleetList, Request $request)
    {
        try {
            $shipsData = $request->get('ships');

            if (!is_array($shipsData)) {
                return response()->json(['error' => 'Invalid ships data'], 400);
            }

            $ships = collect();
            foreach ($shipsData as $shipData) {
                $ship = Ship::findOrFail($shipData['id']);
                if ($ship) {
                    $ship->name = $shipData['name'];
                    $ship->order = $shipData['order'];
                    $ship->points = $shipData['points'];
                    $ship->ld = $shipData['ld'];

                    $ships->push($ship);
                }
            }

            $ships = $ships->sortBy('order');

            return Pdf::view('pages.fleet-export', compact('faction', 'ships', 'fleetList'))
                ->withBrowsershot(function (Browsershot $browsershot) {
                    $customCachePath = env('PUPPETEER_CACHE_PATH');

                    $browsershot->scale(0.55)
                        ->setOption('puppeteer:cacheDirectory', $customCachePath);
                })
                ->format('a4')
                ->download('fleet-export.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF.'], 500);
        }
    }

    //TODO: for pdf testing, remove after pdf export fully completed
    public function testPdf(Faction $faction, FleetList $fleetList, Request $request)
    {
        $shipsData = $request->get('ships');
        $ships = collect();
        foreach ($shipsData as $shipData) {
            $ship = Ship::findOrFail($shipData['id']);
            if($ship) {
                $ship->name = $shipData['name'];
                $ship->order = $shipData['order'];
                $ship->points = $shipData['points'];
                $ship->ld = $shipData['ld'];

                $ships->push($ship);
            }
        }

        $ships->sortBy('order');

        return view('pages.fleet-export', compact('faction', 'ships', 'fleetList'));
    }
}
