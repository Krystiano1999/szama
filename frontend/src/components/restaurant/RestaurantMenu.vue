<template>
  <div class="col-md-7 restaurant-menu">
    <div v-if="restaurant">
      <div v-for="(dishes, category) in filteredMenu" :key="category">
        <div class="menu-items menu-grid mt-3">
          <div class="menu-item position-relative" v-for="dish in dishes" :key="dish.id" @mouseenter="hovering = dish.id" @mouseleave="hovering = null">
            <img :src="getImageUrl(restaurant.name, dish.imageUrl)" :alt="dish.name">
            <div class="menu-item-content">
              <div class="menu-item-header">
                <h5>{{ dish.name }}</h5>
                <span class="menu-item-price">{{ formatCurrency(dish.price) }}</span>
              </div>
              <div v-show="hovering === dish.id" class="menu-item-quantity-box">
                <input type="number" v-model.number="localQuantities[dish.id]" min="1" class="quantity-input">
              </div>
              <button class="btn btn-primary" :class="{ 'hovered': hovering === dish.id }" @click="addItem(dish)">Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p v-else>Wybierz restaurację, aby zobaczyć menu.</p>
  </div>
</template>

<script>
export default {
  props: {
    restaurant: Object,
    activeCategory: String
  },
  data() {
    return {
      hovering: null,
      localQuantities: {}
    };
  },
  computed: {
    filteredMenu() {
      if (!this.restaurant || !this.restaurant.menu) {
        return {};
      }
      if (!this.activeCategory) {
        let allDishes = [];
        for (let category in this.restaurant.menu) {
          allDishes = allDishes.concat(this.restaurant.menu[category]);
        }
        return { 'Wszystkie': allDishes };
      }
      return { [this.activeCategory]: this.restaurant.menu[this.activeCategory] };
    }
  },
  methods: {
    addItem(dish) {
      const quantityToAdd = this.localQuantities[dish.id] || 1;
      this.$emit('addItem', { ...dish, quantity: quantityToAdd });
      this.localQuantities[dish.id] = 1;
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('pl-PL', { style: 'currency', currency: 'PLN' }).format(value);
    },
    getImageUrl(restaurantName, imageUrl) {
      const restaurantSlug = restaurantName.toLowerCase().replace(/\s+/g, '-');
      try {
        return require(`@/assets/images/${restaurantSlug}/${imageUrl}`);
      } catch (e) {
        console.error(e);
        return '/default-image.png'; // ścieżka do obrazu domyślnego, gdy obraz nie zostanie znaleziony
      }
    }
  }
};
</script>

<style scoped>
.menu-item-quantity-box input {
  width: 50px;
  text-align: center;
}

.menu-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1rem;
}

.menu-item {
  background: var(--color-light-cream);
  border: 1px solid var(--color-light-cream);
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.menu-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.menu-item img {
  width: 100%;
  display: block;
  object-fit: cover;
}

.menu-item-content {
    padding: 0.5rem;
    text-align: left;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

}

.menu-item-header {
  margin-bottom: 0.5rem;
}

.menu-item-price {
    font-weight: bold;
    color: var(--color-light-cream);
    background-color: var(--color-orange);
    padding: 5px;
    margin-top: 15px;
    display: inline-block;
    font-size: 1.25rem;
}

.menu-item h5 {
    margin: 0;
    font-size: 1.2rem;
    background-color: var(--color-light-cream);
    width: auto;
    display: table;
    padding: 5px;
    font-weight: 600;
    color: var(--color-dark-gray);
}

.menu-item-quantity-box {
  position: absolute;
  bottom: 5px;
  left: 50%; 
  z-index: 100; 
  opacity: 0;
  min-width: 75px;
  transform: translateX(-50%);
  transition: all ease 0.3s;
}

.quantity-input {
  width: 50px;
  text-align: center;
  background-color: var(--color-light-cream);
  border: 1px solid var(--color-orange);
  color: var(--color-dark-gray);
  padding: 0.5rem;
  border-radius: 5px;
}

.menu-item:hover .menu-item-quantity-box {
  opacity:1;
  transform: translateX(-110%);
}

.menu-item .btn-primary {
    background-color: var(--color-orange);
    border: none;
    padding: 0.5rem 1rem;
    cursor: pointer;
    color: var(--color-light-cream);
    border-radius: 20px;
    transition: all ease 0.5s;
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
}

.btn-primary:hover {
  background-color: var(--color-orange);
}


.menu-item .btn-primary.hovered {
  transform: translateX(10%);
}

</style>