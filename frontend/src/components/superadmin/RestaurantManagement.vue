<template>
  <div class="restaurant-management">
    <h2>Zarządzanie restauracjami</h2>
    <ul>
     <!--  <li v-for="restaurant in restaurants" :key="restaurant.id">
        <div>{{ restaurant.name }}</div>
        <div>{{ restaurant.address }}</div>
        Wyświetlanie innych informacji o restauracji
        <button @click="deleteRestaurant(restaurant.id)">Usuń</button>
      </li> -->
    </ul>
  </div>
</template>

<script>
export default {
  name: 'RestaurantManagement',
  data() {
    return {
      restaurants: [] // Tutaj będą dane restauracji
    };
  },
  methods: {
    deleteRestaurant(id) {console.log(id);
      // Logika usuwania restauracji
    }
  },
  mounted() {
    // Pobranie danych restauracji
  }
}
</script>

<style>
  /* Styl dla komponentu */
</style>
