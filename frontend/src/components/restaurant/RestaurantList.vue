<template>
  <div class="col-md-3 restaurant-list">
    <ul>
      <li v-for="restaurant in restaurants" :key="restaurant.id"
          :class="{ active: restaurant.id === selectedRestaurant?.id }"
          @click="selectRestaurant(restaurant)">
        {{ restaurant.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    restaurants: Array,
    selectedRestaurant: Object
  },
  methods: {
    selectRestaurant(restaurant) {
      this.$emit('restaurantSelected', restaurant);
    }
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
</style>
