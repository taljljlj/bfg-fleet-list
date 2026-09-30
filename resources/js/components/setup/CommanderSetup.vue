<script setup>
import {computed, inject, ref} from 'vue';
import addShipIcon from '@images/fleet-builder/add-ship-icon.png';
import extraRerollIcon from '@images/fleet-builder/extra-reroll-icon.png';
import Dropdown from "@/components/controls/Dropdown.vue";
import {useTooltip} from "@/composables/useTooltip.js";

const {showTooltip, clearTooltip} = useTooltip();

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
    },
    commanderSelectedShips: {
        type: Object,
        default: () => ({})
    }
});

const mappedCommanderShipList = computed(() =>
    props.ships.map(ship => ({
        pivotId: ship.pivot.id,
        name: ship.pivot.name ?? ship.class
    }))
);

const fleetData = inject('fleetData');

const emit = defineEmits(['commander-added', 'commander-removed', 'commander-ship-assigned', 'commander-rerolls-updated']);

const showExtraRerolls = ref({});
const selectedRerolls = ref({});

const handleCommanderAdd = (commanderId) => {
    emit('commander-added', commanderId);
};

const handleCommanderRemove = (commanderId) => {
    emit('commander-removed', commanderId);
}

const handleCommanderShipAssigned = (commanderPivotId, shipPivotId, shipName) => {
    emit('commander-ship-assigned', commanderPivotId, shipPivotId, shipName);
};

const handleShowExtraRerolls = async (commander) => {
    console.log(commander);
    if (showExtraRerolls.value[commander.pivot.id]) {
        const commanderRerollId = commander.pivot.commander_reroll_id ?? 0;
        await handleApplyExtraRerolls(commander, commanderRerollId);
    }

    showExtraRerolls.value[commander.pivot.id] = !showExtraRerolls.value[commander.pivot.id];
}

const handleApplyExtraRerolls = async (commander, commanderRerollId) => {
    try {
        const response = await fetch(`/api/${fleetData.fleet.id}/commander-rerolls/${commander.pivot.id}/${commanderRerollId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': fleetData.csrfToken
            },
        });

        const data = await response.json();
        emit('commander-rerolls-updated', data);
    } catch (error) {
        console.error('Error applying extra re-rolls:', error);
        alert('+++ Re-roll Augury Denied +++\r\nThe fleet rejects augmentation. The dice‑spirits refuse the officer’s plea, casting the extra rolls into silence. Review the muster and renew the augury protocol.');

    }
};
</script>

<template>
    <h1 class="text-xl mb-4 md:text-2xl lg:text-4xl">Leadership</h1>
    <ul v-if="commanderList" class="pl-5 text-left section-divider divider-r lg:pl-15">
        <li
            v-for="commander in commanderList"
            :key="commander.id"
            class="my-1 align-middle flex w-full justify-between"
        >
            <span
                class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] inline-block rotate-90 mr-3 lg:mr-2"
                @click="handleCommanderAdd(commander.id)"
            >
                        <img :src="addShipIcon" alt="Add Ship Icon" class="h-3 w-3 lg:h-4 lg:w-4">
            </span>
            <span class="text-sm lg:text-base">{{commander.name}} ({{commander.points}} pts)</span>
            <span class="grow text-right font-family-secondary text-sm lg:text-base">
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
                    class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] mr-2 text-sm lg:text-base"
                    @click="handleCommanderRemove(commander.pivot.id)"
                >
                    ✖
                </span>
                <span class="mx-1 text-sm lg:text-base lg:mx-2">{{commander.name}} ({{ commander.pivot.points ?? commander.points}} pts)</span>
            </div>
            <div class="flex">
                <span class="mx-1 font-family-secondary text-sm lg:text-base lg:mx-2">Ld: {{commander.leadership}}</span>
                <span class="ml-1 font-family-secondary text-sm lg:text-base lg:ml-2">Ship: </span>
            </div>
            <div class="flex-1/4 text-xs lg:text-sm">
                <Dropdown
                    :items="mappedCommanderShipList"
                    :selectedItem="props.commanderSelectedShips[commander.pivot.id]"
                    labelKey="name"
                    valueKey="pivotId"
                    @item-selected="(pivotId, name) => handleCommanderShipAssigned(commander.pivot.id, pivotId, name)"
                    class="mr-1 lg:mr-2"
                />
            </div>
            <div class="flex">
                <span class="mx-1 font-family-secondary text-sm lg:text-base lg:mx-1">Re-rolls: {{commander.pivot.rolls ?? commander.rolls}}</span>
                <div
                    v-if="commander.commander_rerolls.length > 0"
                    class="user-select-none inline-block relative z-10"
                >
                    <img
                        @click="handleShowExtraRerolls(commander)"
                        :src="extraRerollIcon" alt="Buy Extra Rerolls"
                        class="cursor-pointer h-5 opacity-70 hover:opacity-100 hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] lg:h-8"
                    />
                    <div
                        v-show="showExtraRerolls[commander.pivot.id]"
                        class="user-select-none absolute w-36 top-0 right-6 border-2 border-primary-500-opc-80 rounded-md bg-secondary overflow-auto text-primary-500-opc-80 z-50 text-left p-4 lg:top-0 lg:left-10 lg:w-44"
                    >
                        <h3 class="mb-2 text-sm lg:text-base lg:mb-4">Buy extra re-rolls:</h3>
                        <input
                            type="radio"
                            :name="`reroll-${commander.pivot.id}`"
                            :value="0"
                            :id="`reroll-${commander.pivot.id}-0`"
                            v-model="commander.pivot.commander_reroll_id"
                        />
                        <label :for="`reroll-${commander.pivot.id}-0`" class="px-4 text-sm lg:text-base">None</label>
                        <div v-for="reroll in commander.commander_rerolls" :key="reroll.id">
                            <input
                                type="radio"
                                :name="`reroll-${commander.pivot.id}`"
                                :value="reroll.id"
                                :id="`reroll-${commander.pivot.id}-${reroll.id}`"
                                v-model="commander.pivot.commander_reroll_id"
                            />
                            <label :for="`reroll-${commander.pivot.id}-${reroll.id}`" class="px-2 text-sm lg:text-base">
                                +{{ reroll.modifier }} rolls ({{ reroll.points }} pts)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<style scoped>

</style>
