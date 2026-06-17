<script setup>
import {useTooltip} from "@/composables/useTooltip.js";

const {showTooltip, clearTooltip} = useTooltip();

const props = defineProps({
  ship: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close', 'refits-applied']);

const formatModificationData = (data) => {
  const fireArc = data.fire_arc ? ` (${data.fire_arc})` : '';
  const placement = data.placement ? `${data.placement} ` : '';
  return `${placement}${data.type}${fireArc}`;
};

const isRefitApplied = (refit) => {
  return props.ship.applied_refits &&
         props.ship.applied_refits.some(appliedRefit =>
           appliedRefit.ship_refit_id === refit.pivot.id
         );
};

// Helper function to check if parent refit is applied (for child enabling/disabling)
const isParentRefitApplied = (parentRefit) => {
  return props.ship.appliedRefits &&
         props.ship.appliedRefits.some(appliedRefit =>
           appliedRefit.ship_refit_id === parentRefit.pivot.id
         );
};

function buildRefitTooltip(refit) {
    let message = refit.text_long

    if (refit.modifications && refit.modifications.length > 0) {
        for (const mod of refit.modifications) {
            if (mod.type === 'arm') {
                if (mod.action === 'modify') {
                    message += `\n[${formatModificationData(JSON.parse(mod.module))}: firepower(${mod.pivot.firepower || 'N/A'}) range(${mod.pivot.range_speed || mod.pivot.misc || 'N/A'})]`
                } else if (mod.action === 'replace' || mod.action === 'add') {
                    message += `\n[${formatModificationData(JSON.parse(mod.value))}: firepower(${mod.pivot.firepower || 'N/A'}) range(${mod.pivot.range_speed || mod.pivot.misc || 'N/A'})]`
                }
            }
        }
    }

    return message
}

function showRefitTooltip(refit) {
    showTooltip(buildRefitTooltip(refit))
}
</script>

<template>
  <div class="card-ship-refit-container absolute top-7 left-2 w-xl h-64 z-10 border-2 border-primary-500-opc-80 rounded-md bg-secondary-300 overflow-auto text-primary-500-opc-80">
    <ul class="list-none p-5 pl-9 m-0 text-left">
      <li v-for="refit in ship.refits" :key="refit.id" class="ship-refit">
        <label
            class="cursor-pointer"
            @mouseenter="showRefitTooltip(refit)"
            @mouseleave="clearTooltip"
        >
          <input
            type="checkbox"
            :name="refit.name"
            :data-refit-pivot-id="refit.pivot.id"
            :checked="isRefitApplied(refit)"
            class="hidden peer"
          />
          <span class="inline-block align-middle w-4 h-4 border-2 border-primary-500-opc-80 rounded-sm bg-secondary mr-3 peer-checked:bg-primary-500"></span>
          <span class="align-middle">{{ refit.text }}</span>
          <span class="align-middle"> ({{ refit.pivot.points }}pts)</span>
        </label>
        <ul v-if="refit.children && refit.children.length > 0" class="ship-refits-children list-none pl-9 m-0 text-left">
          <li v-for="child in refit.children" :key="child.id" class="ship-refit">
            <label
                class="cursor-pointer"
                @mouseenter="showRefitTooltip(child)"
                @mouseleave="clearTooltip"
            >
              <input
                type="checkbox"
                :name="child.name"
                :data-refit-pivot-id="child.pivot.id"
                :checked="isRefitApplied(child)"
                :disabled="!isParentRefitApplied(refit)"
                class="hidden peer"
              />
              <span class="inline-block align-middle w-4 h-4 border-2 border-primary-500-opc-80 rounded-sm bg-secondary mr-3 peer-checked:bg-primary-500 peer-disabled:border-primary-100-opc-35"></span>
              <span class="align-middle peer-disabled:text-primary-100-opc-35">{{ child.text }}</span>
              <span class="align-middle peer-disabled:text-primary-100-opc-35"> ({{ child.pivot.points }}pts)</span>
            </label>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>
