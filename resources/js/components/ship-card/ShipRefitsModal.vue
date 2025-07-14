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
const selectedRefits = ref([]);
const parentRefitStates = reactive({});

const handleParentRefitChange = (parentRefit, isChecked) => {
  parentRefitStates[parentRefit.id] = isChecked;

  if (!isChecked) {
    // Remove all children from selected refits
    if (parentRefit.children) {
      parentRefit.children.forEach(child => {
        const index = selectedRefits.value.indexOf(child.pivot.id);
        if (index > -1) {
          selectedRefits.value.splice(index, 1);
        }
      });
    }
  }
};

const handleChildRefitChange = (childRefit, isChecked) => {
  if (isChecked) {
    selectedRefits.value.push(childRefit.pivot.id);
  } else {
    const index = selectedRefits.value.indexOf(childRefit.pivot.id);
    if (index > -1) {
      selectedRefits.value.splice(index, 1);
    }
  }
};

const handleApplyRefits = async () => {
  try {
    const response = await fetch(`/api/${fleetData.fleet.id}/ship-refit/${props.ship.pivot.id}`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': fleetData.csrfToken
      },
      body: JSON.stringify({ 'selected-refits': selectedRefits.value })
    });

    const data = await response.json();
    emit('refits-applied', data);
  } catch (error) {
    console.error('Error applying refits:', error);
    alert('Failed to apply refits. Please try again.');
  }
};

const handleClose = () => {
  emit('close');
};
</script>

<template>
  <div class="refit-modal-overlay" @click="handleClose">
    <div class="refit-modal" @click.stop>
      <div class="refit-modal-header">
        <h3>Ship Refits - {{ ship.class }}</h3>
        <button class="close-btn" @click="handleClose">×</button>
      </div>

      <div class="refit-modal-body">
        <ul class="ship-refits-list">
          <li
            v-for="refit in ship.refits"
            :key="refit.id"
            class="ship-refit"
          >
            <label>
              <input
                type="checkbox"
                :value="refit.pivot.id"
                @change="handleParentRefitChange(refit, $event.target.checked)"
              >
              {{ refit.name }} ({{ refit.pivot.points }} pts)
            </label>

            <!-- Child refits -->
            <ul v-if="refit.children && refit.children.length > 0" class="ship-refits-children">
              <li
                v-for="childRefit in refit.children"
                :key="childRefit.id"
                class="ship-refit-child"
              >
                <label>
                  <input
                    type="checkbox"
                    :value="childRefit.pivot.id"
                    :disabled="!parentRefitStates[refit.id]"
                    @change="handleChildRefitChange(childRefit, $event.target.checked)"
                  >
                  {{ childRefit.name }} ({{ childRefit.pivot.points }} pts)
                </label>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="refit-modal-footer">
        <button @click="handleApplyRefits" class="apply-btn">Apply Refits</button>
        <button @click="handleClose" class="cancel-btn">Cancel</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.refit-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2000;
}

.refit-modal {
  background: white;
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  max-height: 80vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.refit-modal-header {
  padding: 1rem;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.refit-modal-header h3 {
  margin: 0;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  padding: 0;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.refit-modal-body {
  padding: 1rem;
  overflow-y: auto;
  flex-grow: 1;
}

.ship-refits-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.ship-refit {
  margin-bottom: 1rem;
  padding: 0.5rem;
  border: 1px solid #eee;
  border-radius: 4px;
}

.ship-refit label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
}

.ship-refits-children {
  list-style: none;
  padding: 0;
  margin: 0.5rem 0 0 1.5rem;
}

.ship-refit-child {
  margin-bottom: 0.5rem;
}

.ship-refit-child label {
  font-size: 0.9rem;
  color: #666;
}

.refit-modal-footer {
  padding: 1rem;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
}

.apply-btn {
  background: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.cancel-btn {
  background: #6c757d;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.apply-btn:hover {
  background: #0056b3;
}

.cancel-btn:hover {
  background: #545b62;
}
</style>
