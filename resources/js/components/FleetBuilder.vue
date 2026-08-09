<script setup>
import {reactive, inject, computed, onMounted, watch} from 'vue';
    import FactionSelector from './setup/FactionSelector.vue';
    import FleetListSelector from './setup/FleetListSelector.vue';
    import ShipList from './setup/ShipList.vue';
    import ShipCard from './ship-card/ShipCard.vue';
    import loadingIcon from '@images/loading-icon.png';
    import MessageBox from './commons/MessageBox.vue';
    import FleetActions from "@/components/controls/FleetActions.vue";
    import FleetSetup from "@/components/setup/FleetSetup.vue";
    import {useTooltip} from "@/composables/useTooltip.js";

    // Inject data from Laravel
    const fleetData = inject('fleetData');

    // Reactive state
    const state = reactive({
      fleet: fleetData.fleet,
      factions: fleetData.factions,
      fleetLists: fleetData.fleetLists,
      selectedFleetList: fleetData.selectedFleetList,
      shipList: fleetData.shipList,
      ships: fleetData.ships || [],
      commanderList: fleetData.commanderList,
      commanders: fleetData.commanders || [],
      isLoading: false,
      commanderSelectedShips: {}
    });

    // Computed properties
    const fleetPoints = computed(() => state.fleet.points);
    const selectedFactionId = computed(() => state.fleet.faction_id);

    // Message handling
    const {showTooltip, clearTooltip} = useTooltip();

    // API helper function
    const apiCall = async (url, method = 'PATCH', body = null) => {
      const options = {
        method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': fleetData.csrfToken
        }
      };

      if (body) {
        options.body = JSON.stringify(body);
      }

      const response = await fetch(url, options);
      return await response.json();
    };

    // Event handlers
    const handleFactionSelected = async (factionId) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/faction/${factionId}`);

        // Update state
        state.fleet.faction_id = factionId;
        state.fleet.points = 0;
        state.fleetLists = data.fleetLists;
        state.selectedFleetList = null;
        state.shipList = null;
        state.ships = [];
        state.commanderList = null;
        state.commanders = [];

        showTooltip(data.message);

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Cogitator Rejects Allegiance +++\r\nA disruption in the sacred data-rites has occurred. Reinstate your will and attempt anew.');
      } finally {
        state.isLoading = false;
        setTimeout(() => {
            clearTooltip();
        }, 5000);
      }
    };

    const handleFleetListSelected = async (fleetListId, fleetListName) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/fleet-list/${fleetListId}`);

        // Update state
        state.selectedFleetList = { id: fleetListId, name: fleetListName };
        state.shipList = data.shipList;
        state.commanderList = data.commanderList;
        state.commanders.length = 0; //state.commanders = [] is not working with the way reactivity is initialized for some reason, but mutating array like this forces DOM re-rendering

        // Handle excluded ships
        if (data.excludedShipsData) {
          state.fleet.points = data.excludedShipsData.points;
          const excludedShipIds = data.excludedShipsData.shipIds;
          state.ships = state.ships.filter(ship => !excludedShipIds.includes(ship.id));
        }

        showTooltip(data.message);

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Void Registry Corrupted +++\r\nThe Machine Spirit rejects the fleet list change. Purge errors and attempt the ritual anew.');
      } finally {
        state.isLoading = false;
        setTimeout(() => {
            clearTooltip();
        }, 5000);
      }
    };

    const handleShipAdded = async (shipId) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/ship-add/${shipId}`);

        state.fleet.points = data.fleetPoints;

        state.ships.push(data.ship);
        state.ships.sort((a, b) => a.order - b.order);

        showTooltip(data.message);
      } catch (error) {
        console.error('Error:', error);
        alert('+++ Ship Integration Denied +++\r\nThe fleet list rejects alteration. The vessel is cast adrift, refusing induction into the fleet manifest.');
      } finally {
        state.isLoading = false;
        setTimeout(() => {
            clearTooltip();
        }, 5000);
      }
    };

    const handleShipRemoved = async (shipPivotId) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/ship-remove/${shipPivotId}`);

        // Update state
        state.fleet.points = data.points;
        state.ships = state.ships.filter(ship => ship.pivot.id !== shipPivotId);

        const commanderIndex = state.commanders.findIndex(commander => commander.pivot.fleet_ship_id === shipPivotId);
        console.log(commanderIndex);
        if (commanderIndex !== -1) {
            state.commanders[commanderIndex].pivot.fleet_ship_id = null;
            const commanderPivotId = state.commanders[commanderIndex].pivot.id;
            delete state.commanderSelectedShips[commanderPivotId];
        }

        showTooltip(data.message);
      } catch (error) {
        console.error('Error:', error);
        alert('+++ Ship Purge Denied +++\r\nThe fleet list refuses alteration. The vessel clings to the roster as if possessed.');
      } finally {
        state.isLoading = false;
        setTimeout(() => {
            clearTooltip();
        }, 5000);
      }
    };

    const handleShipUpdated = (data) => {
        const shipIndex = state.ships.findIndex(ship => ship.pivot.id === data.ship.pivot.id);
        if (shipIndex !== -1) {
            state.ships[shipIndex] = data.ship;
        }

        state.fleet.points = data.fleetPoints;

        showTooltip(data.message);
        setTimeout(() => {
            clearTooltip();
        }, 5000);
    }

    const handleExportPdf = async () => {
      try {
        const response = await fetch(`/api/${state.fleet.id}/export-pdf/`, {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': fleetData.csrfToken
          }
        });

        if (response.status !== 200) {
            console.error('Failed to fetch PDF:', response.status, response.statusText);
            alert('+++ Vox Interruption +++\r\nData-slate request denied. The Machine Spirit refuses to yield the PDF. Review fleet data and renew the request.');
            return;
        }

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'fleet-builder.pdf';
        document.body.appendChild(a);
        a.click();
        a.remove();

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Vox Interruption +++\r\nData-slate request denied. The Machine Spirit refuses to yield the PDF. Review fleet data and renew the request.');
      }
    };

    const handleCommanderAdded = async (commanderId) => {
        state.isLoading = true;
        try {
            const data = await apiCall(`/api/${state.fleet.id}/commander-add/${commanderId}`);

            state.fleet.points = data.fleetPoints;

            state.commanders.push(data.commander);

            showTooltip(data.message);
        } catch (error) {
            console.error('Error:', error);
            alert('+++ Command Induction Denied +++\r\nThe fleet rejects leadership. The officer is cast aside, unrecognized by the muster and barred from command. Audit fleet records and resubmit the officer\'s commission');
        } finally {
            state.isLoading = false;
            setTimeout(() => {
                clearTooltip();
            }, 5000);
        }
    }

    const handleCommanderRemoved = async (commanderPivotId) => {
        state.isLoading = true;
        try {
            const data = await apiCall(`/api/${state.fleet.id}/commander-remove/${commanderPivotId}`);

            state.fleet.points = data.fleetPoints;
            state.commanders = state.commanders.filter(commander => commander.pivot.id !== commanderPivotId);

            resetUnassignedShip(data.unassignedShip);

            showTooltip(data.message);
        } catch (error) {
            console.error('Error:', error);
            alert('+++ Command Purge Denied +++\r\nThe fleet rejects alteration. The officer clings to the muster rolls, refusing expulsion from command. Review fleet records and renew the purge protocol.');
        } finally {
            state.isLoading = false;
            setTimeout(() => {
                clearTooltip();
            }, 5000);
        }
    }

    const handleCommanderShipAssigned = async (commanderPivotId, shipPivotId, shipName) => {
        state.isLoading = true;
        try {
            const data = await apiCall(`/api/${state.fleet.id}/commander-ship-assign/${commanderPivotId}/${shipPivotId}`);

            const commander = state.commanders.find(commander => commander.pivot.id === commanderPivotId);
            if (commander) {
                commander.pivot.fleet_ship_id = shipPivotId;
            }

            const shipIndex = state.ships.findIndex(ship => ship.pivot.id === data.ship.pivot.id);
            if (shipIndex !== -1) {
                Object.assign(state.ships[shipIndex], data.ship);
            }

            state.commanderSelectedShips[commanderPivotId] = { pivotId: shipPivotId, name: shipName };

            resetUnassignedShip(data.unassignedShip);

            showTooltip(data.message);
        } catch (error) {
            console.error('Error:', error);
            alert('+++ Command Assignment Denied +++\r\nThe fleet resists alteration. The vessel rejects new command, its logs corrupted and its crew unyielding. Purge archives and resubmit the assignment order.');
        } finally {
            state.isLoading = false;
            setTimeout(() => {
                clearTooltip();
            }, 5000);
        }
    }

    const resetUnassignedShip = (unassignedShip) => {
        if (!unassignedShip) return;

        const unassignedShipIndex = state.ships.findIndex(
            ship => ship.pivot.id === unassignedShip.pivot.id
        );
        if (unassignedShipIndex !== -1) {
            Object.assign(state.ships[unassignedShipIndex], unassignedShip);
        }
    };

    const handleCommanderRerollsUpdated = async (data) => {
        state.fleet.points = data.fleetPoints;

        const index = state.commanders.findIndex(c => c.id === data.commander.id);
        if (index !== -1) {
            state.commanders.splice(index, 1, data.commander);
        }
    }

    const commanderByShipId = computed(() => {
        const commanders = {};

        state.commanders.forEach(commander => {
            const shipId = commander.pivot?.fleet_ship_id;

            if (shipId !== null && shipId !== undefined) {
                commanders[shipId] = commander;
            }
        });

        return commanders;
    });

    onMounted(() => {
        prefillCommanderSelectedShips();
    });

    watch(
        () => state.commanders,
        () => {
            prefillCommanderSelectedShips();
        },
        { immediate: true }
    );

    function prefillCommanderSelectedShips() {
        const prefilled = {};
        state.commanders.forEach(commander => {
            if (commander.pivot?.fleet_ship_id) {
                const ship = state.ships.find(s => s.pivot.id === commander.pivot.fleet_ship_id);
                if (ship) {
                    prefilled[commander.pivot.id] = {
                        pivotId: ship.pivot.id,
                        name: ship.pivot.name ?? ship.class
                    };
                }
            }
        });
        state.commanderSelectedShips = prefilled;
    }
