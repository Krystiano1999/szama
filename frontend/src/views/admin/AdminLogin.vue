<template>
    <div class="admin-login">
      <h1>Logowanie do Panelu Admina</h1>
      <form @submit.prevent="login">
        <input type="text" v-model="credentials.username" placeholder="Nazwa użytkownika"/>
        <input type="password" v-model="credentials.password" placeholder="Hasło"/>
        <button type="submit">Zaloguj się</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        credentials: {
          username: '',
          password: ''
        }
      };
    },
    methods: {
      login() {
        // Implementacja logowania (np. wywołanie API)
        console.log("Logowanie z danymi:", this.credentials);
        // Redirect po udanym logowaniu
        // this.$router.push('/admin/dashboard');
      }
    }
  };
  </script>
  
  <style>
body {
  background-color: var(--color-light-cream);
}

.admin-login {
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  background-color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.admin-login h1 {
  color: var(--color-dark-gray);
  text-align: center;
  margin-bottom: 20px;
}

.admin-login form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.admin-login input[type="text"],
.admin-login input[type="password"] {
  padding: 10px;
  border: 1px solid var(--color-dark-gray);
  border-radius: 4px;
  font-size: 1rem;
}

.admin-login input[type="text"]:focus,
.admin-login input[type="password"]:focus {
  outline: none;
  border-color: var(--color-blue);
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.admin-login button {
  padding: 10px;
  background-color: var(--color-blue);
  color: var(--color-light-cream);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 1rem;
  font-weight: bold;
  transition: background-color 0.3s;
}

.admin-login button:hover {
  background-color: var(--color-orange);
}

</style>
