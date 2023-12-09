<template>
    <div class="admin-sidebar text-start col-md-2">
      <ul class="sidebar-list">
        <li class="sidebar-item"><router-link to="/admin/new-restaurant-management" class="sidebar-link">Zarządzanie rejestracjami restauracji</router-link></li>
  
        <li class="sidebar-item"><router-link to="/admin/restaurant-management" class="sidebar-link">Zarządzanie kategoriami</router-link></li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: "SuperAdminSidebar"
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
