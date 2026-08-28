<script setup>
const props = defineProps({
  armaments: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
    <div class="card-ship-armaments card-box-container flex flex-wrap flex-col self-center items-center w-full" v-if="armaments && armaments.length > 0">
      <table class="w-full bg-primary-500-opc-80 border-collapse">
        <thead class="text-secondary">
          <tr>
              <th class="font-normal">Armament</th>
              <th class="font-normal">Speed/Range</th>
              <th class="font-normal" colspan="2">Firepower</th>
          </tr>
        </thead>
        <tbody class="bg-secondary">
            <template v-for="armament in armaments" :key="armament.id">
                <tr
                    v-if="armament.placement !== 'Starboard'"
                    :class="`firearc-${armament.fire_arc_short}`"
                    class="border-t-2 border-b-primary-500-opc-80 relative after:content-[''] after:block after:absolute after:-top-0.5 after:-right-7 after:w-6 after:h-6 after:bg-contain after:bg-no-repeat"
                >
                    <!-- 1st col -->
                    <td class="border-r-2 border-b-primary-500-opc-80">{{ (armament.placement === 'Port' ? 'Pt|Sb' : armament.placement) + ' ' + armament.type }}</td>

                    <!-- 2nd col -->
                    <td v-if="armament.pivot.range_speed" class="border-r-2 border-b-primary-500-opc-80">{{ armament.pivot.range_speed }}</td>
                    <td v-else-if="armament.pivot.misc" class="border-r-2 border-b-primary-500-opc-80">{{ armament.pivot.misc }}</td>
                    <td v-else class="border-r-2 border-b-primary-500-opc-80">N/A</td>

                    <!-- 3rd col -->
                    <template v-if="armament.placement === 'Port'">
                        <td class="border-r-2 border-b-primary-500-opc-80">{{ armament.pivot.firepower }}</td>
                        <td>{{ armament.pivot.firepower }}</td>
                    </template>
                    <template v-else>
                        <td colspan="2">{{ armament.pivot.firepower }}</td>
                    </template>
                </tr>
            </template>
        </tbody>
      </table>
    </div>
</template>
