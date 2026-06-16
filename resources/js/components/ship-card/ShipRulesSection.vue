<script setup>
const props = defineProps({
  rules: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <ul class="rules-list pl-5 m-0 text-left" v-if="rules && rules.length > 0">
    <li v-for="rule in rules" :key="rule.id">
      {{ rule.text }}
      <span class="tooltip">{{ rule.text_long }}</span>
    </li>
  </ul>
</template>

<style scoped>
/* TODO: move tooltip to global message box */
.tooltip {
    visibility: hidden;
    width: 250px;
    background-color: rgb(76 96 114);
    color: #c8c5dc;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    left: 0;
    top: 25px;
    position: absolute;
    z-index: 1;
}

li:hover .tooltip {
    visibility: visible;
}
</style>
