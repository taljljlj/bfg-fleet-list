<script setup>
import  pdfExportIcon from '@images/fleet-builder/pdf-export-icon.png';
import printPreviewIcon from '@images/fleet-builder/print-preview-icon.png';
import shareIcon from '@images/fleet-builder/share-icon.png';
import viewIcon from '@images/fleet-builder/view-icon.png';
import deleteIcon from '@images/fleet-builder/delete-icon.png';

defineProps({
    routes: {
        type: Object,
        required: true
    },
    onExportPdf: Function,
    onDeleteFleet: Function,
})
</script>

<template>
    <div class="fleet-actions section-divider divider-r flex flex-row justify-between pt-2.5 flex-wrap gap-1.5 font-family-secondary tracking-tighter">
        <div @click="onExportPdf" class="flex-1/6">
            <div class="btn-primary">
                <img :src="pdfExportIcon" alt="PDF Export" class="hover:opacity-80 p-1">
            </div>
            <div>Export PDF</div>
        </div>

        <a :href="routes['viewPrintable']"
           class="flex-1/6"
        >
            <div class="btn-primary">
                <img :src="printPreviewIcon" alt="Print Preview" class="hover:opacity-80 p-1">
            </div>
            <div>
                Print Preview
            </div>
        </a>

        <div id="share_fleet_btn" class="flex-1/6">
            <div class="btn-primary">
                <img :src="shareIcon" alt="Share" class="hover:opacity-80 p-1">
            </div>
            <div>
                Share
            </div>
        </div>

        <a :href="routes.view"
           class="flex-1/6"
        >
            <div class="btn-primary">
                <img :src="viewIcon" alt="View" class="hover:opacity-80 p-1">
            </div>
            <div>
                View
            </div>
        </a>
        <div @click="onDeleteFleet" class="flex-1/6">
            <div class="btn-primary">
                <img :src="deleteIcon" alt="Delete" class="hover:opacity-80 p-1">
            </div>
            <div>
                Delete
            </div>
        </div>

    </div>
</template>
