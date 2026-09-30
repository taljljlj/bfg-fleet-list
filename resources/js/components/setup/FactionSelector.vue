<script setup>

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
  <div class="faction-selector flex gap-1 flex-wrap justify-evenly user-select-none lg:gap-4">
    <div
      v-for="faction in factions"
      :key="faction.id"
      class="faction relative cursor-pointer opacity-70 my-1 transition-opacity duration-300 ease-in-out hover:opacity-100 hover:drop-shadow-[0_0_10px_#c8c5dc] hover:hue-rotate-45 md:my-1.5 lg:my-2.5"
      :class="[
        { selected: selectedFactionId === faction.id },
        selectedFactionId === faction.id
          ? 'opacity-100 after:content-[\'\'] after:block after:w-0 after:h-0 after:absolute after:left-[calc(50%-10px)] after:-bottom-6 after:border-t-20 after:border-t-white after:border-l-10 after:border-l-transparent after:border-r-10 after:border-r-transparent'
          : ''
      ]"
      @click="handleFactionClick(faction.id)"
    >
      <img :src="`/images/factions/${faction.img_url}`" :alt="`${faction.name} Logo`" class="h-5 md:h-8 lg:h-12">
      <h3 class="m-0 tracking-wider text-white text-xs md:text-base lg:text-lg">{{ faction.name }}</h3>
    </div>
  </div>
</template>
