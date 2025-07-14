<script setup>
import { ref } from 'vue';
import caretIcon from '@images/caret-icon.png';
import addShipIcon from '@images/add-ship-icon.png';

const props = defineProps({
    shipList: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['ship-selected']);

const collapsedGroups = ref(new Set());

const handleShipAdd = (shipId) => {
    emit('ship-selected', shipId);
};

const toggleGroup = (shipType) => {
    if (collapsedGroups.value.has(shipType)) {
        collapsedGroups.value.delete(shipType);
    } else {
        collapsedGroups.value.add(shipType);
    }
};

const isGroupCollapsed = (shipType) => {
    return collapsedGroups.value.has(shipType);
};
</script>

<template>
    <div class="ship-list">
        <ul v-if="shipList">
            <li
                v-for="(shipGroup, shipType) in shipList"
                :key="shipType"
                class="ship-type-group"
                :class="{ collapsed: isGroupCollapsed(shipType) }"
            >
                <h4
                    class="ship-type-group-title"
                    @click="toggleGroup(shipType)"
                >
                    {{ shipType }}s
                    <span class="caret-icon">
            <img :src="caretIcon" alt="caret-icon">
          </span>
                </h4>
                <ul class="ship-type-container thin-font">
                    <li v-for="ship in shipGroup" :key="ship.id">
            <span class="ship-class">
              {{ ship.class }}{{ ship.type === 'Escort' ? ' Squadron' : '' }}
            </span>
                        <span class="ship-pts">{{ ship.points }}</span>
                        <span
                            class="ship-add-btn"
                            @click="handleShipAdd(ship.id)"
                        >
              <img :src="addShipIcon" alt="Add Ship Icon">
            </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.ship-list ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.ship-type-group {
  margin-bottom: 0.5rem;
}

.ship-type-group-title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  background: #e9ecef;
  border-radius: 4px;
  cursor: pointer;
  margin: 0;
  font-size: 1rem;
  text-align: right;
}

.ship-type-group-title:hover {
  background: #dee2e6;
}

.ship-type-container {
  padding-left: 1rem;
  transition: max-height 0.3s ease;
}

.ship-type-group.collapsed .ship-type-container {
  display: none;
}

.ship-type-container li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0;
}

.ship-class {
  flex-grow: 1;
}

.ship-pts {
  margin-right: 0.5rem;
  font-weight: bold;
}

.ship-add-btn {
  cursor: pointer;
  padding: 0.25rem;
  border-radius: 4px;
  transition: background-color 0.2s ease;
}

.ship-add-btn:hover {
  background: #f0f0f0;
}

.ship-add-btn img {
  width: 16px;
  height: 16px;
}

.caret-icon img {
  width: 12px;
  height: 12px;
  transition: transform 0.2s ease;
}

.ship-type-group.collapsed .caret-icon img {
  transform: rotate(-90deg);
}

.thin-font {
  font-weight: 300;
}
</style>
