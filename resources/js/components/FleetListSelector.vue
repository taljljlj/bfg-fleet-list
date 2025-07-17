<script setup>
import { ref, computed } from 'vue';
import caretIcon from '@images/caret-icon.png';

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

const isExpanded = ref(false);

const selectedFleetListName = computed(() => {
    return props.selectedFleetList?.name || '';
});

const handleToggleDropdown = () => {
    if (props.fleetLists && props.fleetLists.length > 0) {
        isExpanded.value = !isExpanded.value;
    }
};

const handleFleetListSelect = (fleetList) => {
    emit('fleet-list-selected', fleetList.id, fleetList.name);
    isExpanded.value = false;
};
</script>

<template>
    <div class="fleet-list-selector">
        <h3>Fleet List:</h3>
        <div class="dropdown" :class="{ expanded: isExpanded }">
            <div class="dropdown-select" @click="handleToggleDropdown">
                <span>{{ selectedFleetListName }}</span>
                <span class="dropdown-caret">
          <img :src="caretIcon" alt="Caret">
        </span>
            </div>
            <div class="dropdown-content" :style="{ display: isExpanded ? 'block' : 'none' }">
                <ul>
                    <li
                        v-for="fleetList in fleetLists"
                        :key="fleetList.id"
                        @click="handleFleetListSelect(fleetList)"
                    >
                        {{ fleetList.name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fleet-list-selector {
    margin-bottom: 1rem;
}

h3 {
    margin-top: 10px;
    margin-bottom: 5px;
    font-weight: 600;
    letter-spacing: 2px;
}

.dropdown {
    position: relative;
}

.dropdown * {
    user-select: none;
}

.dropdown-select {
    position: relative;
    box-sizing: border-box;
    width: 100%;
    height: 35px;
    padding: 5px 15px;
    border: 2px solid #c8c5dc;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1;
}

.dropdown-select:hover {
    box-shadow: inset #c8c5dc 0 0 10px;
}

.dropdown-caret img {
    float: right;
    opacity: 0.7;
}

.dropdown-content {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    box-sizing: border-box;
    width: 100%;
    border: 2px solid #c8c5dc;
    border-top: none;
    backdrop-filter: blur(7px);
    background-color: rgb(54, 87, 115);
    z-index: 10;
    border-radius: 5px;
    box-shadow: #1a202c 0 0 30px, inset #c8c5dc 0 0 30px;
}

.dropdown-content ul {
    list-style: none;
    padding: 0;
}

.dropdown-content li {
    padding: 2px 7px;
    cursor: pointer;
    border-top: 2px solid transparent;
    border-bottom: 2px solid transparent;
}

.dropdown-content li:hover {
    color: white;
    border-color: #c8c5dc;
}

.dropdown.expanded .dropdown-caret img {
  transform: rotate(180deg);
}
</style>
