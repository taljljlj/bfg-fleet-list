import { createApp } from 'vue';
import FleetBuilder from './components/FleetBuilder.vue';

// Create Vue app only if fleet builder container exists
const fleetBuilderContainer = document.getElementById('fleet-builder-app');
if (fleetBuilderContainer) {
    const app = createApp(FleetBuilder);

    // Pass Laravel data to Vue
    app.provide('fleetData', {
        fleet: JSON.parse(fleetBuilderContainer.dataset.fleet),
        factions: JSON.parse(fleetBuilderContainer.dataset.factions),
        fleetLists: JSON.parse(fleetBuilderContainer.dataset.fleetLists || 'null'),
        selectedFleetList: JSON.parse(fleetBuilderContainer.dataset.selectedFleetList || 'null'),
        shipList: JSON.parse(fleetBuilderContainer.dataset.shipList || 'null'),
        ships: JSON.parse(fleetBuilderContainer.dataset.ships || 'null'),
        csrfToken: fleetBuilderContainer.dataset.csrfToken
    });

    app.mount('#fleet-builder-app');
}
