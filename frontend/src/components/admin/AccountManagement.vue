<template>
  <div class="account">
    <h2 class="mt-5">Zarządzanie Kontem</h2>
    <div class="restaurant-management">
      <form @submit.prevent="saveUserData" class="row">
        <div class="form-group col-md-6">
          <label for="restaurant-login">Login</label>
          <input type="text" id="restaurant-login" v-model="user.username" disabled>
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-email">E-mail</label>
          <input type="email" id="restaurant-email" v-model="user.email">
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-pass">Hasło</label>
          <input type="password" id="restaurant-passwd" v-model="user.password" placeholder="Wpisz nowe hasło">
        </div>
        <div class="form-group col-md-6">
          <label for="restaurant-phone">Numer tel.</label>
          <input type="text" id="restaurant-phone" v-model="user.phone_number">
        </div>
        <button type="submit" class="save-button">Zapisz</button>
      </form>
    </div>
  </div>
</template>

 <script>
    import { updateUserData } from '@/api/api';
    import { showSuccessMessage } from '@/components/notification/NotificationHelper';

    export default {
      data() {
        return {
          user: {
            username: '',
            email: '',
            password: '',
            phone_number: ''
          },
          originalEmail: '',
        };
      },
      mounted() {
        this.fetchUserData();
      },
      methods: {
        fetchUserData() {
          console.log(localStorage);
          this.user.username = localStorage.getItem('username') || '';
          this.user.email = localStorage.getItem('email') || '';
          this.user.phone_number = localStorage.getItem('phone_number') || '';
        },
        saveUserData() {
          const userId = localStorage.getItem('id'); 
          if (userId && confirm('Czy jesteś pewny, że chcesz zapisać zmiany? Operacja nie może zostać cofnięta.')) {
            if (!this.user.phone_number) {
              this.user.phone_number = this.originalphone_number;
            }

            updateUserData(userId, this.user).then(response => {
              console.log('Dane zaktualizowane', response.data);
              showSuccessMessage("Dane zostały zaktualizowane");
            }).catch(error => {
              console.error('Błąd aktualizacji', error);
            });
          } else {
            console.error('Brak ID użytkownika');
          }
        }
      }
    };
</script>

  
  
  <style>

  </style>
  