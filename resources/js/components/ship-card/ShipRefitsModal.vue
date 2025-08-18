<script setup>
import { ref, nextTick, inject } from 'vue';

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close', 'refits-applied']);

// Helper function to format module data (same as discussed earlier)
const formatModificationData = (data) => {
  const fireArc = data.fire_arc ? ` (${data.fire_arc})` : '';
  const placement = data.placement ? `${data.placement} ` : '';
  return `${placement}${data.type}${fireArc}`;
};

// Helper function to check if refit is applied
const isRefitApplied = (refit) => {
  return props.ship.applied_refits &&
         props.ship.applied_refits.some(appliedRefit =>
           appliedRefit.ship_refit_id === refit.pivot.id
         );
};

// Helper function to check if parent refit is applied (for child enabling/disabling)
const isParentRefitApplied = (parentRefit) => {
  return props.ship.appliedRefits &&
         props.ship.appliedRefits.some(appliedRefit =>
           appliedRefit.ship_refit_id === parentRefit.pivot.id
         );
};
</script>

<template>
  <div
      class="card-ship-refit-container"
  >
    <ul>
      <li v-for="refit in ship.refits" :key="refit.id" class="ship-refit">
        <label>
          <input
            type="checkbox"
            :name="refit.name"
            :data-refit-pivot-id="refit.pivot.id"
            :checked="isRefitApplied(refit)"
          />
          {{ refit.text }}
          <span class="tooltip">
            {{ refit.text_long }}
            <template v-for="mod in refit.modifications" :key="mod.id">
              <template v-if="mod.type === 'arm'">
                <template v-if="mod.action === 'modify'">
                  <br>[{{ formatModificationData(JSON.parse(mod.module)) }}: firepower({{ mod.pivot.firepower || 'N/A' }}) range({{ mod.pivot.range_speed || mod.pivot.misc || 'N/A' }})]
                </template>
                <template v-else-if="mod.action === 'replace' || mod.action === 'add'">
                  <br>[{{ formatModificationData(JSON.parse(mod.value)) }}: firepower({{ mod.pivot.firepower || 'N/A' }}) range({{ mod.pivot.range_speed || mod.pivot.misc || 'N/A' }})]
                </template>
              </template>
            </template>
          </span>
          <span> ({{ refit.pivot.points }}pts)</span>
        </label>
        <ul v-if="refit.children && refit.children.length > 0" class="ship-refits-children">
          <li v-for="child in refit.children" :key="child.id" class="ship-refit">
            <label>
              <input
                type="checkbox"
                :name="child.name"
                :data-refit-pivot-id="child.pivot.id"
                :checked="isRefitApplied(child)"
                :disabled="!isParentRefitApplied(refit)"
              />
              {{ child.text }}
              <span class="tooltip">{{ child.text_long }}</span>
              <span> ({{ child.pivot.points }}pts)</span>
            </label>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.card-ship-refit-container {
    position: absolute;
    top: 30px;
    left: 15px;
    width: 565px;
    height: 235px;
    z-index: 10;
    border: 2px solid rgba(54, 87, 115, 0.8);
    border-radius: 5px;
    background: #c8d5f7;
    overflow: auto;
    color: rgba(54, 87, 115, 0.8);
    transition: all 0.5s ease-out;
}

.card-ship-refit-container.collapsed {
    width: 1px;
    height: 1px;
}

ul {
    list-style: none;
    padding: 20px 20px 20px 35px;
    margin: 0;
    text-align: left;
}

li {
    position: relative;
}

label {
    cursor: pointer;
}

input {
    display: inline-block;
    width: 20px;
    margin-right: 10px;
    padding: 5px;
    border: 2px solid rgba(54, 87, 115, 0.8);
    border-radius: 5px;
    background-color: transparent;
    color: rgba(54, 87, 115, 0.8);
}

.tooltip {
    visibility: hidden;
    background-color: rgb(76 96 114);
    color: #c8c5dc;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    left: 0;
    top: 25px;
    position: absolute;
    z-index: 1;
    width: 450px;
}

label:hover .tooltip {
    visibility: visible;
}

.ship-refits-children {
    padding: 0 0 0 35px;
}
</style>