</script>

<template>
  <div class="fleet-builder relative">
    <div class="fixed z-50 top-5 left-1">
        <MessageBox />
    </div>
    <!-- Faction Selection -->
    <div class="section section-top">
      <FactionSelector
        :factions="state.factions"
        :selected-faction-id="selectedFactionId"
        @faction-selected="handleFactionSelected"
      />
    </div>

    <!-- Left Section -->
    <div class="section section-left w-88 min-h-[50vh] float-left">
      <div class="section-overlay" v-if="state.isLoading" style="visibility: visible">
        <img :src="loadingIcon" alt="Loading Icon">
      </div>

      <!-- Points Counter -->
      <div class="section-divider divider-l">
        <h1 class="m-0 text-right text-4xl font-bold"><span id="points">{{ fleetPoints }}</span> pts.</h1>
      </div>

        <!-- Fleet Actions -->
        <FleetActions
            :fleet-id="state.fleet.id"
            :on-export-pdf="handleExportPdf"
        />

        <!-- Fleet List Selector -->
        <FleetListSelector
            :fleet-lists="state.fleetLists"
            :selected-fleet-list="state.selectedFleetList"
            @fleet-list-selected="handleFleetListSelected"
        />

        <!-- Ship List -->
        <ShipList
            :ship-list="state.shipList"
            @ship-selected="handleShipAdded"
        />

    </div>

    <!-- Right Section -->
    <div class="section section-right w-[calc(100%-400px)] min-h-[50vh] float-right flex flex-col">
      <div class="section-overlay" v-if="state.isLoading" style="visibility: visible">
        <img :src="loadingIcon" alt="Loading Icon">
      </div>

        <!-- Fleet Setup -->
        <FleetSetup
            :commanderList="state.commanderList"
            :commanders="state.commanders"
            :ships="state.ships"
            :commanderSelectedShips="state.commanderSelectedShips"
            @commander-added="handleCommanderAdded"
            @commander-removed="handleCommanderRemoved"
            @commander-ship-assigned="handleCommanderShipAssigned"
            @commander-rerolls-updated="handleCommanderRerollsUpdated"
        />

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
</template>
