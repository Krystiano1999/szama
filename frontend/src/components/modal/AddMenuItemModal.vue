<template>
  <div class="modal-overlay" v-show="isVisible">
    <div class="modal">
      <h3>Add Menu Item</h3>
      <form @submit.prevent="addNewItem">
        <input type="text" v-model="newItem.name" placeholder="Name" required>
        <input type="text" v-model="newItem.price" @input="validatePrice" placeholder="Price" required>
        <select v-model="newItem.kategoria_id" required>
            <option v-for="category in localCategories" :value="category.id" :key="category.id">{{ category.name }}</option>
        </select>
        <input type="file" @change="handleImageUpload" />
        <button type="submit">Add</button>
        <button type="button" @click="closeModal">Cancel</button>
      </form>
    </div>
  </div>
</template>

<script>
import { getCategories } from '@/api/api';
export default {
  props: {
    categories: Array, 
    isVisible: Boolean
  },
  data() {
    return {
      newItem: {
        name: '',
        price: 0,
        kategoria_id: null
      },
      localCategories: [] 
    };
  },
  methods: {
    addNewItem() {
        const menuItemData = {
            Nazwa_Pozycji: this.newItem.name,
            Cena: this.newItem.price.replace(',', '.'),
            kategoria_id: this.newItem.kategoria_id,
            ID_Restauracji: this.restaurantId
        };

        this.$emit('add-item', menuItemData);
        this.newItem = { name: '', price: 0, kategoria_id: null };
    },
    closeModal() {
      this.$emit('close-modal');
    },
    validatePrice() {
        const matched = this.newItem.price.match(/^[0-9]*\.?[0-9]{0,2}/);
        this.newItem.price = matched ? matched[0] : '';
    },
  },
  created() {
    getCategories().then(response => {
        this.localCategories = response.data; 
    });
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999;
  transition: opacity 0.3s ease;
}


.modal {
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
  max-width: 600px;
  width: auto;
  max-height: 500px;
  height:auto;
  transition: transform 0.3s ease, opacity 0.3s ease;
  transform: translateY(-20px);
  opacity: 1;
  display:block;
  position:relative;
}

.modal h3 {
  color: #333;
  margin-bottom: 20px;
}

.modal form {
  display: flex;
  flex-direction: column;
}

.modal form input[type="text"],
.modal form input[type="number"],
.modal form select {
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.modal form button {
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.modal form button[type="submit"] {
  background-color: #4CAF50;
  color: white;
}

.modal form button[type="button"] {
  background-color: #f44336;
  color: white;
}

.modal form button:hover {
  opacity: 0.9;
}
</style>