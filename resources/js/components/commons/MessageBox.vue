<script setup>
import {message} from "@/messageStore.js";
</script>

<template>
    <div
        v-if="message"
        class="bg-primary-700 p-5 text-secondary rounded-md border-4 border-b-secondary max-w-80 font-family-secondary text-center"
    >
        {{message}}
    </div>
</template>

<style scoped>

</style>
