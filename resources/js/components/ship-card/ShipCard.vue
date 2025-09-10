<script setup>
import { ref, computed, nextTick, inject, watch } from 'vue';
import ShipStatsSection from './ShipStatsSection.vue';
import ShipArmamentsSection from './ShipArmamentsSection.vue';
import ShipRulesSection from './ShipRulesSection.vue';
import ShipRefitsModal from './ShipRefitsModal.vue';

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['ship-removed', 'ship-updated']);
console.log(props.ship);
const fleetData = inject('fleetData');

const showRefitsModal = ref(false);
const refitButtonRef = ref(null);
const refitsSectionRef = ref(null);
const hasRefits = computed(() => props.ship.refits && props.ship.refits.length > 0);
const squadronCounter = ref(props.ship.pivot.squadron_counter);
const shipLd = ref(props.ship.pivot.leadership);
const shipName = ref(props.ship.pivot.name)

const shipPoints = computed({
    get() {
        return props.ship.type === 'Escort'
            ? props.ship.pivot.points * props.ship.pivot.squadron_counter
            : props.ship.pivot.points
    },
    set(newValue) {
        handleUpdateField('points', newValue)
    }
})

const handleRemoveShip = () => {
  emit('ship-removed', props.ship.pivot.id);
};

const handleShowRefits = async () => {
  if (!showRefitsModal.value) {
    // Opening the modal
    showRefitsModal.value = true;
    await nextTick();

    // Toggle CSS classes for animation
    const button = refitButtonRef.value;

    if (button) {
      button.classList.remove('collapsed');
    }
  } else {
    // Closing the modal and applying refits
    await handleApplyRefits();

    await nextTick();

    const button = refitButtonRef.value;

    if (button) {
      button.classList.add('collapsed');
    }

      showRefitsModal.value = false;
  }
};

const handleApplyRefits = async () => {
  // Get all checked refits from the container
  const checkedRefits = [];
  const checkboxes = refitsSectionRef.value.querySelectorAll('.card-ship-refit-container input[type="checkbox"]:checked');
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
    emit('ship-updated', data);
  } catch (error) {
    console.error('Error applying refits:', error);
    alert('Failed to apply refits. Please try again.');
  }
};

const handleRefitsApplied = (updatedShip) => {
  emit('ship-updated', updatedShip);
  showRefitsModal.value = false;
};

const handleUpdateField = async (attribute, value) => {
    try {
        const response = await fetch(`/api/${fleetData.fleet.id}/ship-fields/${props.ship.pivot.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': fleetData.csrfToken
            },
            body: JSON.stringify({ 'attr': attribute, 'value': value })
        });

        if(response.status === 200) {
            const data = await response.json();

            if('fleetPoints' in data) {
                emit('ship-updated', {
                    ship: {
                        ...props.ship,
                        pivot: {
                            ...props.ship.pivot,
                            points: value
                        }
                    },
                    fleetPoints: data.fleetPoints
                });
            }
        }
    } catch (error) {
        console.error('Error updating squadron counter:', error);
        alert('Failed to update squadron counter. Please try again.');
    }
};

const handleShipImageError = (event) => {
    event.target.src = '/images/ships/ship-no-image.png';
}

const incrementCounter = () => {
    if (squadronCounter.value < 6) squadronCounter.value++;
};

const decrementCounter = () => {
    if (squadronCounter.value > 1) squadronCounter.value--;
};

watch(squadronCounter, async (newValue) => {
    try {
        const response = await fetch(`/api/${fleetData.fleet.id}/ship-squadron-counter/${props.ship.pivot.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': fleetData.csrfToken
            },
            body: JSON.stringify({ 'squadron-counter': newValue })
        });

        const data = await response.json();

        // Emit updated ship data to parent
        emit('ship-updated', {
            ship: {
                ...props.ship,
                pivot: {
                    ...props.ship.pivot,
                    squadron_counter: data.squadronCounter
                }
            },
            fleetPoints: data.fleetPoints
        });

        // Optionally update fleet points here if needed
        // updateFleetPoints(data.pointsData.fleet, false);

    } catch (error) {
        console.error('Error updating squadron counter:', error);
        alert('Failed to update squadron counter. Please try again.');
    }
});

watch(shipLd, async (newValue) => {
    await handleUpdateField('leadership', newValue);
    shipLd.value = newValue;
})

