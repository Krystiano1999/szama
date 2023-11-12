<template>
    <div class="menu-management">
      <h1>Menu</h1>
      <button class="add-menu-item-btn">+ Add menu item</button>
      <h2>Added menu item</h2>
      <table class="menu-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available?</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in menuItems" :key="item.id">
            <td>{{ item.id }}</td>
            <td><img :src="item.image" alt="Menu item" class="menu-item-image"/></td>
            <td>{{ item.name }}</td>
            <td>{{ item.category }}</td>
            <td>{{ item.price.toFixed(2) }}</td>
            <td>
              <span class="availability" :class="{ available: item.available }">
                {{ item.available ? 'Available' : 'Unavailable' }}
              </span>
            </td>
            <td>
              <button class="edit-btn">✏️</button>
              <button class="delete-btn">🗑️</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MenuManagement',
    data() {
      return {
        // Przykładowe dane, należy je pobrać z API lub stanu aplikacji
        menuItems: [
          // Tutaj będą dane z API
        ]
      };
    },
    methods: {
      // Metody do zarządzania elementami menu, np. dodawanie, edycja, usuwanie
    }
  };
  </script>
  
  <style scoped>
  .menu-management {
    padding: 20px;
  }
  
  .add-menu-item-btn {
    background-color: #4CAF50; /* Zielony */
    color: white;
    padding: 10px 20px;
    margin: 15px 0;
    border: none;
    cursor: pointer;
  }
  
  .menu-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .menu-table th,
  .menu-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  .menu-table th {
    background-color: #f2f2f2;
  }
  
  .menu-item-image {
    width: 50px;
    height: auto;
  }
  
  .availability {
    padding: 5px 10px;
    color: white;
  }
  
  .available {
    background-color: #4CAF50; /* Zielony */
  }
  
  .edit-btn {
    /* Stylizacja przycisku edycji */
  }
  
  .delete-btn {
    /* Stylizacja przycisku usuwania */
  }
  
  /* Dalsze style... */
  </style>
  