<script setup>
import { ref } from 'vue';
import caretIcon from '@images/caret-icon.png';
import addShipIcon from '@images/add-ship-icon.png';

const props = defineProps({
    shipList: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['ship-selected']);

const handleShipAdd = (shipId) => {
    emit('ship-selected', shipId);
};

const toggleGroup = (event) => {
    event.currentTarget.parentElement.classList.toggle('collapsed');
}


</script>

<template>
    <div class="ship-list">
        <ul v-if="shipList">
            <li
                v-for="(shipGroup, shipType) in shipList"
                :key="shipType"
                class="ship-type-group collapsed"
            >
                <h4
                    class="ship-type-group-title"
                    @click="toggleGroup"
                >
                    {{ shipType }}s
                    <span class="caret-icon">
                        <img :src="caretIcon" alt="caret-icon">
                    </span>
                </h4>
                <ul class="ship-type-container thin-font">
                    <li v-for="ship in shipGroup" :key="ship.id">
                        <span class="ship-class">
                          {{ ship.class }}{{ ship.type === 'Escort' ? ' Squadron' : '' }}
                        </span>
                        <span class="ship-pts thin-font">{{ ship.points }}</span>
                        <span
                            class="ship-add-btn"
                            @click="handleShipAdd(ship.id)"
                        >
                            <img :src="addShipIcon" alt="Add Ship Icon">
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.ship-list ul {
    list-style: none;
    padding: 0;
}

.ship-list li {
    color: white;
    padding: 5px 0;
}

.ship-class {
    flex-grow: 1;
    text-align: left;
}

.ship-add-btn,
.ship-pts {
    text-align: right;
}

.ship-pts {
    margin: 0 10px;
}

.ship-add-btn {
    height: 19px;
    cursor: pointer;
    opacity: 0.7;
    user-select: none;
}

.ship-add-btn:hover {
    opacity: 1;
    filter: drop-shadow(0 0 10px #c8c5dc) hue-rotate(45deg);
}

.ship-type-group-title {
    position: relative;
    text-align: right;
    padding-bottom: 5px;
    color: #c8c5dc;
    cursor: pointer;
    margin: 0;
    user-select: none;
    font-size: 18px;
}

.caret-icon {
    vertical-align: sub;
    padding-left: 10px;
}

.caret-icon img {
    height: 22px;
    opacity: 0.7;
    rotate: 180deg;
}

.ship-type-group-title::after,
.ship-type-container:after {
    position: absolute;
    display: block;
    content: "";
    bottom: 0;
    right: -25px;
    height: 2px;
    width: 250px;
    background: linear-gradient(to right, transparent 0%, #c8c5dc 100%);
}

.ship-type-container {
    position: relative;
}

.ship-type-group.collapsed .ship-type-container {
    height: 0;
    overflow-y: hidden;
}

.ship-type-group.collapsed .caret-icon img {
    rotate: 0deg;
}

.ship-type-container li {
    display: flex;
    justify-content: space-between;
}
</style>
