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
        commanderList: JSON.parse(fleetBuilderContainer.dataset.commanderList || 'null'),
        commanders: JSON.parse(fleetBuilderContainer.dataset.commanders || 'null'),
        csrfToken: fleetBuilderContainer.dataset.csrfToken,
        routes: JSON.parse(fleetBuilderContainer.dataset.webRoutes || '{}')
    });

    app.mount('#fleet-builder-app');
}
