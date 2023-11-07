<template>
  <div class="container-fluid position-relative mt-70 mh100-70">
    <div class="container">
      <div class="row">
        <RestaurantList
    :restaurants="restaurants"
    :selectedRestaurant="selectedRestaurant"
    @restaurantSelected="updateSelectedRestaurant"
  />
        <RestaurantMenu :restaurant="selectedRestaurant" @addItem="addItemToOrder" />
        <OrderSummary :orderItems="orderItems" @removeItem="removeItemFromOrder" />
      </div>
    </div>
  </div>
</template>

<script>
import RestaurantList from '@/components/restaurant/RestaurantList.vue';
import RestaurantMenu from '@/components/restaurant/RestaurantMenu.vue';
import OrderSummary from '@/components/restaurant/OrderSummary.vue';

export default {
  components: {
    RestaurantList,
    RestaurantMenu,
    OrderSummary
  },
  data() {
    return {
      restaurants: [
        {
          id: 1,
          name: "Restauracja Italiano",
          menu: [
            { id: 101, name: "Margherita", price: 20, imageUrl: "margeritta.png" },
            { id: 102, name: "Pepperoni", price: 24, imageUrl: "pepperoni.png"  },
            { id: 103, name: "Margherita", price: 20, imageUrl: "margeritta.png" },
            { id: 104, name: "Pepperoni", price: 24, imageUrl: "pepperoni.png"  },
            { id: 105, name: "Margherita", price: 20, imageUrl: "margeritta.png" },
            { id: 106, name: "Pepperoni", price: 24, imageUrl: "pepperoni.png"  },
            // więcej dań...
          ],
        },
        {
          id: 2,
          name: "Burger Place",
          menu: [
            { id: 201, name: "Classic Burger", price: 18, imageUrl: "classic-burger.png"  },
            { id: 202, name: "Cheeseburger", price: 22, imageUrl: "cheeseburger.png"  },
            { id: 203, name: "Classic Burger", price: 18, imageUrl: "classic-burger.png"  },
            { id: 204, name: "Cheeseburger", price: 22, imageUrl: "cheeseburger.png"  },
            { id: 205, name: "Classic Burger", price: 18, imageUrl: "classic-burger.png"  },
            { id: 206, name: "Cheeseburger", price: 22, imageUrl: "cheeseburger.png"  },
            // więcej dań...
          ],
        },
        {
          id: 3,
          name: "Burger Americano",
          menu: [
            { id: 301, name: "Jalapeno Burger", price: 38, imageUrl: "jalapeno.png"  },
            { id: 302, name: "BigBurger", price: 29, imageUrl: "bigburger.png"  },
            { id: 303, name: "Jalapeno Burger", price: 38, imageUrl: "jalapeno.png"  },
            { id: 304, name: "BigBurger", price: 29, imageUrl: "bigburger.png"  },
            { id: 305, name: "Jalapeno Burger", price: 38, imageUrl: "jalapeno.png"  },
            { id: 306, name: "BigBurger", price: 29, imageUrl: "bigburger.png"  },
            // więcej dań...
          ],
        },
      ],
      selectedRestaurant: null,
      orderItems: []
    };
  },
  mounted() {
    // Załadowanie pierwszej restauracji jako domyślnej
    this.updateSelectedRestaurant(this.restaurants[0]);
  },
  methods: {
    updateSelectedRestaurant(restaurant) {
      // Sprawdź czy wybrano inną restaurację niż poprzednio i czy w zamówieniu są jakieś pozycje
      if (this.lastRestaurantId && this.lastRestaurantId !== restaurant.id && this.orderItems.length > 0) {
        // Jeśli tak, pokaż alert
        if (window.confirm("Możesz zamówić jedzenie tylko z jednej restauracji. Czy chcesz wyczyścić koszyk i zmienić restaurację?")) {
          this.orderItems = [];
          this.selectedRestaurant = restaurant;
          this.lastRestaurantId = restaurant.id;
        }
      } else {
        // Aktualizuj wybraną restaurację
        this.selectedRestaurant = restaurant;
        // Jeśli nie było poprzedniego wyboru lub to ta sama restauracja
        this.lastRestaurantId = restaurant.id;
      }
    },
    addItemToOrder(dish) {
      const existingItem = this.orderItems.find(item => item.id === dish.id);
      if (existingItem) {
        existingItem.quantity += dish.quantity;
      } else {
        this.orderItems.push({ ...dish });
      }
    },
    removeItemFromOrder(itemToRemove) {
      const index = this.orderItems.findIndex(item => item.id === itemToRemove.id);
      if (index > -1) {
        this.orderItems.splice(index, 1);
      }
    }
  }
};
</script>

<style scoped>

</style>
