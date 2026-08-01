<script setup>
import { ref } from 'vue';
import caretIcon from "@images/caret-icon.png";

const props = defineProps({
    items: {
        type: Array,
        default: () => []
    },
    labelKey: {
        type: String,
        default: 'name'
    },
    valueKey: {
        type: String,
        default: 'id'
    },
    selectedItem: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(["item-selected"]);

const isExpanded = ref(false);

const handleToggleDropdown = () => {
    if (props.items.length > 0) {
        isExpanded.value = !isExpanded.value;
    }
};

const handleSelect = (item) => {
    emit('item-selected', item[props.valueKey], item[props.labelKey]);
    isExpanded.value = false;
};
</script>

<template>
    <div class="dropdown relative **:select-none group" :class="{ expanded: isExpanded }">
        <div class="dropdown-select relative w-full h-9 py-1 px-3.5 border-2 border-secondary rounded-md cursor-pointer z-0 tracking-wider hover:shadow-[inset_0_0_10px_#c8c5dc]"
             @click="handleToggleDropdown"
        >
            <span>{{ selectedItem ? selectedItem[labelKey] : '' }}</span>
            <span class="dropdown-caret">
                      <img :src="caretIcon" alt="Caret" class="float-right opacity-70 group-[.expanded]:rotate-180">
                    </span>
        </div>
        <div class="dropdown-content absolute top-full left-0 right-0 w-full border-2 border-secondary border-t-0 rounded-md z-10 backdrop-blur-sm bg-primary-500 shadow-[0_0_30px_#1a202c,inset_0_0_30px_#c8c5dc]"
             :style="{ display: isExpanded ? 'block' : 'none' }"
        >
            <ul>
                <li
                    v-for="item in items"
                    :key="item[valueKey]"
                    @click="handleSelect(item)"
                    class="tracking-wider py-0.5 px-1.5 cursor-pointer border-b-2 border-t-2 border-transparent hover:text-white hover:border-secondary"
                >
                    {{ item[labelKey] }}
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>

</style>
