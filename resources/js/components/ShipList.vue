<script setup>
import caretIcon from '@images/caret-icon.png';
import addShipIcon from '@images/add-ship-icon.png';

const props = defineProps({
    shipList: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['ship-selected']);

const handleShipAdd = (shipId) => {
    emit('ship-selected', shipId);
};

const toggleGroup = (event) => {
    event.currentTarget.parentElement.classList.toggle('collapsed');
}


</script>

<template>
    <div class="ship-list">
        <ul v-if="shipList">
            <li
                v-for="(shipGroup, shipType) in shipList"
                :key="shipType"
                class="ship-type-group group collapsed text-white py-1"
            >
                <h4
                    class="ship-type-group-title ship-list-separator relative flex items-center justify-end gap-2.5 pb-1 text-right text-secondary cursor-pointer text-lg tracking-wide "
                    @click="toggleGroup"
                >
                    <span>{{ shipType }}s</span>
                    <span class="caret-icon">
                        <img :src="caretIcon" alt="caret-icon" class="h-6 opacity-70 rotate-180 group-[.collapsed]:rotate-0">
                    </span>
                </h4>
                <ul class="ship-type-container ship-list-separator relative group-[.collapsed]:hidden">
                    <li
                        v-for="ship in shipGroup"
                        :key="ship.id"
                        class="text-white py-1 font-family-secondary tracking-wide align-middle flex justify-between"
                    >
                        <span class="ship-class grow text-left">
                          {{ ship.class }}{{ ship.type === 'Escort' ? ' Squadron' : '' }}
                        </span>
                        <span class="ship-pts font-secondary tracking-tight mx-2.5">
                            {{ ship.points }}
                        </span>
                        <span
                            class="ship-add-btn text-right cursor-pointer opacity-70 hover:opacity-100 user-select-none hover:filter-[drop-shadow(0_0_10px_#c8c5dc)_hue-rotate(45deg)]"
                            @click="handleShipAdd(ship.id)"
                        >
                            <img :src="addShipIcon" alt="Add Ship Icon" class="h-6 w-6">
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>
