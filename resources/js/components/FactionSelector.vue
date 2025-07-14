<script setup>
import { defineEmits, defineProps } from 'vue';

const props = defineProps({
  factions: {
    type: Array,
    required: true
  },
  selectedFactionId: {
    type: Number,
    default: null
  }
});

const emit = defineEmits(['faction-selected']);

const handleFactionClick = (factionId) => {
  emit('faction-selected', factionId);
};
</script>

<template>
  <div class="faction-selector">
    <div
      v-for="faction in factions"
      :key="faction.id"
      class="faction"
      :class="{ selected: selectedFactionId === faction.id }"
      @click="handleFactionClick(faction.id)"
    >
      <img :src="`/images/factions/${faction.img_url}`" :alt="`${faction.name} Logo`">
      <h3>{{ faction.name }}</h3>
    </div>
  </div>
</template>

<style scoped>
.faction-selector {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.faction {
  cursor: pointer;
  transition: all 0.2s ease;
}

.faction.selected {
  /* Your selected faction styles */
}

.faction:hover {
  /* Your hover styles */
}
</style>
