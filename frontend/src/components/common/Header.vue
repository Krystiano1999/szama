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
                  <li><a class="dropdown-item" href="#">Profil</a></li>
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
import { logoutUser } from '@/api/api';
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

export default {
  name: 'AppHeader',
  components: {
    LoginModal
  },
  data() {
    return {
      loggedInUser: null,
      messageContent: '',
      messageType: '',
    };
  },
  methods: {
    handleUserLogin(userInfo) {
      this.loggedInUser = userInfo;
    },
    async logout() {
      try {
        const response = await logoutUser();
        // Tu możesz obsłużyć odpowiedź z serwera, np. usunąć token z pamięci, przekierować itd.
        console.log(response.data.message); // Wyświetli wiadomość "Użytkownik wylogowany"
        showSuccessMessage("Pomyślnie wylogowano");
        // Przekierowanie do strony głównej, ekranu logowania itp.
        this.$router.push('/');
      } catch (error) {
        //console.error("Wystąpił błąd podczas wylogowywania:", error.response);
        showErrorMessage("Wystąpił błąd podczas wylogowywania:", error.response);
      }
    }
    
  }
}
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
</style>