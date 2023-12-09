<template>
  <div class="restaurant-management">
    <h3>Zarządzanie restauracjami</h3>
    <div class="my-5 p-3 bg-white" v-for="(group, city) in groupedRestaurants" :key="city">
      <h3>{{ city }}</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Nazwa</th>
            <th>Właściciel</th>
            <th>Adres</th>
            <th>Akcje</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="restaurant in group" :key="restaurant.id">
            <td>{{ restaurant.name }}</td>
            <td>{{ restaurant.owner }}</td>
            <td>{{ restaurant.address }}</td>
            <td>
              <button @click="deleteRestaurant(restaurant.id)">Usuń</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { getAllRestaurants, deleteRestaurant } from '@/api/api';

export default {
  name: 'RestaurantManagement',
  data() {
    return {
      restaurants: []
    };
  },
  computed: {
    groupedRestaurants() {
      return this.restaurants.reduce((groups, restaurant) => {
        if (!groups[restaurant.city]) {
          groups[restaurant.city] = [];
        }
        groups[restaurant.city].push(restaurant);
        return groups;
      }, {});
    }
  },
  methods: {
    fetchRestaurants() {
      getAllRestaurants()
        .then(response => {
        console.log(response.data);
           this.restaurants = Object.values(response.data.restaurants);
        })
        .catch(error => {
          console.error('Błąd:', error);
        });
    },
    deleteRestaurant(id) {
      if (confirm('Czy na pewno chcesz usunąć tę restaurację?')) {
        deleteRestaurant(id)
          .then(() => {
            this.fetchRestaurants(); 
          })
          .catch(error => {
            console.error('Błąd:', error);
          });
      }
    }
  },
  mounted() {
    this.fetchRestaurants();
  }
}
</script>

<style>
 
</style>
