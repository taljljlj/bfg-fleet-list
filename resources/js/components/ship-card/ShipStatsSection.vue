<script setup>
const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});
</script>

<template>
    <div class="card-ship-stats flex flex-row flex-wrap justify-between w-full items-center\">
        <div class="stat-box card-box-container">
            <div class="stat-name">HP</div>
            <div class="stat-value font-semibold">{{ ship.hitpoints }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Speed</div>
            <div class="stat-value font-semibold">{{ ship.pivot.speed ?? ship.speed }}{{ ship.speed.length > 2 ? '' : 'cm' }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Turns</div>
            <div class="stat-value font-semibold">{{ ship.pivot.turns ?? ship.turns }}{{ ship.turns.length > 2 ? '' : '°' }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Shields</div>
            <div class="stat-value font-semibold">{{ ship.pivot.shields ?? ship.shields }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Armour</div>
            <div class="stat-value font-semibold">{{ ship.pivot.armour_short ??  ship.armour_short }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">{{ ship.faction_id === 11 ? 'Spores' : 'Turrets' }}</div>
            <div class="stat-value font-semibold">{{ ship.pivot.turrets ?? ship.turrets }}</div>
        </div>
    </div>
</template>
