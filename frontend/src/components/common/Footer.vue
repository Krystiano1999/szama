<template>
  <footer class="container-fluid py-2 text-white">
    <div class="container d-flex justify-content-between align-items-center">
        <p class="mb-0">&copy; 2023 Twoja aplikacja do zamawiania jedzenia</p>
        <router-link to="/register-restaurant">Zarejestruj swoją restaurację</router-link>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter'
}
</script>

<style scoped>
    footer{
        background-color: var(--color-dark-gray);
    }
</style>
 