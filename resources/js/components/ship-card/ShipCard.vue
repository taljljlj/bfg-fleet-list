<script setup>
import { ref, computed } from 'vue';
import ShipStatsSection from './ShipStatsSection.vue';
import ShipArmamentsSection from './ShipArmamentsSection.vue';
import ShipRulesSection from './ShipRulesSection.vue';
import ShipRefitsModal from './ShipRefitsModal.vue';

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['ship-removed', 'ship-updated']);

const showRefitsModal = ref(false);

const shipPoints = computed(() => {
  return props.ship.type === 'Escort'
    ? props.ship.pivot.points * props.ship.pivot.squadron_counter
    : props.ship.pivot.points;
});

const handleRemoveShip = () => {
  emit('ship-removed', props.ship.pivot.id);
};

const handleShowRefits = () => {
  showRefitsModal.value = true;
};

const handleRefitsApplied = (updatedShip) => {
  emit('ship-updated', updatedShip);
  showRefitsModal.value = false;
};

const handleUpdateAttribute = (attribute, value) => {
  emit('ship-updated', {
    ...props.ship,
    pivot: {
      ...props.ship.pivot,
      [attribute]: value
    }
  });
};
</script>

<template>
  <div class="card-ship" :data-id="ship.id" :data-pivot-id="ship.pivot.id">
    <div class="card-ship-header">
      <div class="card-ship-header-left">
        <h3>{{ ship.class }}{{ ship.type === 'Escort' ? ' Squadron' : '' }}</h3>
        <input
          type="text"
          :value="ship.pivot.name || ship.class"
          @input="handleUpdateAttribute('name', $event.target.value)"
          name="cardShipName"
        />
      </div>
      <div class="card-ship-header-right">
        <span class="card-ship-points">
          <input
            type="number"
            :value="shipPoints"
            @input="handleUpdateAttribute('points', $event.target.value)"
            name="cardShipPts"
          /> pts
        </span>
        <button
          class="card-ship-refit-btn"
          @click="handleShowRefits"
          v-if="ship.refits && ship.refits.length > 0"
        >
          R
        </button>
        <button class="card-ship-remove-btn" @click="handleRemoveShip">×</button>
      </div>
    </div>

    <div class="card-ship-body">
      <ShipStatsSection :ship="ship" @update-attribute="handleUpdateAttribute" />
      <ShipArmamentsSection :armaments="ship.armaments" />
      <ShipRulesSection :rules="ship.rules" />
    </div>

    <ShipRefitsModal
      v-if="showRefitsModal"
      :ship="ship"
      @close="showRefitsModal = false"
      @refits-applied="handleRefitsApplied"
    />
  </div>
</template>

<style scoped>
.card-ship {
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-bottom: 1rem;
  background: white;
}

.card-ship-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background: #f5f5f5;
  border-bottom: 1px solid #ccc;
}

.card-ship-header-right {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.card-ship-remove-btn {
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 0.25rem 0.5rem;
  cursor: pointer;
}

.card-ship-refit-btn {
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 0.25rem 0.5rem;
  cursor: pointer;
}

.card-ship-body {
  padding: 1rem;
}
</style>
