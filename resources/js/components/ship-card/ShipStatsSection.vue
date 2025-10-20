<script setup>
const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});
</script>

<template>
    <div class="card-ship-stats">
        <div class="stat-box card-box-container">
            <div class="stat-name">HP</div>
            <div class="stat-value">{{ ship.hitpoints }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Speed</div>
            <div class="stat-value">{{ ship.pivot.speed ?? ship.speed }}{{ ship.speed.length > 2 ? '' : 'cm' }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Turns</div>
            <div class="stat-value">{{ ship.pivot.turns ?? ship.turns }}{{ ship.turns.length > 2 ? '' : '°' }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Shields</div>
            <div class="stat-value">{{ ship.pivot.shields ?? ship.shields }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">Armour</div>
            <div class="stat-value">{{ ship.pivot.armour_short ??  ship.armour_short }}</div>
        </div>
        <div class="stat-box card-box-container">
            <div class="stat-name">{{ ship.faction_id === 11 ? 'Spores' : 'Turrets' }}</div>
            <div class="stat-value">{{ ship.pivot.turrets ?? ship.turrets }}</div>
        </div>
    </div>
</template>

<style scoped>
.card-ship-stats {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
    align-items: center;
}

.stat-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 2px;
    width: 56px;
    margin: 2px 0;
    height: 54px;
}

.stat-value {
    font-weight: 600;
}

.card-box-container {
    border: 2px solid rgba(54, 87, 115, 0.8);
    border-radius: 5px;
    background-color: transparent;
    color: rgba(54, 87, 115, 0.8);
}
</style>
