<template>
  <HeaderComponent />
  <div class="container-fluid position-relative mt-70 mh100-70">
    <div class="row">
      <SearchBar @search="searchRestaurants" />
      <RestaurantList
        :restaurants="filteredRestaurants" 
        :selectedRestaurant="selectedRestaurant"
        @restaurantSelected="updateSelectedRestaurant"
      />
      <RestaurantCategory
        :restaurant="selectedRestaurant"
        :activeCategory="activeCategory"
        @categorySelected="updateActiveCategory"
      />
      <RestaurantMenu 
        v-if="selectedRestaurant" 
        :restaurant="selectedRestaurant"
        :activeCategory="activeCategory"
        @addItem="addItemToOrder" 
      />
      <OrderSummary
        :orderItems="orderItems"
        @removeItem="removeItemFromOrder"
        @submitOrder="submitOrder"
      />
    </div>
  </div>
  <FooterComponent />
</template>

<script>
import HeaderComponent from '@/components/common/Header.vue';
import FooterComponent from '@/components/common/Footer.vue';
import SearchBar from '@/components/common/SearchBar.vue'; 
import RestaurantList from '@/components/restaurant/RestaurantList.vue';
import RestaurantMenu from '@/components/restaurant/RestaurantMenu.vue';
import OrderSummary from '@/components/restaurant/OrderSummary.vue';
import RestaurantCategory from '@/components/restaurant/RestaurantCategory.vue';
import { getRestaurantsByCity, getRestaurantMenu, createOrder } from "@/api/api.js";
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

export default {
  components: {
    HeaderComponent,
    FooterComponent,
    SearchBar,
    RestaurantList,
    RestaurantMenu,
    OrderSummary,
    RestaurantCategory
  },
  data() {
    return {
      searchTerm: '',
      activeCategory: '',
      restaurants: [],
      selectedRestaurant: null,
      orderItems: [],
      lastRestaurantId: null  // Dodane do przechowywania ID ostatnio wybranej restauracji
    };
  },
  mounted() {
    this.fetchRestaurants("Kielce");
  },
  computed: {
    filteredRestaurants() {
      if (!this.searchTerm) return this.restaurants;
      return this.restaurants.filter(restaurant =>
        restaurant.city.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    }
  },
  methods: {
    searchRestaurants(cityName) {
      this.fetchRestaurants(cityName);
    },
    fetchRestaurants(cityName) {
      getRestaurantsByCity(cityName)
        .then(response => {
          this.restaurants = response.data.restaurants;
          if (this.restaurants.length > 0) {
            this.updateSelectedRestaurant(this.restaurants[0]);
          } else {
            this.selectedRestaurant = null;
          }
        })
        .catch(error => {
          console.error("Error fetching restaurants:", error);
        });
    },
    fetchRestaurantMenu(restaurantId) {
      getRestaurantMenu(restaurantId)
        .then(response => {
          this.selectedRestaurant = {
            ...this.selectedRestaurant, 
            menu: response.data.restaurant.menu
          };
        })
        .catch(error => {
          console.error("Error fetching restaurant menu:", error);
        });
    },
    updateSelectedRestaurant(restaurant) {
      if (this.lastRestaurantId && this.lastRestaurantId !== restaurant.id && this.orderItems.length > 0) {
        if (window.confirm("Możesz zamówić jedzenie tylko z jednej restauracji. Czy chcesz wyczyścić koszyk i zmienić restaurację?")) {
          this.orderItems = [];
        }
      }
      this.selectedRestaurant = { ...restaurant };
      this.lastRestaurantId = restaurant.id;
      this.activeCategory = '';
      this.fetchRestaurantMenu(restaurant.id);
    },
    addItemToOrder(dish) {
      const existingItem = this.orderItems.find(item => item.id === dish.id);
      if (existingItem) {
        existingItem.quantity += dish.quantity;
      } else {
        this.orderItems.push({ ...dish, quantity: dish.quantity || 1 });
      }
    },
    removeItemFromOrder(itemToRemove) {
      const index = this.orderItems.findIndex(item => item.id === itemToRemove.id);
      if (index > -1) {
        this.orderItems.splice(index, 1);
      }
    },
    updateActiveCategory(category) {
      this.activeCategory = category;
    },
    submitOrder() {
      const userId = localStorage.getItem('id'); // Pobranie ID użytkownika
      if (!userId) {
        showErrorMessage("Proszę się zalogować przed złożeniem zamówienia");
        return;
      }
      const orderData = {
        id_uzytkownika: userId, 
        cena: this.totalPrice,
        items: this.orderItems.map(item => ({
          id_pozycji_menu: item.id,
          ilosc: item.quantity,
          cena: item.price
        }))
      };

      createOrder(orderData)
        .then(response => {
          console.log(response);
          showSuccessMessage("Zamówienie zostało złożone!");
          this.clearOrder();
        })
        .catch(error => {
          console.log(error);
          showErrorMessage("Wystąpił błąd przy składaniu zamówienia:", error);
        });
    },
    clearOrder() {
      this.orderItems = [];
    },
  }
};
</script>
