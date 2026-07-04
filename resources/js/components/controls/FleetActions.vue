<script setup>
defineProps({
    fleetId: Number,
    onExportPdf: Function
})
</script>

<template>
    <div class="fleet-actions section-subsection flex flex-row justify-evenly pt-2.5">
        <button @click="onExportPdf" class="export-btn btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/pdf-export-icon.png" alt="PDF Export">
            </div>
        </button>
        <button id="exportUrl" class="export-btn btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/share-icon.png" alt="Share">
            </div>
        </button>
        <button id="exportStore" class="export-btn btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/save-icon.png" alt="Save">
            </div>
        </button>
    </div>
</template>
