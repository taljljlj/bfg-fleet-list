<script setup>
const props = defineProps({
  armaments: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <div class="ship-armaments-section-container">
    <div class="card-ship-armaments card-box-container" v-if="armaments && armaments.length > 0">
      <h4>Armaments</h4>
      <table class="armaments-table">
        <thead>
          <tr>
            <th>Weapon</th>
            <th>Range/Speed</th>
            <th>Firepower</th>
            <th>Misc</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="armament in armaments" :key="armament.id">
            <td>{{ armament.name }}</td>
            <td>{{ armament.pivot.range_speed || armament.range_speed }}</td>
            <td>{{ armament.pivot.firepower || armament.firepower }}</td>
            <td>{{ armament.pivot.misc || armament.misc || '-' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.card-ship-armaments {
  margin-bottom: 1rem;
}

.card-ship-armaments h4 {
  margin: 0 0 0.5rem 0;
  font-size: 1.1rem;
}

.armaments-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.9rem;
}

.armaments-table th,
.armaments-table td {
  padding: 0.5rem;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.armaments-table th {
  background: #f8f9fa;
  font-weight: bold;
}

.armaments-table tr:hover {
  background: #f8f9fa;
}
</style>