watch(shipName, async (newValue) => {
    await handleUpdateField('name', newValue);
    shipName.value = newValue;
})

const validateLdInput = (event) => {
    const raw = event.target.value;
    const cleaned = raw.replace(/[^0-9-]/g, '');
    shipLd.value = cleaned;
}
</script>

<template>
  <div class="card-ship"
       :data-id="ship.id"
       :data-pivot-id="ship.pivot.id"
       :style="`order: ${ship.order}`"
  >
    <div class="card-ship-header">
      <div class="card-subsec-l">
        <div v-if="ship.type === 'Escort'" class="card-ship-class heading">
            {{ ship.class }} Squadron
            <div class="card-ship-amount">
                <p>&times;</p>
                <div class="squadron-counter-input">
                    <button @click="decrementCounter"><</button>
                    <input
                        type="number"
                        min="1"
                        max="6"
                        title="Number of ships (2-6)"
                        v-model.number="squadronCounter"
                    >
                    <button @click="incrementCounter">></button>
                </div>
            </div>
        </div>
        <div v-else class="card-ship-class heading">{{ ship.class }}</div>
      </div>
      <div class="card-subsec-r">
        <div class="card-ship-ld card-input heading">
            <label for="cardShipLd">Ld: </label>
            <input v-if="ship.type === 'Escort'"
                title="Leadership: for squadrons enter Ld values for each individual ship in this field separated by - (dash)"
                maxlength="11"
                type="text"
                class="ship-escort-ld"
                v-model="shipLd"
                @input="validateLdInput"
                name="cardShipLd"
            />
            <input v-else
                title="Leadership"
                maxlength="2"
                type="text"
                v-model="shipLd"
                @input="validateLdInput"
                name="cardShipLd"
            />
        </div>
        <div class="card-ship-pts card-input heading">
            <label for="cardShipPts">Pts: </label>
            <input
            title="Ship/Squadron Points: Set custom points value. For squadrons reduce counter to x1 before inputting points"
            type="number"
            v-model="shipPoints"
            name="cardShipPts"
            />
        </div>
        <div class="card-ship-remove-btn" @click="handleRemoveShip">×</div>
      </div>
    </div>

    <div class="card-ship-body thin-font">
        <div class="card-section-t">
            <div ref="refitsSectionRef" class="card-subsec-l">
                <div v-if="hasRefits">
                    <div ref="refitButtonRef" class="card-ship-refit-btn collapsed" @click="handleShowRefits">
                        <img class="refit-icon" src="/images/fleet-builder/refit-icon.png" alt="Refit Icon">
                        <img class="apply-icon" src="/images/fleet-builder/apply-icon.png" alt="Refit Icon">
                    </div>
                </div>
                <ShipRefitsModal
                    v-if="showRefitsModal && hasRefits"
                    :ship="ship"
                    @close="showRefitsModal = false"
                    @refits-applied="handleRefitsApplied"
                />
                <div class="card-ship-img">
                    <img
                        :src="`/images/ships/${ship.img_url}`"
                        alt="Ship Profile Image"
                        @error="handleShipImageError"
                    >
                </div>
            </div>
            <div class="card-subsec-r">
                <input
                    type="text"
                    name="cardShipName"
                    :placeholder="`Enter ${ship.type == 'Escort' ? 'Squadron' : 'Ship' } Name`"
                    v-model="shipName"
                >
                <div class="card-ship-additional card-box-container">
                    <div class="card-ship-special ship-rules-section-container">
                        <ShipRulesSection :rules="ship.rules" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-section-b">
            <div class="card-subsec-l ship-stats-section-container">
                <ShipStatsSection :ship="ship" @update-attribute="handleUpdateAttribute" />
            </div>
            <div class="card-subsec-r ship-armaments-section-container">
                <ShipArmamentsSection :armaments="ship.armaments" />
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped>
.card-ship {
    border: 3px solid #c8c5dc;
    border-radius: 5px;
    width: 600px;
    backdrop-filter: blur(7px);
    background: rgb(235 232 255 / 70%);
    height: fit-content;
    margin-bottom: 20px;
}

.card-box-container {
    border: 2px solid rgba(54, 87, 115, 0.8);
    border-radius: 5px;
    background-color: transparent;
    color: rgba(54, 87, 115, 0.8);
}

