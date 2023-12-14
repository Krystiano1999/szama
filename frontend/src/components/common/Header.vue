<template>
  <header class="container-fluid d-flex align-items-center fixed-top py-2">
    <div class="w-100 d-flex align-items-center justify-content-between">
      <router-link to="/" class="text-white">
        <img class="img-fluid rounded logo" src="@/assets/images/logo.png" alt="Logo" />
        SZAMA
      </router-link>
      <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item text-white">
                <router-link to="/restaurants" class="nav-link text-white">Restauracje</router-link>
              </li>
              <li class="nav-item text-white" v-if="!loggedInUser">
                <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Zaloguj się</a>
              </li>
              <li class="nav-item dropdown" v-else>
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Witaj, {{ loggedInUser.username }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li v-for="order in userOrders" :key="order.ID_Zamowienia">
                    <a class="dropdown-item" href="#">
                      ID Zamówienia: {{ order.ID_Zamowienia }}, Status: {{ order.Status_Zamowienia }}, Cena: {{ order.Cena }} zł
                    </a>
                  </li>
                  <li v-if="userOrders.length === 0">
                    <a class="dropdown-item" href="#">Brak zamówień</a>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#" @click="logout">Wyloguj</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <LoginModal @user-logged-in="handleUserLogin"/>
  </header>
</template>

<script>
import LoginModal from '@/components/auth/LoginModal.vue';
import { logoutUser, getOrdersByUser } from '@/api/api';
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

export default {
  name: 'AppHeader',
  components: {
    LoginModal
  },
  data() {
    return {
      loggedInUser: null,
      userOrders: [],
    };
  },
  created() {
    this.checkLoginStatus();
    if (this.loggedInUser) {
      this.showUserOrders();
    }
  },
  methods: {
    handleUserLogin(userInfo) {
      this.loggedInUser = userInfo;
    },
    checkLoginStatus() {
      const token = localStorage.getItem('token');
      const username = localStorage.getItem('username');
      const userId = localStorage.getItem('id');
      if (token && username) {
        this.loggedInUser = { username, id: userId };
      }
    },
    async logout() {
      try {
        await logoutUser();
        showSuccessMessage("Pomyślnie wylogowano");
        localStorage.removeItem('token');
        localStorage.removeItem('id');
        localStorage.removeItem('username');
        this.loggedInUser = null;
        this.$router.push('/');
      } catch (error) {
        showErrorMessage("Wystąpił błąd podczas wylogowywania");
      }
    },
    async showUserOrders() {
      if (!this.loggedInUser || !this.loggedInUser.id) {
        showErrorMessage("Brak danych o zalogowanym użytkowniku");
        return;
      }
      try {
        const response = await getOrdersByUser(this.loggedInUser.id);
        this.userOrders = response.data.filter(order => order.Status_Zamowienia !== 'Zrealizowane');
      } catch (error) {
        showErrorMessage("Wystąpił błąd podczas pobierania zamówień");
      }
    }
  }
};
</script>


<style scoped>
  header {
    max-height: 70px;
    height: 70px;
    background-color: var(--color-dark-gray);
  }
  .logo {
    max-height: 60px;
  }
  .dropdown-menu[data-bs-popper]{
    right: 0;
    left: auto !important;
  }
</style>