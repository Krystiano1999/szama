<template>
    <div class="admin-sidebar text-start col-md-2 px-0 position-relative">
      <h2 class="w-100 px-2">SUPER ADMIN PANEL</h2>
      <ul class="sidebar-list">
        <li class="sidebar-item"><router-link to="/superadmin/new-restaurant-management" class="sidebar-link">Zarządzanie rejestracjami restauracji</router-link></li>
  
        <li class="sidebar-item"><router-link to="/superadmin/restaurant-management" class="sidebar-link">Zarządzanie kategoriami</router-link></li>
      </ul>
      <div class="fixed-bottom position-absolute d-flex justify-content-center align-items-center py-3">
        <a role="button" class="btn btn-light" @click="logout">Wyloguj</a>
      </div>
    </div>
  </template>
  
  <script>
  import { logoutUser } from '@/api/api';
  export default {
    name: "SuperAdminSidebar",
    methods: {
      logout() {
        logoutUser()
          .then(() => {
            localStorage.removeItem('token');
            this.$router.push('/superadmin/login');
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

    .admin-sidebar .sidebar-item .sidebar-link, h2 {
      border-bottom:1px solid white;
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
