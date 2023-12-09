<template>
    <div class="admin-login">
      <h1>Logowanie do Panelu Super Admina</h1>
      <form @submit.prevent="login">
        <input type="text" v-model="credentials.username" placeholder="Nazwa użytkownika"/>
        <input type="password" v-model="credentials.password" placeholder="Hasło"/>
        <button type="submit">Zaloguj się</button>
      </form>
    </div>
  </template>
  
  <script>
    import { loginSuperAdmin } from '@/api/api';
    import { showErrorMessage } from '@/components/notification/NotificationHelper';

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
        loginSuperAdmin(this.credentials)
            .then(response => {
            // Sprawdź, czy odpowiedź zawiera token
            if (response.data.token) {
                console.log("Logowanie udane:", response);
                // Zapisz token w localStorage
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('userType', 'superadmin'); // Zapisz typ użytkownika
                // Przekieruj do panelu superadmina
                this.$router.push('/superadmin/new-restaurant-management');
            }
            })
            .catch(error => {
                console.error("Błąd logowania:", error);
                showErrorMessage("Nieprawidłowe dane logowania");
            });
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
