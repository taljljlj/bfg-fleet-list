<script setup>
const props = defineProps({
  rules: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <div class="ship-rules-section-container">
    <div class="card-ship-rules card-box-container" v-if="rules && rules.length > 0">
      <h4>Special Rules</h4>
      <ul class="rules-list">
        <li v-for="rule in rules" :key="rule.id">
          <strong>{{ rule.name }}:</strong>
          <span v-html="rule.description"></span>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
.card-ship-rules {
  margin-bottom: 1rem;
}

.card-ship-rules h4 {
  margin: 0 0 0.5rem 0;
  font-size: 1.1rem;
}

.rules-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.rules-list li {
  padding: 0.5rem 0;
  border-bottom: 1px solid #eee;
  line-height: 1.4;
}

.rules-list li:last-child {
  border-bottom: none;
}

.rules-list strong {
  color: #333;
}
</style>
