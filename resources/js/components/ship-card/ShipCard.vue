<script setup>
import {computed, inject, nextTick, ref, watch} from 'vue';
import ShipStatsSection from './ShipStatsSection.vue';
import ShipArmamentsSection from './ShipArmamentsSection.vue';
import ShipRulesSection from './ShipRulesSection.vue';
import ShipRefitsModal from './ShipRefitsModal.vue';
import {useTooltip} from "@/composables/useTooltip.js";

const {showTooltip, clearTooltip} = useTooltip();

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['ship-removed', 'ship-updated']);
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
    shipLd.value = raw.replace(/[^0-9-]/g, '');
}
</script>

<template>
  <div class="card-ship border-3 border-secondary rounded-md w-[600px] backdrop-blur-sm bg-secondary mb-5"
       :data-id="ship.id"
       :data-pivot-id="ship.pivot.id"
       :style="`order: ${ship.order}`"
  >
    <div class="card-ship-header relative bg-primary-500-opc-80 text-secondary flex flex-row justify-between items-center text-3xl z-10">
      <div class="card-subsec-l">
        <div v-if="ship.type === 'Escort'" class="card-ship-class heading">
            {{ ship.class }} Squadron
            <div class="card-ship-amount absolute items-center z-20 rounded-md top-6 left-20 p-1 pb-0 bg-[linear-gradient(to_bottom,transparent_0%,#506d88_30%)]">
                <p class="text-3xl p-0 m-0 leading-3">&times;</p>
                <div
                    class="squadron-counter-input align-middle"
                    @mouseenter="showTooltip('Max number of ships per squadron (6)')"
                    @mouseleave="clearTooltip"
                >
                    <button class="counter-btn" @click="decrementCounter"><</button>
                    <input
                        type="number"
                        class="w-5 h-5 text-lg light-input"
                        min="1"
                        max="6"
                        title="Number of ships (2-6)"
                        v-model.number="squadronCounter"
                    >
                    <button class="counter-btn" @click="incrementCounter">></button>
                </div>
            </div>
        </div>
        <div v-else class="card-ship-class heading">{{ ship.class }}</div>
      </div>
      <div class="card-subsec-r px-2.5">
        <div class="card-ship-ld card-input heading px-2.5">
            <label for="cardShipLd">Ld: </label>
            <input v-if="ship.type === 'Escort'"
                @mouseenter="showTooltip('Leadership: for squadrons enter Ld values for each individual ship in this field separated by - (dash)')"
                @mouseleave="clearTooltip"
                maxlength="11"
                type="text"
                class="ship-escort-ld w-24 text-2xl light-input"
                v-model="shipLd"
                @input="validateLdInput"
                name="cardShipLd"
            />
            <input v-else
                @mouseenter="showTooltip('Leadership')"
                @mouseleave="clearTooltip"
                maxlength="2"
                type="text"
                class="w-8 text-2xl light-input"
                v-model="shipLd"
                @input="validateLdInput"
                name="cardShipLd"
            />
        </div>
        <div class="card-ship-pts card-input heading px-2.5">
            <label for="cardShipPts">Pts: </label>
            <input
                @mouseenter="showTooltip('Ship/Squadron Points: Set custom points value. For squadrons set squadron ship counter prior to custom points value.')"
                @mouseleave="clearTooltip"
                type="number"
                class="w-14 text-2xl light-input"
                v-model="shipPoints"
                name="cardShipPts"
            />
        </div>
        <div class="card-ship-remove-btn text-5xl cursor-pointer hover:text-white" @click="handleRemoveShip">×</div>
      </div>
    </div>

    <div class="card-ship-body font-secondary tracking-tight flex flex-wrap flex-row pt-0.5">
        <div class="card-section-t flex justify-evenly items-center w-full">
            <div ref="refitsSectionRef" class="card-subsec-l flex flex-col w-1/2">
                <div v-if="hasRefits">
                    <div ref="refitButtonRef"
                         class="card-ship-refit-btn collapsed absolute top-2.5 left-2.5 h-7 w-7 p-0.5 cursor-pointer z-50 bg-secondary rounded-md border-2 border-primary-500-opc-80 hover:border-primary-500 hover:shadow-[0_0_20px_#365773] group"
                         @click="handleShowRefits"
                         @mouseenter="showTooltip('Refit ship')"
                         @mouseleave="clearTooltip"
                    >
                            <img class="refit-icon group-hover:contrast-150 group-hover:brightness-90 hidden group-[.collapsed]:block" src="/images/fleet-builder/refit-icon.png" alt="Refit Icon">
                            <img class="apply-icon group-hover:contrast-150 group-hover:brightness-90 group-[.collapsed]:hidden" src="/images/fleet-builder/apply-icon.png" alt="Refit Icon">
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
            <div class="card-subsec-r flex flex-col w-1/2 px-2.5">
                <input
                    type="text"
                    class="w-full text-lg font-thin px-2.5 text-ellipsis border-primary-500-opc-80 text-primary-500-opc-80 focus-visible:shadow-[inset_0_0_5px_#365773CC] placeholder:text-primary-500-opc-80"
                    name="cardShipName"
                    :placeholder="`Enter ${ship.type === 'Escort' ? 'Squadron' : 'Ship' } Name`"
                    v-model="shipName"
                >
                <div class="card-ship-additional card-box-container w-full h-32 overflow-y-auto overflow-x-hidden">
                    <div class="card-ship-special ship-rules-section-container">
                        <ShipRulesSection :rules="ship.rules" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-section-b flex justify-evenly items-center w-full mt-1">
            <div class="card-subsec-l ship-stats-section-container flex flex-col w-1/3">
                <ShipStatsSection :ship="ship" />
            </div>
            <div class="card-subsec-r ship-armaments-section-container flex flex-col w-2/3 self-center pr-9">
                <ShipArmamentsSection :armaments="ship.armaments" />
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped>
.card-ship-remove-btn:hover {
    text-shadow: 0 0 10px #c8c5dc;
}

.card-ship-img img {
    filter: drop-shadow(0 0 15px rgb(54, 87, 115));
}

</style>
