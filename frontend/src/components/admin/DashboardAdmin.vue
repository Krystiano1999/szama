<template>
  <div class="dashboard">
    <h2 class="mt-5">Zarządzanie Restauracją</h2>
    <div class="restaurant-management">
      <form class="row" @submit.prevent="saveRestaurant">
        <div class="form-group col-md-6">
          <label for="restaurant-name">Nazwa Restauracji</label>
          <input type="text" id="restaurant-name" v-model="restaurant.Nazwa_Restauracji" placeholder="Wpisz nazwę restauracji">
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-region">Województwo</label>
          <input type="text" id="restaurant-region" v-model="restaurant.Wojewodztwo" placeholder="Wpisz województwo">
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-city">Miasto</label>
          <input type="text" id="restaurant-city" v-model="restaurant.Miasto" placeholder="Wpisz miasto">
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-address">Adres</label>
          <input type="text" id="restaurant-address" v-model="restaurant.Adres" placeholder="Wpisz adres">
        </div>
        <div class="form-group">
          <label for="restaurant-description">Opis</label>
          <textarea id="restaurant-description" v-model="restaurant.Opis" placeholder="Wpisz opis restauracji"></textarea>
        </div>
        <button type="submit" class="save-button">Zapisz</button>
      </form>
    </div>
  </div>
</template>

<script>
import { getRestaurantData, updateRestaurantData } from '@/api/api';
import { showSuccessMessage } from '@/components/notification/NotificationHelper';

export default {
  name: "DashboardAdmin",
  data() {
    return {
      restaurant: {
        name: '',
        region: '',
        city: '',
        address: '',
        description: '',
      }
    };
  },
  mounted() {
    this.fetchRestaurantData();
  },
  methods: {
    fetchRestaurantData() {
      const userId = localStorage.getItem('id');
      getRestaurantData(userId).then(response => {
        this.restaurant = response.data.restaurant;
        localStorage.setItem('restaurant_id', this.restaurant.ID_Restauracji);
        localStorage.setItem('restaurant_name', this.restaurant.Nazwa_Restauracji);
      }).catch(error => {
        console.error("Błąd podczas ładowania danych restauracji:", error);
      });
    },
    saveRestaurant() {
      const restaurantData = {
        name: this.restaurant.Nazwa_Restauracji,
        region: this.restaurant.Wojewodztwo,
        city: this.restaurant.Miasto,
        address: this.restaurant.Adres,
        description: this.restaurant.Opis,
        id: this.restaurant.ID_Restauracji
      };

      updateRestaurantData(restaurantData).then(() => {
        showSuccessMessage("Dane restauracji zostały zaktualizowane");
      }).catch(error => {
        console.error("Błąd podczas aktualizacji danych restauracji:", error);
      });
    }
  }
};
</script>


<style>
.dashboard {
  padding: 20px;
}

.dashboard-cards {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.card {
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 30%;
  padding: 20px;
  display: flex;
  align-items: center;
}

.card-icon {
  margin-right: 20px;
}

.card-content p {
  margin: 0;
  color: var(--color-dark-gray);
}

.card-content h2 {
  margin: 0;
  color:  var(--color-dark-gray);
}

button {
  background-color: var(--color-blue);
  color:  white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: var(--color-orange);
}

.dashboard .menu-items {
  width: 100%;
  border-collapse: collapse;
}

.dashboard .menu-items th,
.dashboard .menu-items td {
  border: 1px solid var(--color-blue);
  padding: 8px;
  text-align: left;
}

.dashboard .menu-items th {
  background-color: #f2f2f2;
}

.dashboard .menu-items tr:nth-child(even) {
  background-color:  var(--color-light-cream);
}

.dashboard .menu-items img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.restaurant-management {
  background-color: white;
  padding: 20px;
  margin-top: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.restaurant-management .form-group {
  margin-bottom: 15px;
}

.restaurant-management label {
  display: block;
  margin-bottom: 5px;
}

.restaurant-management input[type="text"],
.restaurant-management textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.restaurant-management textarea {
  resize: vertical;
  height: 100px;
}

.restaurant-management button {
  background-color: var(--color-blue);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.restaurant-management button:hover {
  background-color: var(--color-orange);
}

.form-group label {
  font-weight: bold;
  color: var(--color-dark-gray);
}

.form-group input[type="text"],
.form-group textarea {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border: 1px solid var(--color-dark-gray);
  border-radius: 4px;
  font-size: 1rem;
}

</style>
