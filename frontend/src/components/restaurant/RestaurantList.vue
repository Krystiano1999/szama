<template>
  <div class="col-md-2 restaurant-list px-md-0">
    <ul v-if="restaurants && restaurants.length > 0">
      <li v-for="restaurant in restaurants" :key="restaurant.id"
          :class="{ active: restaurant.id === selectedRestaurantId }"
          @click="selectRestaurant(restaurant)">
        {{ restaurant.name }}
      </li>
    </ul>
    <div v-else class="no-restaurants">Nie znaleziono resturacji w Twojej miejscowości</div>
  </div>
</template>

<script>
import { computed } from 'vue';

export default {
  props: {
    restaurants: Array,
    selectedRestaurant: Object
  },
  setup(props, { emit }) {
    const selectedRestaurantId = computed(() => props.selectedRestaurant?.id);

    const selectRestaurant = (restaurant) => {
      emit('restaurantSelected', restaurant);
    };

    return { selectedRestaurantId, selectRestaurant };
  }
};
</script>

<style scoped>
.restaurant-list ul {
  list-style-type: none;
  padding: 0;
}

.restaurant-list li {
  padding: 10px;
  cursor: pointer;
  background-color: var(--color-light-cream); 
  transition: background-color 0.3s, color 0.2s;
  font-size:21px;
  border: 1px solid var(--color-dark-gray);
}

.restaurant-list li:hover,
.restaurant-list li.active {
  background-color: var(--color-orange); 
  color: var(--color-light-cream); 
  font-weight: 600;
}

.restaurant-list li:not(.active):hover {
  background-color: var(--color-light-cream);
  color: var(--color-dark-gray);
}

.no-restaurants{
  padding: 10px;
  font-size: 21px;
  color: var(--color-dark-gray);
}
</style>