.card-ship-header {
    background-color: rgba(54, 87, 115, 0.8);
    color: #c8c5dc;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}

.card-subsec-l {
    display: flex;
    flex-grow: 1;
    align-items: center;
    padding: 0 10px;
    position: relative;
}

.card-subsec-r {
    display: flex;
    align-self: flex-end;
    align-items: center;
    padding: 0 10px;
}

.card-input {
    padding: 0 10px;
}

.heading {
    font-size: 22px;
    font-weight: 400;
    z-index: 1;
}

input {
    border-radius: 5px;
    border-color: #c8c5dc;
    border-style: solid;
    background-color: transparent;
    outline: none;
    width: 50px;
    margin: 0;
    padding: 0;
    vertical-align: middle;
    height: 30px;
    text-align: center;
    font-size: 25px;
    font-weight: 600;
    color: #c8c5dc;
}

input:focus-visible {
    box-shadow: inset #c8c5dc 0 0 5px;
}

.card-ship-remove-btn {
    font-size: 45px;
    cursor: pointer;
}

.card-ship-remove-btn:hover {
    color: white;
    text-shadow: 0 0 10px #c8c5dc;
}

.card-ship-ld input,
.card-ship-amount input {
    width: 25px;
}

.card-ship-ld .ship-escort-ld {
    width: 100px;
}

.card-ship-amount {
    position: absolute;
    align-items: center;
    background: linear-gradient(to bottom, transparent 0%, #506d88 30%);
    z-index: -1;
    border-radius: 5px;
    top: 24px;
    left: 90px;
    padding: 3px;
}

.card-ship-amount p {
    font-size: 32px;
    padding: 0;
    margin: 0;
    line-height: 13px;
}

.card-ship-amount input {
    height: 18px;
    width: 20px;
    font-size: 18px;
}

.card-ship-amount button {
    background: transparent;
    border: none;
    color: #c8c5dc;
    cursor: pointer;
    width: 12px;
    height: 18px;
    padding: 0;
    font-size: 18px;
    font-family: League Gothic, sans-serif;
    font-weight: 800;
}

.card-ship-body {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
}

.card-section-t,
.card-section-b {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width: 100%;
}

.card-ship-body .card-subsec-l,
.card-ship-body .card-subsec-r {
    display: flex;
    flex-direction: column;
}

.card-ship-body .card-section-t .card-subsec-l,
.card-ship-body .card-section-t .card-subsec-r {
    width: 50%;
}

.card-ship-img img {
    filter: drop-shadow(0 0 15px rgb(54, 87, 115));
}

.card-ship-refit-btn {
    position: absolute;
    top: 10px;
    left: 10px;
    height: 30px;
    width: 30px;
    padding: 3px;
    border: 2px solid rgba(54, 87, 115, 0.8);
    border-radius: 5px;
    cursor: pointer;
    z-index: 100;
    background: #b6c1da;
}

.card-ship-refit-btn:hover {
    border-color: rgb(54, 87, 115);
    box-shadow: 0 0 20px rgb(54, 87, 115);
}

.card-ship-refit-btn:hover img {
    filter: contrast(1.5) brightness(0.9);
}

.card-ship-refit-btn.collapsed .apply-icon,
.card-ship-refit-btn .refit-icon {
    display: none;
}

.card-ship-refit-btn.collapsed .refit-icon {
    display: block;
}

.card-section-t input {
    box-sizing: border-box;
    width: 100%;
    border-color: rgba(54, 87, 115, 0.8);
    background-color: transparent;
    color: rgba(54, 87, 115, 0.8);
    font-size: 18px;
    font-weight: 400;
    padding: 0 10px;
    text-overflow: ellipsis;
}

.card-section-t input:focus-visible {
    box-shadow: 0 0 5px inset rgba(54, 87, 115, 0.8);
}

.card-section-t input::placeholder {
    color: rgba(54, 87, 115, 0.8);
}

.card-ship-additional {
    box-sizing: border-box;
    width: 100%;
    height: 120px;
    overflow-y: auto;
    overflow-x: hidden;
}

.card-section-b {
    margin-top: 5px;
}

.card-ship-body .card-section-b .card-subsec-l {
    width: 37%;
}

.card-ship-body .card-section-b .card-subsec-r {
    width: 63%;
    align-self: center;
    padding-right: 34px;
}
</style>
