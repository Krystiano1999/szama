<template>
  <div class="registration-form">
    <h2>Rejestracja Restauracji</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="ownerName">Imię i nazwisko właściciela</label>
        <input type="text" id="ownerName" v-model="restaurantData.owner_name" required>
      </div>
      <div class="form-group">
        <label for="restaurantName">Nazwa restauracji</label>
        <input type="text" id="restaurantName" v-model="restaurantData.restaurant_name" required>
      </div>
      <div class="form-group">
        <label for="province">Województwo</label>
        <input type="text" id="province" v-model="restaurantData.province" required>
      </div>
      <div class="form-group">
        <label for="city">Miasto</label>
        <input type="text" id="city" v-model="restaurantData.city" required>
      </div>
      <div class="form-group">
        <label for="address">Adres</label>
        <input type="text" id="address" v-model="restaurantData.address" required>
      </div>
      <div class="form-group">
        <label for="description">Opis</label>
        <textarea id="description" v-model="restaurantData.description" required></textarea>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="restaurantData.email" required>
      </div>
      <div class="form-group">
        <label for="phoneNumber">Numer telefonu</label>
        <input type="tel" id="phoneNumber" v-model="restaurantData.phone_number" required>
      </div>
      <button type="submit" class="submit-btn">Zarejestruj</button>
    </form>
  </div>
</template>

<script>
import { registerRestaurant } from '@/api/api';
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

export default {
  name: 'RestaurantRegister',
  data() {
    return {
      restaurantData: {
        owner_name: '',
        restaurant_name: '',
        province: '',
        city: '',
        address: '',
        description: '',
        email: '',
        phone_number: ''
      }
    };
  },
  methods: {
    submitForm() {
      registerRestaurant(this.restaurantData)
        .then(response => {
          console.log('Odpowiedź z serwera:', response);
          showSuccessMessage("Twoja rejestracja została przesłana do rozpatrzenia. Poinformujemy Państwa mailowo w ciągu 24h. DZIĘKUJEMY");
        })
        .catch(error => {
          console.error('Wystąpił błąd:', error.response);
          showErrorMessage('Wystąpił błąd:', error.response);
        });
    }
  }
}
</script>

<style>
.registration-form {
  background-color: #f5f5f5;
  padding: 20px;
  border-radius: 10px;
  width: 50%;
  margin: 0 auto;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input, .form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.submit-btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>
