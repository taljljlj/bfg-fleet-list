<script setup>
defineProps({
    fleetId: Number,
    onExportPdf: Function
})

// TODO: add icons to buttons instead of text
// TODO: fix export pdf, currently throwing error
</script>

<template>
    <div class="fleet-actions section-subsection flex flex-row justify-evenly my-6">
        <button @click="onExportPdf" class="export-btn btn-primary">Export PDF</button>
        <button id="exportUrl" class="export-btn btn-primary">Share URL</button>
        <button id="exportStore" class="export-btn btn-primary">Save</button>
    </div>
</template>
