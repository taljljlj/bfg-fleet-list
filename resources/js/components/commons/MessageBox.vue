<script setup>
import {message} from "@/messageStore.js";

</script>

<template>
    <transition name="fade-out">
        <div
            v-if="message"
            class="bg-primary-700 p-5 text-secondary rounded-md border-4 border-b-secondary max-w-80 font-family-secondary text-center"
        >
            {{message}}
        </div>
    </transition>
</template>

<style scoped>
.fade-out-leave-active {
    transition: opacity 1.5s ease;
}
.fade-out-leave-to {
    opacity: 0;
}
</style>
