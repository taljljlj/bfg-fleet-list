<script setup>
import addShipIcon from '@images/add-ship-icon.png';

const props = defineProps({
    commanderList: {
        type: Object,
        default: null
    },
    commanders: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['commander-added', 'commander-removed']);

const handleCommanderAdd = (commanderId) => {
    emit('commander-added', commanderId);
};

const handleCommanderRemove = (commanderId) => {
    emit('commander-removed', commanderId);
}

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
                    <span>{{commander.name}} ({{commander.points}} pts)</span>
                    <span
                        class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] inline-block rotate-90 ml-2"
                        @click="handleCommanderAdd(commander.id)"
                    >
                                <img :src="addShipIcon" alt="Add Ship Icon" class="h-4 w-4">
                    </span>
                    <span class="grow text-right">
                        0/1
                    </span>
                </li>
            </ul>
            <ul v-if="commanders">
                <li
                    v-for="commander in commanders"
                    :key="commander.id"
                >
                    <div class="commander-info text-xl align-middle flex w-full justify-center-safe">
                        <span
                            class="cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)] mr-2 text-5xl leading-1 pt-3"
                            @click="handleCommanderRemove(commander.pivot.id)"
                        >
                            ×
                        </span>
                        <span>{{commander.name}}</span>
                        <span>Ld: {{commander.leadership}}</span>
                        <span>Re-rolls: {{commander.rolls}}</span>
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
