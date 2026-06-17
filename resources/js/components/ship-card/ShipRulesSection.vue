<script setup>
import {useTooltip} from "@/composables/useTooltip.js";

const {showTooltip, clearTooltip} = useTooltip();

const props = defineProps({
  rules: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <ul class="rules-list pl-5 m-0 text-left" v-if="rules && rules.length > 0">
    <li
        v-for="rule in rules"
        :key="rule.id"
        @mouseenter="showTooltip(rule.text_long)"
        @mouseleave="clearTooltip"
    >
      {{ rule.text }}
    </li>
  </ul>
</template>
