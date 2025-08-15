<script setup>
    import { ref, reactive, inject, computed } from 'vue';
    import FactionSelector from './FactionSelector.vue';
    import FleetListSelector from './FleetListSelector.vue';
    import ShipList from './ShipList.vue';
    import ShipCard from './ship-card/ShipCard.vue';
    import loadingIcon from '@images/loading-icon.png';

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
        alert('A disruption in the sacred data-rites has occurred. Twisted forces of the Warp have cast their afflictions upon your fleet. Reinstate your will and attempt anew, lest chaos consume this endeavor.');
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
        alert('Submission failed. Please check your input.');
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
        alert('Submission failed. Please check your input.');
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
        alert('Submission failed. Please check your input.');
      } finally {
        state.isLoading = false;
      }
    };

    const handleExportPdf = async () => {
      try {
        const response = await fetch(`/api/${state.fleet.id}/export-pdf/`, {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': fleetData.csrfToken
          }
        });

        if (response.status !== 200) {
          throw new Error('Failed to download PDF');
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
        alert('Submission failed. Please check your input.');
      }
    };
</script>

<template>
  <div class="fleet-builder">
    <!-- Faction Selection -->
    <div class="section section-top">
      <FactionSelector
        :factions="state.factions"
        :selected-faction-id="selectedFactionId"
        @faction-selected="handleFactionSelected"
      />
    </div>

    <!-- Left Section -->
    <div class="section section-left">
      <div class="section-overlay" v-if="state.isLoading" style="visibility: visible">
        <img :src="loadingIcon" alt="Loading Icon">
      </div>

      <!-- Points Counter -->
      <div class="section-subsection">
        <h1><span id="points">{{ fleetPoints }}</span> pts.</h1>
      </div>

      <!-- Fleet List Selector -->
      <div class="section-subsection">
        <FleetListSelector
          :fleet-lists="state.fleetLists"
          :selected-fleet-list="state.selectedFleetList"
          @fleet-list-selected="handleFleetListSelected"
        />
      </div>

      <!-- Ship List -->
      <div class="section-subsection last">
        <ShipList
          :ship-list="state.shipList"
          @ship-selected="handleShipAdded"
        />
      </div>
    </div>

    <!-- Right Section -->
    <div class="section section-right">
      <div class="section-overlay" v-if="state.isLoading" style="visibility: visible">
        <img :src="loadingIcon" alt="Loading Icon">
      </div>

      <!-- Fleet Actions -->
      <div class="fleet-actions">
        <a :href="`/test-pdf/${state.fleet.id}`">Test Pdf</a>
        <button @click="handleExportPdf" class="export-btn">Export PDF</button>
        <button id="exportUrl" class="export-btn">Share URL</button>
        <button id="exportStore" class="export-btn">Save</button>
      </div>

      <!-- Ship Cards -->
      <div class="ship-card-container">
        <ShipCard
          v-for="ship in state.ships"
          :key="ship.pivot.id"
          :ship="ship"
          @ship-removed="handleShipRemoved"

        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.fleet-builder {
    position: relative;
}

.section-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 100;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(7px);
    background-color: rgba(54, 87, 115, 0.5);
}

.section-overlay img {
    width: 50px;
    height: 50px;
    animation: spin 2s ease-in-out infinite;
    -moz-animation: spin 2s linear infinite;
    -webkit-animation: spin 2s ease-in-out infinite;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}

@-moz-keyframes spin{
    100% { transform: rotate(360deg); }
}

@-webkit-keyframes spin{
    100% { transform: rotate(360deg); }
}

.section-left {
    width: 300px;
    min-height: 50vh;
    float: left;
}

.section-left .section-subsection {
    position: relative;
    padding-bottom: 10px;
}

.section-left .section-subsection:after {
    position: absolute;
    display: block;
    content: "";
    bottom: 0;
    right: -25px;
    height: 3px;
    width: 300px;
    background: linear-gradient(to right, transparent 0%, #c8c5dc 100%);
}

.section-left .section-subsection.last:after {
    display: none;
    padding-bottom: 0;
}

.section-left h1 {
    margin: 0;
    text-align: right;
}

.section-right {
    width: calc(100% - 450px);
    min-height: 50vh;
    float: right;
    display: flex;
    flex-direction: column;
}

.fleet-actions {
    box-sizing: border-box;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    height: 50px;
    padding: 10px;
    border: 2px solid #c8c5dc;
    border-radius: 5px;
    background-color: rgb(78, 108, 135);
    backdrop-filter: blur(7px);
    margin-bottom: 25px;
}

.fleet-actions button {
    border-radius: 5px;
    border-color: rgb(116, 166, 175);
    font-family: "League Gothic", sans-serif;
    font-size: 18px;
    letter-spacing: 1px;
    background-color: #c8c5dc;
    cursor: pointer;
    width: 90px;
}

.fleet-actions button:hover {
    color: rgb(54, 87, 115);
    box-shadow: 0 0 10px #c8c5dc;
}

.ship-card-container {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    text-align: center;
    justify-content: space-evenly;
    width: 100%;
}
</style>
