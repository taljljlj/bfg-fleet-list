<script setup>
const props = defineProps({
  armaments: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
    <div class="card-ship-armaments card-box-container" v-if="armaments && armaments.length > 0">
      <table>
        <thead>
          <tr>
              <th>Armament</th>
              <th>Speed/Range</th>
              <th colspan="2">Firepower</th>
          </tr>
        </thead>
        <tbody>
            <template v-for="armament in armaments" :key="armament.id">
                <tr
                    v-if="armament.placement != 'Starboard'"
                    :class="`firearc-${armament.fire_arc_short}`"
                >
                    <td>{{ (armament.placement === 'Port' ? 'Pt|Sb' : armament.placement) + ' ' + armament.type }}</td>

                    <td v-if="armament.pivot.range_speed">{{ armament.pivot.range_speed }}</td>
                    <td v-else-if="armament.pivot.misc">{{ armament.pivot.misc }}</td>
                    <td v-else>N/A</td>
                    <template v-if="armament.placement === 'Port'">
                        <td>{{ armament.pivot.firepower }}</td>
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

<style scoped>
.card-ship-armaments {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-self: center;
    align-items: center;
    width: 100%;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table thead {
    background-color: rgba(54, 87, 115, 0.8);
    color: #c8c5dc;
}

table thead th {
    font-weight: 400;
}

table tbody tr {
    border-top: 2px solid rgba(54, 87, 115, 0.8);
    position: relative;
}

table tbody td {
    border-right: 2px solid rgba(54, 87, 115, 0.8);
}

table tbody td:last-child {
    border-right: 0;
}

table tbody tr:after {
    content: '';
    display: block;
    position: absolute;
    top: -2px;
    right: -30px;
    width: 22px;
    height: 22px;
    background-size: contain;
    background-repeat: no-repeat;
}

table tbody tr.firearc-lr:after {
    background-image: url('@images/fleet-builder/firearc-lr.png');
}

table tbody tr.firearc-f:after {
    background-image: url('@images/fleet-builder/firearc-f.png');
}

tbody tr.firearc-lfr:after {
    background-image: url('@images/fleet-builder/firearc-lfr.png');
}

tbody tr.firearc-lf:after {
    background-image: url('@images/fleet-builder/firearc-lf.png');
}

tbody tr.firearc-fr:after {
    background-image: url('@images/fleet-builder/firearc-fr.png');
}
</style>
