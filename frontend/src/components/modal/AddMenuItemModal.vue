<template>
  <div class="modal-overlay" v-show="isVisible">
    <div class="modal">
      <h3>Add Menu Item</h3>
      <form class="text-start" @submit.prevent="addNewItem">
        Nazwa pozycji
        <input type="text" v-model="newItem.name" placeholder="Nazwa pozycji" required>
        Cena
        <input type="text" v-model="newItem.price" @input="validatePrice" placeholder="Cena (np. 12.99)" required>
        Kategoria
        <select v-model="newItem.kategoria_id" required>
            <option disabled value="">Wybierz kategorię</option>
            <option v-for="category in localCategories" :value="category.id" :key="category.id">{{ category.name }}</option>
        </select>
        <label for="file-upload" class="custom-file-upload">
            {{ uploadedImageName || "Wybierz obrazek (JPG, PNG)" }}
        </label>
        <input id="file-upload" name="file-upload" type="file" @change="handleImageUpload" accept=".jpg, .jpeg, .png" required style="display: none;"/>
        <button type="submit">Add</button>
        <button type="button" @click="closeModal">Cancel</button>
      </form>
    </div>
  </div>
</template>

<script>
import { getCategories,addMenuItem } from '@/api/api';
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

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
          kategoria_id: null,
          restaurantId: localStorage.getItem('restaurant_id'), 
          image: null
        },
        localCategories: [],
        uploadedImageName: null,
    };
  },
  methods: {
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.newItem.image = file;
        this.uploadedImageName = file.name; 
      }
    },
    addNewItem() {
        const maxFileSize = 1.85 * 1024 * 1024;

        if (this.newItem.image && this.newItem.image.size > maxFileSize) {
          alert("Rozmiar obrazka musi być mniejszy niż 1.85MB zoptymalizuj swoje grafiki na stronie: https://tinypng.com/");
          return;
        }

        const itemData = {
          Nazwa_Pozycji: this.newItem.name,
          Cena: this.newItem.price.replace(',', '.'),
          kategoria_id: this.newItem.kategoria_id,
          ID_Restauracji: this.newItem.restaurantId, 
        };

        if (this.newItem.image) {
        addMenuItem(itemData, this.newItem.image)
            .then(response => {
              console.log(response);
              showSuccessMessage("Dodano pozycję Menu");
              this.closeModal();
              this.$emit('item-added');
            })
            .catch(error => {
              console.error("Błąd podczas dodawania pozycji menu:", error);
              if (error.response && error.response.status === 422 && error.response.data.error) {
                alert(error.response.data.error); 
              } else {
                showErrorMessage("Błąd, produkt nie został dodany do bazy, Prosimy spróbuj ponownie później");
              }
            });
        } else {
          alert('Obrazek jest wymagany');
        }
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

.custom-file-upload {
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  background-color: #fff;
  border: 1px solid #f44336;
  color:#f44336;
  border-radius: 4px;
  margin-bottom: 15px;
}

.custom-file-upload:hover {
  background-color: #d32f2f;
  color: #fff;
}
</style>