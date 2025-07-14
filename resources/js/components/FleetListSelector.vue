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

.dropdown {
  position: relative;
}

.dropdown-select {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
  background: #f8f9fa;
}

.dropdown-select:hover {
  background: #e9ecef;
}

.dropdown-content {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 1px solid #ccc;
  border-top: none;
  border-radius: 0 0 4px 4px;
  z-index: 1000;
}

.dropdown-content ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.dropdown-content li {
  padding: 0.75rem 1rem;
  cursor: pointer;
  border-bottom: 1px solid #eee;
}

.dropdown-content li:hover {
  background: #e9ecef;
}

.dropdown-content li:last-child {
  border-bottom: none;
}

.dropdown-caret img {
  width: 12px;
  height: 12px;
  transition: transform 0.2s ease;
}

.dropdown.expanded .dropdown-caret img {
  transform: rotate(180deg);
}
</style>
