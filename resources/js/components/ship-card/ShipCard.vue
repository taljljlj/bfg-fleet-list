<script setup>
import { ref, computed } from 'vue';
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

const showRefitsModal = ref(false);

const shipPoints = computed(() => {
  return props.ship.type === 'Escort'
    ? props.ship.pivot.points * props.ship.pivot.squadron_counter
    : props.ship.pivot.points;
});

const handleRemoveShip = () => {
  emit('ship-removed', props.ship.pivot.id);
};

const handleShowRefits = () => {
  showRefitsModal.value = true;
};

const handleRefitsApplied = (updatedShip) => {
  emit('ship-updated', updatedShip);
  showRefitsModal.value = false;
};

const handleUpdateAttribute = (attribute, value) => {
  emit('ship-updated', {
    ...props.ship,
    pivot: {
      ...props.ship.pivot,
      [attribute]: value
    }
  });
};
</script>

<template>
  <div class="card-ship" :data-id="ship.id" :data-pivot-id="ship.pivot.id">
    <div class="card-ship-header">
      <div class="card-subsec-l">
        <div v-if="ship.type === 'Escort'" class="card-ship-class heading">
            {{ ship.class }} Squadron
            <div class="card-ship-amount">
                <p>&times;</p>
                <div class="squadron-counter-input">
                    <button onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change', { bubbles: true}));"><</button>
                    <input type="number" name="squadronCounter" min="1" max="6" title="Number of ships (2-6)" value="{{ $ship.pivot.squadron_counter }}">
                    <button onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change', { bubbles: true}));">></button>
                </div>
            </div>
        </div>
        <div v-else class="card-ship-class heading">{{ ship.class }}</div>
<!-- TODO: move this to appropriate section          -->
<!--        <input-->
<!--          type="text"-->
<!--          :value="ship.pivot.name || ship.class"-->
<!--          @input="handleUpdateAttribute('name', $event.target.value)"-->
<!--          name="cardShipName"-->
<!--        />-->
      </div>
      <div class="card-subsec-r">
        <div class="card-ship-ld card-input heading">
            <label for="cardShipLd">Ld:</label>
            <input v-if="ship.type === 'Escort'"
                title="Leadership: for squadrons enter Ld values for each individual ship in this field separated by - (dash)"
                maxlength="11"
                type="number"
                class="ship-escort-ld"
                :value="ship.pivot.leadership"
                @input="handleUpdateAttribute('leadership', $event.target.value)"
                name="cardShipLd"
            />
            <input v-else
                title="Leadership"
                maxlength="2"
                type="number"
                :value="ship.pivot.leadership"
                @input="handleUpdateAttribute('leadership', $event.target.value)"
                name="cardShipLd"
            />
        </div>
        <div class="card-ship-pts card-input heading">
            <label for="cardShipPts">Pts:</label>
            <input
            type="number"
            :value="shipPoints"
            @input="handleUpdateAttribute('points', $event.target.value)"
            name="cardShipPts"
            />
        </div>
<!--          TODO: move this to appropriate section -->
<!--        <button-->
<!--          class="card-ship-refit-btn"-->
<!--          @click="handleShowRefits"-->
<!--          v-if="ship.refits && ship.refits.length > 0"-->
<!--        >-->
<!--          R-->
<!--        </button>-->
        <div class="card-ship-remove-btn" @click="handleRemoveShip">×</div>
      </div>
    </div>

    <div class="card-ship-body thin-font">
        <div class="card-section-t">
            <div class="card-subsec-l">
                <div v-if="ship.refits && ship.refits.length > 0">
                    <div class="card-ship-refit-btn collapsed" @click="handleShowRefits">
                        <img class="refit-icon" src="/images/fleet-builder/refit-icon.png" alt="Refit Icon">
                        <img class="apply-icon" src="/images/fleet-builder/apply-icon.png" alt="Refit Icon">
                    </div>
                </div>
            </div>
        </div>
      <ShipStatsSection :ship="ship" @update-attribute="handleUpdateAttribute" />
      <ShipArmamentsSection :armaments="ship.armaments" />
      <ShipRulesSection :rules="ship.rules" />
    </div>

    <ShipRefitsModal
      v-if="showRefitsModal"
      :ship="ship"
      @close="showRefitsModal = false"
      @refits-applied="handleRefitsApplied"
    />
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
</style>
