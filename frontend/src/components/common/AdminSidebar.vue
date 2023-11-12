<template>
    <div class="admin-sidebar">
      <ul>
        <li><router-link to="/admin/dashboard">Home</router-link></li>
        <li><router-link to="/admin/restaurant-management">Zarządzanie restauracją</router-link></li>
        <li><router-link to="/admin/category-management">Zarządzanie kategoriami</router-link></li>
        <li><router-link to="/admin/menu-management">Zarządzanie menu</router-link></li>
        <li><router-link to="/admin/orders-management">Zarządzanie zamówieniami</router-link></li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: "AdminSidebar"
  };
  </script>
  
  <style>
  .admin-sidebar {
    background-color: var(--color-blue); 
    color: var(--color-light-cream);
    min-width: 200px; 
    height: 100vh;
    padding: 1em; 
    max-width:350px;
  }
  
  .admin-sidebar ul {
    list-style: none;
    padding: 0;
  }
  
  .sidebar-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: var(--color-light-cream); 
    text-decoration: none; 
    font-size: 18px;
  }
  
  .sidebar-link .icon {
    margin-right: 10px; 
  }
  

  .home-icon:before {
    content: '\f015'; 
  }
  
  .category-icon:before {
    content: '\f02d'; 
  }
  
  .menu-icon:before {
    content: '\f0f5'; 
  }
  
  .orders-icon:before {
    content: '\f07a';
  }
  
  .users-icon:before {
    content: '\f0c0'; 
  }
  
  /* Stylizacja aktywnego linku */
  .router-link-active {
    background-color: var(--color-orange);
  }
  
  /* Odpowiednie style dla hover */
  .sidebar-link:hover {
    background-color: var(--color-orange);
    cursor: pointer;
  }
  </style>
  