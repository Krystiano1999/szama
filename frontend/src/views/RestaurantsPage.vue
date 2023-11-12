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
      <OrderSummary :orderItems="orderItems" @removeItem="removeItemFromOrder" />
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
      restaurants: [
        {
          id: 1,
          name: "Restauracja Italiano",
          city: "Kielce",
          menu: {
            "Pizza": [
              { id: 101, name: "Margherita", price: 20, imageUrl: "margeritta.png" },
              { id: 102, name: "Pepperoni", price: 24, imageUrl: "pepperoni.png" },
              { id: 103, name: "Hawajska", price: 22, imageUrl: "hawajska.png" },
              // więcej pizzy...
            ],
            "Makarony": [
              { id: 104, name: "Spaghetti Carbonara", price: 25, imageUrl: "carbonara.png" },
              { id: 105, name: "Penne Arrabbiata", price: 23, imageUrl: "arrabbiata.png" },
              // więcej makaronów...
            ],
            // inne kategorie...
          },
        },
        {
          id: 2,
          name: "Sushi World",
          city: "Warszawa",
          menu: {
            "Sushi": [
              { id: 201, name: "California Rolls", price: 30, imageUrl: "california-rolls.png" },
              { id: 202, name: "Nigiri Sushi", price: 35, imageUrl: "nigiri-sushi.png" },
              { id: 203, name: "Dragon Rolls", price: 40, imageUrl: "dragon-rolls.png" },
              // więcej sushi...
            ],
            "Zupy": [
              { id: 204, name: "Miso", price: 20, imageUrl: "miso.png" },
              { id: 205, name: "Ramen", price: 32, imageUrl: "ramen.png" },
              // więcej zup...
            ],
            // inne kategorie...
          },
        },
        {
          id: 3,
          name: "Mexican Fiesta",
          city: "Poznań",
          menu: {
            "Tacos": [
              { id: 301, name: "Beef Taco", price: 25, imageUrl: "beef-taco.png" },
              { id: 302, name: "Chicken Taco", price: 23, imageUrl: "chicken-taco.png" },
              // więcej tacos...
            ],
            "Quesadillas": [
              { id: 303, name: "Cheese Quesadilla", price: 20, imageUrl: "cheese-quesadilla.png" },
              { id: 304, name: "Mushroom Quesadilla", price: 22, imageUrl: "mushroom-quesadilla.png" },
              // więcej quesadillas...
            ],
            // inne kategorie...
          },
        },
        {
          id: 4,
          name: "Steak House",
          city: "Gdańsk",
          menu: {
            "Steki": [
              { id: 401, name: "Ribeye Steak", price: 45, imageUrl: "ribeye.png" },
              { id: 402, name: "T-Bone Steak", price: 50, imageUrl: "t-bone.png" },
              // więcej steków...
            ],
            "Dodatki": [
              { id: 403, name: "Frytki", price: 10, imageUrl: "frytki.png" },
              { id: 404, name: "Warzywa Grillowane", price: 12, imageUrl: "warzywa-grillowane.png" },
              // więcej dodatków...
            ],
            // inne kategorie...
          },
        },
        {
          id: 5,
          name: "Green Veggie",
          city: "Kraków",
          menu: {
            "Sałatki": [
              { id: 501, name: "Sałatka Grecka", price: 20, imageUrl: "salatka-grecka.png" },
              { id: 502, name: "Sałatka z Quinoa", price: 22, imageUrl: "salatka-z-quinoa.png" },
              // więcej sałatek...
            ],
            "Smoothies": [
              { id: 503, name: "Smoothie Owocowe", price: 15, imageUrl: "smoothie-owocowe.png" },
              { id: 504, name: "Green Smoothie", price: 17, imageUrl: "green-smoothie.png" },
              // więcej smoothies...
            ],
            // inne kategorie...
          },
        },
        {
          id: 6,
          name: "Quick Bites",
          city: "Szczecin",
          menu: {
            "Fast Food": [
              { id: 601, name: "Hot Dog", price: 10, imageUrl: "hot-dog.png" },
              { id: 602, name: "Cheeseburger", price: 15, imageUrl: "cheeseburger.png" },
              // więcej fast food...
            ],
            "Napoje": [
              { id: 603, name: "Lemoniada", price: 5, imageUrl: "lemoniada.png" },
              { id: 604, name: "Cola", price: 5, imageUrl: "cola.png" },
              // więcej napojów...
            ],
            // inne kategorie...
          },
        },
        {
          id: 7,
          name: "Dumplings World",
          city: "Wrocław",
          menu: {
            "Pierogi": [
              { id: 701, name: "Pierogi Ruskie", price: 20, imageUrl: "pierogi-ruskie.png" },
              { id: 702, name: "Pierogi z Mięsem", price: 22, imageUrl: "pierogi-z-miesem.png" },
              // więcej pierogów...
            ],
            "Zupy": [
              { id: 703, name: "Barszcz Czerwony", price: 15, imageUrl: "barszcz-czerwony.png" },
              { id: 704, name: "Rosół", price: 16, imageUrl: "rosol.png" },
              // więcej zup...
            ],
            // inne kategorie...
          },
        },
        {
          id: 8,
          name: "Burger Americano",
          city: "Kielce",
          menu: {
            "Burgery": [
              { id: 801, name: "Big Burger", price: 20, imageUrl: "bigburger.png" },
              { id: 802, name: "Cheeseburger", price: 22, imageUrl: "cheeseburger.png" },
              { id: 803, name: "Jalapeno", price: 20, imageUrl: "jalapeno.png" },
              { id: 804, name: "Classic-burger", price: 22, imageUrl: "classic-burger.png" },
              // więcej burgerow...
            ],
            // inne kategorie...
          },
        },
        // więcej restauracji...
      ],
      selectedRestaurant: null,
      orderItems: []
    };
  },
  mounted() {
    if (this.restaurants.length > 0) {
      this.updateSelectedRestaurant(this.restaurants[0]);
    }
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
    searchRestaurants(searchTerm) {
      this.searchTerm = searchTerm;
      this.$nextTick(() => { 
        if (this.filteredRestaurants.length > 0) {
          this.updateSelectedRestaurant(this.filteredRestaurants[0]);
        } else {
          this.selectedRestaurant = null;
        }
      });
    },
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
      this.activeCategory = '';
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
    },
    updateActiveCategory(category) {
      this.activeCategory = category;
    }
  }
};
</script>