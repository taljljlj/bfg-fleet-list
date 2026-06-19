<script setup>
    import { reactive, inject, computed } from 'vue';
    import FactionSelector from './setup/FactionSelector.vue';
    import FleetListSelector from './setup/FleetListSelector.vue';
    import ShipList from './setup/ShipList.vue';
    import ShipCard from './ship-card/ShipCard.vue';
    import loadingIcon from '@images/loading-icon.png';
    import MessageBox from './commons/MessageBox.vue';
    import FleetActions from "@/components/controls/FleetActions.vue";

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
      isLoading: false
    });

    // Computed properties
    const fleetPoints = computed(() => state.fleet.points);
    const selectedFactionId = computed(() => state.fleet.faction_id);

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

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Cogitator Rejects Allegiance +++\r\nA disruption in the sacred data-rites has occurred. Reinstate your will and attempt anew.');
      } finally {
        state.isLoading = false;
      }
    };

    const handleFleetListSelected = async (fleetListId, fleetListName) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/fleet-list/${fleetListId}`);

        // Update state
        state.selectedFleetList = { id: fleetListId, name: fleetListName };
        state.shipList = data.shipList;

        // Handle excluded ships
        if (data.excludedShipsData) {
          state.fleet.points = data.excludedShipsData.points;
          const excludedShipIds = data.excludedShipsData.shipIds;
          state.ships = state.ships.filter(ship => !excludedShipIds.includes(ship.id));
        }

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Void Registry Corrupted +++\r\nThe Machine Spirit rejects the fleet list change. Purge errors and attempt the ritual anew.');
      } finally {
        state.isLoading = false;
      }
    };

    const handleShipAdded = async (shipId) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/ship-add/${shipId}`);

        state.fleet.points = data.fleetPoints;

        state.ships.push(data.ship);
        state.ships.sort((a, b) => a.order - b.order);

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Ship Integration Denied +++\r\nThe fleet list rejects alteration. The vessel is cast adrift, refusing induction into the fleet manifest.');
      } finally {
        state.isLoading = false;
      }
    };

    const handleShipRemoved = async (shipPivotId) => {
      state.isLoading = true;
      try {
        const data = await apiCall(`/api/${state.fleet.id}/ship-remove/${shipPivotId}`);

        // Update state
        state.fleet.points = data.points;
        state.ships = state.ships.filter(ship => ship.pivot.id !== shipPivotId);

      } catch (error) {
        console.error('Error:', error);
        alert('+++ Ship Purge Denied +++\r\nThe fleet list refuses alteration. The vessel clings to the roster as if possessed.');
      } finally {
        state.isLoading = false;
      }
    };

    const handleShipUpdated = (data) => {
        const shipIndex = state.ships.findIndex(ship => ship.pivot.id === data.ship.pivot.id);
        if (shipIndex !== -1) {
            state.ships[shipIndex] = data.ship;
        }

        state.fleet.points = data.fleetPoints;
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
      <div class="section-subsection">
        <h1 class="m-0 text-right text-4xl font-bold"><span id="points">{{ fleetPoints }}</span> pts.</h1>
      </div>

      <!-- Fleet Actions -->
      <FleetActions
        :fleet-id="state.fleet.id"
        :on-export-pdf="handleExportPdf"
      />

      <!-- Fleet List Selector -->
      <div class="section-subsection">
        <FleetListSelector
          :fleet-lists="state.fleetLists"
          :selected-fleet-list="state.selectedFleetList"
          @fleet-list-selected="handleFleetListSelected"
        />
      </div>

      <!-- Ship List -->
      <div class="section-subsection pb-2.5 last">
        <ShipList
          :ship-list="state.shipList"
          @ship-selected="handleShipAdded"
        />
      </div>
    </div>

    <!-- Right Section -->
    <div class="section section-right w-[calc(100%-400px)] min-h-[50vh] float-right flex flex-col">
      <div class="section-overlay" v-if="state.isLoading" style="visibility: visible">
        <img :src="loadingIcon" alt="Loading Icon">
      </div>

      <!-- Ship Cards -->
      <div class="ship-card-container flex flex-wrap flex-row text-center justify-evenly w-full">
        <ShipCard
          v-for="ship in state.ships"
          :key="ship.pivot.id"
          :ship="ship"
          @ship-removed="handleShipRemoved"
          @ship-updated="handleShipUpdated"
        />
      </div>
    </div>
  </div>
</template>
