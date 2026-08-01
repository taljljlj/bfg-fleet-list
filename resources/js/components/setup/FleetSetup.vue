<script setup>
import {computed, onMounted, ref} from 'vue';
import addShipIcon from '@images/add-ship-icon.png';
import Dropdown from "@/components/controls/Dropdown.vue";

const props = defineProps({
    commanderList: {
        type: Object,
        default: null
    },
    commanders: {
        type: Object,
        default: null
    },
    ships: {
        type: Object,
        default: null
    }
});

const mappedCommanderShipList = computed(() =>
    props.ships.map(ship => ({
        pivotId: ship.pivot.id,
        name: ship.pivot.name ?? ship.class
    }))
);


const emit = defineEmits(['commander-added', 'commander-removed', 'commander-ship-assigned']);

const selectedShips = ref({});

const handleCommanderAdd = (commanderId) => {
    emit('commander-added', commanderId);
};

const handleCommanderRemove = (commanderId) => {
    emit('commander-removed', commanderId);
}

const handleCommanderShipAssigned = (commanderPivotId, shipPivotId, shipName) => {
    selectedShips.value[commanderPivotId] = { pivotId: shipPivotId, name: shipName };
    emit('commander-ship-assigned', commanderPivotId, shipPivotId);
};

onMounted(() => {
    if (props.commanders) {
        props.commanders.forEach(commander => {
            if (commander.pivot?.fleet_ship_id) {
                const ship = props.ships.find(s => s.pivot.id === commander.pivot.fleet_ship_id);
                if (ship) {
                    selectedShips.value[commander.pivot.id] = {
                        pivotId: ship.pivot.id,
                        name: ship.pivot.name ?? ship.class
                    };
                }
            }
        });
    }
});
</script>

<template>
    <div class="fleet-setup-container section-divider divider-r flex flex-row">
        <div class="commanders-container flex-1/3">
            <h1 class="text-4xl">Leadership</h1>
            <ul v-if="commanderList" class="pl-15 text-left section-divider divider-r">
                <li
                    v-for="commander in commanderList"
                    :key="commander.id"
                    class="my-1 align-middle flex w-full justify-between"
                >
                    <span
                        class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] inline-block rotate-90 mr-2"
                        @click="handleCommanderAdd(commander.id)"
                    >
                                <img :src="addShipIcon" alt="Add Ship Icon" class="h-4 w-4">
                    </span>
                    <span>{{commander.name}} ({{commander.points}} pts)</span>
                    <span class="grow text-right font-family-secondary">
                        0/1
                    </span>
                </li>
            </ul>
            <ul v-if="commanders">
                <li
                    v-for="commander in commanders"
                    :key="commander.id"
                    class="my-1 commander-info text-xl w-full flex items-center justify-between"
                >
                    <div class="flex grow">
                        <span
                            class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] mr-2"
                            @click="handleCommanderRemove(commander.pivot.id)"
                        >
                            ✖
                        </span>
                        <span class="mx-2">{{commander.name}} ({{commander.points}} pts)</span>
                    </div>
                    <div class="flex">
                        <span class="mx-2 font-family-secondary">Ld: {{commander.leadership}}</span>
                        <span class="mx-2 font-family-secondary">Re-rolls: {{commander.rolls}}</span>
                        <span class="mx-2 font-family-secondary">Ship: </span>
                    </div>
                    <div class="flex-1/4">
                        <Dropdown
                            :items="mappedCommanderShipList"
                            :selectedItem="selectedShips[commander.pivot.id]"
                            labelKey="name"
                            valueKey="pivotId"
                            @item-selected="(pivotId, name) => handleCommanderShipAssigned(commander.pivot.id, pivotId, name)"
                        />
                    </div>
                </li>
            </ul>
        </div>
        <div class="fleet-list-conditions-container flex-1/3">

        </div>
        <div class="fleet-list-conditions-container flex-1/3">

        </div>
    </div>
</template>

<style scoped>

</style>
