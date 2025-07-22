<script setup>
import { ref, reactive, inject } from 'vue';

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close', 'refits-applied']);

const fleetData = inject('fleetData');

// Helper function to format module data (same as discussed earlier)
const formatModuleData = (data) => {
  const fireArc = data.fire_arc ? ` (${data.fire_arc})` : '';
  return `${data.placement} ${data.type}${fireArc}`;
};

// Helper function to check if refit is applied
const isRefitApplied = (refit) => {
  return props.ship.appliedRefits &&
         props.ship.appliedRefits.some(appliedRefit =>
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

const handleApplyRefits = async () => {
  // Get all checked refits
  const checkedRefits = [];
  const checkboxes = document.querySelectorAll('.card-ship-refit-container input[type="checkbox"]:checked');
  checkboxes.forEach(checkbox => {
    checkedRefits.push(parseInt(checkbox.dataset.refitPivotId));
  });

  try {
    const response = await fetch(`/api/${fleetData.fleet.id}/ship-refit/${props.ship.pivot.id}`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': fleetData.csrfToken
      },
      body: JSON.stringify({ 'selected-refits': checkedRefits })
    });

    const data = await response.json();
    emit('refits-applied', data);
  } catch (error) {
    console.error('Error applying refits:', error);
    alert('Failed to apply refits. Please try again.');
  }
};

// Handle the refit button click (toggle and apply)
const handleRefitButtonClick = () => {
  const container = document.querySelector('.card-ship-refit-container');
  const button = document.querySelector('.card-ship-refit-btn');

  if (container.classList.contains('collapsed')) {
    // Expand
    container.classList.remove('collapsed');
    button.classList.remove('collapsed');
  } else {
    // Collapse and apply refits
    handleApplyRefits();
    container.classList.add('collapsed');
    button.classList.add('collapsed');
  }
};
</script>

<template>
  <div class="card-ship-refit-container collapsed">
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
                  <br>[{{ formatModuleData(JSON.parse(mod.module)) }}: firepower({{ mod.pivot.firepower || 'N/A' }}) range({{ mod.pivot.range_speed || mod.pivot.misc || 'N/A' }})]
                </template>
                <template v-else-if="mod.action === 'replace' || mod.action === 'add'">
                  <br>[{{ formatModuleData(JSON.parse(mod.value)) }}: firepower({{ mod.pivot.firepower || 'N/A' }}) range({{ mod.pivot.range_speed || mod.pivot.misc || 'N/A' }})]
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
/* No additional styles needed - using existing CSS from app.css */
</style>
