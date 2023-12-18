<template>
  <div class="menu-management">
    <h1>Menu</h1>
    <button class="add-menu-item-btn" @click="openAddModal">+ Add menu item</button>
    <h2>Added menu items</h2>
    <table class="menu-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Obraz</th>
          <th>Nazwa</th>
          <th>Kategoria</th>
          <th>Cena</th>
          <th>Usuń</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in menuItems" :key="item.id">
          <td>{{ item.id }}</td>
          <td><img :src="getImageUrl(item.name)" alt="Menu item" class="menu-item-image"/></td>
          <td>{{ item.name }}</td>
          <td>{{ item.category }}</td>
          <td>{{ item.price ? parseFloat(item.price).toFixed(2) : '0.00' }}</td>
          <td>
            <button class="delete-btn" @click="deleteItem(item.id)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modale -->
    <AddMenuItemModal
      v-if="isAddModalVisible"
      :categories="categories"
      :isVisible="isAddModalVisible"
      @add-item="addItem"
      @close-modal="closeAddModal"
      @item-added="fetchMenuItems"
    />
  </div>
</template>

<script>
import { getRestaurantMenu, deleteMenuItem } from '@/api/api';
import AddMenuItemModal from '@/components/modal/AddMenuItemModal.vue';

export default {
  name: 'MenuManagement',
  components: {
    AddMenuItemModal
  },
  data() {
    return {
      menuItems: [],
      categories: [], 
      restaurantId: localStorage.getItem('restaurant_id'),
      restaurantName: localStorage.getItem('restaurant_name'),
      selectedItem: null,
      isEditModalVisible: false,
      isAddModalVisible: false
    };
  },
  mounted() {
    this.fetchMenuItems();
  },
  methods: {
    fetchMenuItems() {
      getRestaurantMenu(this.restaurantId).then(response => {
        const categories = response.data.restaurant.menu;
        this.menuItems = Object.values(categories).flat().map(item => ({
          ...item,
          category: Object.keys(categories).find(key => categories[key].includes(item)),
        }));
        // Pobierz kategorie
        this.categories = Object.keys(categories).map(key => ({ id: key, name: key }));
      }).catch(error => {
        console.error("Błąd podczas ładowania menu:", error);
      });
    },
    getImageUrl(name) {
      const normalizedName = this.normalizeString(name);
      const normalizedRestaurantName = this.normalizeString(this.restaurantName);
      const localServerUrl = 'http://localhost:8888'; 
      return `${localServerUrl}/images/${normalizedRestaurantName}/${normalizedName}.png`;
    },
    normalizeString(str) {
      return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
            .toLowerCase()
            .replace(/\s+/g, '-');
    },
    deleteItem(itemId) {
      if (confirm('Czy na pewno chcesz usunąć tę pozycję menu?')) {
        deleteMenuItem(itemId).then(() => {
          this.menuItems = this.menuItems.filter(item => item.id !== itemId);
          alert('Pozycja menu została usunięta');
        }).catch(error => {
          if (error.response && error.response.status === 409) { 
            alert('Nie można usunąć pozycji menu, ponieważ jest powiązana z zamówieniem.');
          } else {
            console.error("Błąd podczas usuwania pozycji menu:", error);
            alert('Wystąpił błąd podczas usuwania pozycji menu.');
          }
        });
      }
    },
    // Nowa metoda do znalezienia ID kategorii
    findCategoryId(categoryName) {
      const category = this.categories.find(c => c.name === categoryName);
      return category ? category.id : null;
    },
    openAddModal() {
      this.isAddModalVisible = true;
    },
    closeAddModal() {
      this.isAddModalVisible = false;
    },
  }
};
</script>
  
  <style scoped>
  .menu-management {
    padding: 20px;
  }
  
  .add-menu-item-btn {
    background-color: #4CAF50;
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
    background-color: #4CAF50; 
  }
  </style>