<template>
    <div class="admin-sidebar text-start col-md-2 position-relative">
      <ul class="sidebar-list">
        <li class="sidebar-item"><router-link to="/admin/dashboard" class="sidebar-link">Zarządzanie restauracją</router-link></li>
  
        <li class="sidebar-item"><router-link to="/admin/menu-management" class="sidebar-link">Zarządzanie menu</router-link></li>
  
        <li class="sidebar-item"><router-link to="/admin/orders-management" class="sidebar-link">Zarządzanie zamówieniami</router-link></li>
  
        <li class="sidebar-item"><router-link to="/admin/account-management" class="sidebar-link">Zarządzanie kontem</router-link></li>
  
      </ul>
      <div class="fixed-bottom position-absolute d-flex justify-content-center align-items-center py-3">
        <a role="button" class="btn btn-light" @click="logout">Wyloguj</a>
      </div>
    </div>
  </template>
  
  <script>
  import { logoutUser } from '@/api/api';
  export default {
    name: "AdminSidebar",
    methods: {
      logout() {
        logoutUser()
          .then(() => {
            localStorage.removeItem('token');
            localStorage.removeItem('restaurant_id');
            localStorage.removeItem('id');
            localStorage.removeItem('phone_number');
            localStorage.removeItem('username');
            localStorage.removeItem('email');
            this.$router.push('/');
          })
          .catch(error => {
            console.error("Błąd wylogowania:", error);
          });
      }
    }
  };
  </script>
  
  <style>
    .admin-sidebar {
      background-color: var(--color-blue); 
      color: var(--color-light-cream);
      height: 100vh;
      padding: 1em; 
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .admin-sidebar .sidebar-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .admin-sidebar .sidebar-item {
      margin-bottom: 15px;
    }

    .admin-sidebar .sidebar-link {
      display: flex;
      align-items: center;
      padding: 10px 15px;
      color: inherit; 
      text-decoration: none; 
      font-size: 16px;
      border-radius: 4px;
      transition: background-color 0.3s, color 0.3s;
    }

    /* Stylizacja aktywnego linku */
    .admin-sidebar .router-link-active, .sidebar-link.router-link-exact-active {
      color: var(--color-orange);
    }

    /* Odpowiednie style dla hover */
    .admin-sidebar .sidebar-link:hover {
      color: var(--color-orange);
      cursor: pointer;
    }


</style>
