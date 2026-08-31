<script setup>
defineProps({
    routes: {
        type: Object,
        required: true
    },
    onExportPdf: Function
})
</script>

<template>
    <div class="fleet-actions section-divider divider-r flex flex-row justify-evenly pt-2.5 flex-wrap gap-1.5">
        <div @click="onExportPdf" class="btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/pdf-export-icon.png" alt="PDF Export">
            </div>
        </div>
        <a :href="routes.view"
           class="btn-primary"
        >
            View Fleet
        </a>

        <div id="exportUrl" class="btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/share-icon.png" alt="Share">
            </div>
        </div>
        <div id="exportStore" class="btn-primary">
            <div class="hover:opacity-80 p-2">
                <img src="/images/fleet-builder/save-icon.png" alt="Save">
            </div>
        </div>
    </div>
</template>
