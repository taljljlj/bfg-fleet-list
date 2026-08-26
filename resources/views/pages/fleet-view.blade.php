@extends('layouts.builder-layout')

@section('builder-content')
    <div class="fleet-builder relative">
        <div class="fixed z-50 top-5 left-1">
            {{-- TODO: implement message box for tooltips much like in editor only non-vue --}}
            <MessageBox />
        </div>
        <!-- Faction Selection -->
        <div class="section section-top">
            <div class="flex flex-row justify-between px-12 py-3 align-middle">
                <div class="text-center user-select-none">
                    <div class="flex flex-row justify-center">
                        <img src="{{ asset('images/factions/' . $fleet->faction->img_url) }}" alt="{{ $fleet->faction->name }} Logo" class="h-8 mr-2">
                        <h3 class="tracking-wider text-white text-2xl font-bold">
                            {{ $fleet->faction->name }}
                            <span class="font-light tracking-normal">({{ $fleet->fleetList->name }})</span>
                        </h3>
                    </div>
                </div>
                <div>
                    <h1 class="text-4xl">{{ $fleet->name }}</h1>
                </div>
                <div>
                    <h1 class="text-right text-4xl font-bold"><span id="points">{{ $fleet->points }}</span> pts.</h1>
                </div>
            </div>
        </div>

        <!-- Left Section -->
        <div class="section section-left w-88 min-h-[50vh] float-left">
            {{-- TODO: replace vue with blade animation for overlay when user makes requests - i think it is needed only for pdf export --}}
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>

            <div class="section-divider divider-r">
                <h1 class="m-0 text-right text-2xl">Fleet template by <strong>{{ $fleet->user->name ?? 'Anonymous' }}</strong></h1>
            </div>

            <div class="btn-primary text-2xl my-12 block">Export PDF</div>

            <div class="btn-primary text-2xl my-12 block">Share</div>
            @auth
                <a href="{{ route('builder.edit', ['fleet' => $fleet->id]) }}" class="btn-primary text-2xl my-12 block">Edit</a>
            @else
                {{-- TODO: update href once we have clone & edit route --}}
                <a href="" class="btn-primary text-2xl my-12 block">Clone & Edit</a>
            @endauth

        </div>

        <!-- Right Section -->
        <div class="section section-right w-[calc(100%-400px)] min-h-[50vh] float-right flex flex-col">
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>
            <div class="fleet-setup-container section-divider divider-r flex flex-row">
                <div class="flex-1/3">
                    <!-- Fleet Name -->
                    <div class="section-divider divider-r pb-6 mb-6">
                        <h1 class="text-4xl mb-4">Fleet Template Name</h1>
                        <input type="text"
                               placeholder="Fleet Name"
                               v-model="fleetName"
                               class="bfi-input input-light px-4 py-1 text-xl w-80"
                               maxlength="155"
                        >
                    </div>

                    <!-- Commander Setup -->
                    <CommanderSetup
                        :commanderList="state.commanderList"
                        :commanders="state.commanders"
                        :ships="state.ships"
                        :commanderSelectedShips="state.commanderSelectedShips"
                        @commander-added="handleCommanderAdded"
                        @commander-removed="handleCommanderRemoved"
                        @commander-ship-assigned="handleCommanderShipAssigned"
                        @commander-rerolls-updated="handleCommanderRerollsUpdated"
                    />
                </div>
                <div class="flex-1/3">
                </div>
                <div class="flex-1/3">
                </div>
            </div>

            <!-- Ship Cards -->
            <div class="ship-card-container flex flex-wrap flex-row text-center justify-evenly w-full pt-5">
                <ShipCard
                    v-for="ship in state.ships"
                    :key="ship.pivot.id"
                    :ship="ship"
                    :commander="commanderByShipId[ship.pivot.id]"
                    @ship-removed="handleShipRemoved"
                    @ship-updated="handleShipUpdated"
                />
            </div>
        </div>
    </div>
@endsection
