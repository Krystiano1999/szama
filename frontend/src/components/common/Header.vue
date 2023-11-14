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
              <li class="nav-item text-white">
                <a v-if="!loggedInUser" class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Zaloguj się</a>
                <span v-else class="nav-link text-white">Witaj, {{ loggedInUser.username }}</span>
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

export default {
  name: 'AppHeader',
  components: {
    LoginModal
  },
  data() {
    return {
      loggedInUser: null
    };
  },
  methods: {
    handleUserLogin(userInfo) {
      this.loggedInUser = userInfo;
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