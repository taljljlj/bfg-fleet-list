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
    justify-content: space-evenly;
    user-select: none;
}

.faction {
    transition: all 0.2s ease;
    margin: 10px 5px;
    opacity: 70%;
    cursor: pointer;
    position: relative;
}

.faction:hover {
    opacity: 1;
    filter: drop-shadow(0 0 10px #c8c5dc) hue-rotate(45deg);
}

.faction.selected {
    opacity: 1;
}

.faction.selected:after {
    content: '';
    display: block;
    width: 0;
    height: 0;
    position: absolute;
    left: calc(50% - 10px);
    border-top: 20px solid white;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    bottom: -25px;
}

.faction img {
    height: 60px;
}

.faction h3 {
    margin: 0;
    letter-spacing: 1px;
    color: white;
}
</style>
