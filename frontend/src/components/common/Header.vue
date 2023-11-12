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
                <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Zaloguj się</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">{{ isLoginMode ? 'Zaloguj się' : 'Załóż konto' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="isLoginMode ? loginUser() : registerUser()">
              <div v-if="!isLoginMode">
                <div class="mb-3">
                  <label for="email" class="form-label">Adres Email</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                  <label for="tel" class="form-label">Numer Telefonu</label>
                  <input type="tel" class="form-control" id="tel" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Adres</label>
                  <input type="text" class="form-control" id="address" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Nazwa Użytkownika</label>
                <input type="text" class="form-control" id="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Hasło</label>
                <input type="password" class="form-control" id="password" required>
              </div>
              <button type="submit" class="btn btn-primary">{{ isLoginMode ? 'Zaloguj się' : 'Zarejestruj' }}</button>
            </form>
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-link" @click="toggleMode">{{ isLoginMode ? 'Załóż konto' : 'Masz już konto? Zaloguj się' }}</button>
          </div>
        </div>
      </div>
    </div>
    
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
  data() {
    return {
      isLoginMode: true
    }
  },
  methods: {
    toggleMode() {
      this.isLoginMode = !this.isLoginMode;
    },
    loginUser() {
      // Logika logowania
    },
    registerUser() {
      // Logika rejestracji
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
  .btn{
      background-color: var(--color-blue) ;
      color: var(--color-light-cream) ;
  }
  .modal-open {
    overflow: inherit !important;
  }
  .modal.fade.show{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.5);
  }
</style>