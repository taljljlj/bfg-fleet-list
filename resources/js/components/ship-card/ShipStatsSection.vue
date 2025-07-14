<script setup>
const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['update-attribute']);

const handleSquadronCounterUpdate = (value) => {
  emit('update-attribute', 'squadron_counter', value);
};

const handleLeadershipUpdate = (value) => {
  emit('update-attribute', 'leadership', value);
};
</script>

<template>
  <div class="ship-stats-section-container">
    <div class="card-ship-stats card-box-container">
      <div class="card-ship-stats-item">
        <strong>Speed:</strong> {{ ship.pivot.speed }}cm
      </div>
      <div class="card-ship-stats-item">
        <strong>Turns:</strong> {{ ship.pivot.turns }}
      </div>
      <div class="card-ship-stats-item">
        <strong>Shields:</strong> {{ ship.pivot.shields }}
      </div>
      <div class="card-ship-stats-item">
        <strong>Armour:</strong> {{ ship.pivot.armour }}+
      </div>
      <div class="card-ship-stats-item">
        <strong>Turrets:</strong> {{ ship.pivot.turrets }}
      </div>
      <div class="card-ship-stats-item">
        <strong>Leadership:</strong>
        <input
          type="number"
          :value="ship.pivot.leadership"
          @input="handleLeadershipUpdate($event.target.value)"
          name="cardShipLd"
        />
      </div>

      <!-- Squadron Counter for Escort ships -->
      <div v-if="ship.type === 'Escort'" class="card-ship-stats-item squadron-counter-input">
        <strong>Squadron:</strong>
        <input
          type="number"
          :value="ship.pivot.squadron_counter"
          @input="handleSquadronCounterUpdate($event.target.value)"
          name="squadronCounter"
          min="1"
          max="6"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.card-ship-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.card-ship-stats-item {
  padding: 0.5rem;
  background: #f8f9fa;
  border-radius: 4px;
}

.card-ship-stats-item input {
  width: 60px;
  margin-left: 0.5rem;
}
</style>
