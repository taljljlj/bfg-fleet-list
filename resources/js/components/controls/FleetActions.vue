<script setup>
defineProps({
    fleetId: Number,
    onExportPdf: Function
})

// TODO: add icons to buttons instead of text
// TODO: fix export pdf, currently throwing error
</script>

<template>
    <div class="fleet-actions section-subsection flex flex-row justify-evenly pt-2.5">
        <button @click="onExportPdf" class="export-btn btn-primary">
            <span class="hover:opacity-80">
                <img src="/images/fleet-builder/pdf-export-icon.png" alt="PDF Export">
            </span>
        </button>
        <button id="exportUrl" class="export-btn btn-primary">
            <span class="hover:opacity-80">
                <img src="/images/fleet-builder/share-icon.png" alt="Share">
            </span>
        </button>
        <button id="exportStore" class="export-btn btn-primary">
            <span class="hover:opacity-80">
                <img src="/images/fleet-builder/save-icon.png" alt="Save">
            </span>
        </button>
    </div>
</template>
