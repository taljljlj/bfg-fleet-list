<script setup>
import Dropdown from "@/components/controls/Dropdown.vue";

const props = defineProps({
    fleetLists: {
        type: Array,
        default: () => []
    },
    selectedFleetList: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['fleet-list-selected']);

const handleFleetListSelected = (id, name) => {
    emit('fleet-list-selected', id, name);
};
</script>

<template>
    <div class="section-divider divider-r">
        <div class="fleet-list-selector mb-4">
            <h3 class="mt-2.5 mb-1 tracking-widest font-semibold text-lg">Fleet List:</h3>
            <Dropdown
                :items="fleetLists"
                :selectedItem="selectedFleetList"
                @item-selected="handleFleetListSelected"
            />
        </div>
    </div>
</template>
