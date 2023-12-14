<template>
  <div class="orders-management pt-5">
    <h1>Zarządzanie zamówieniami</h1>
    <table>
      <thead>
        <tr>
          <th @click="sort('ID_Zamowienia')">ID Zamówienia</th>
          <th>Status</th>
          <th>Data Utworzenia</th>
          <th>Szczegóły Zamówienia</th>
          <th>Całkowita Cena</th>
          <th>Akcja</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in sortedOrders" :key="order.ID_Zamowienia">
          <td>{{ order.ID_Zamowienia }}</td>
          <td>{{ order.Status_Zamowienia }}</td>
          <td>{{ formatDate(order.created_at) }}</td>
          <td>
            <ul>
              <li v-for="detail in order.szczegoly" :key="detail.ID_Szczegolu">
                {{ detail.menu.Nazwa_Pozycji }} - Ilość: {{ detail.Ilosc }}, Cena: {{ detail.Cena }} zł
              </li>
            </ul>
          </td>
          <td>{{ order.Cena }} zł</td>
          <td>
            <button 
              @click="changeStatus(order)" 
              :disabled="order.Status_Zamowienia === 'Zrealizowane'">
              Zmień Status Zamówienia
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
import { getOrdersByRestaurant, updateOrderStatus } from '@/api/api';

export default {
  name: 'OrdersManagement',
  data() {
    return {
      orders: [],
      currentSort: 'id',
      currentSortDir: 'asc',
      statuses: ['Nowe', 'W trakcie', 'Wysłane', 'Zrealizowane'],
    };
  },
  computed: {
    sortedOrders() {
      return this.orders.slice().sort((a, b) => {
        let modifier = 1;
        if (this.currentSortDir === 'desc') modifier = -1;
        if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      });
    },
  },
  created() {
    const restaurantId = localStorage.getItem('restaurant_id');
    if (restaurantId) {
      this.fetchOrders(restaurantId);
    }
  },
  methods: {
    async changeStatus(order) {
      const currentIndex = this.statuses.indexOf(order.Status_Zamowienia);
      const nextIndex = (currentIndex + 1) % this.statuses.length;
      const newStatus = this.statuses[nextIndex];
      order.Status_Zamowienia = newStatus;

      if(newStatus !== 'Nowe') {
        try {
          await updateOrderStatus(order.ID_Zamowienia, { newStatus });
        } catch (error) {
          console.error('Error updating order status:', error);
        }
      }
    },
    formatDate(date) {
      if (!date) return '';
      return new Date(date).toLocaleDateString('pl-PL');
    },
    sort(sortKey) {
      if(this.currentSort === sortKey) {
        this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
      } else {
        this.currentSort = sortKey;
        this.currentSortDir = 'asc';
      }
      this.sortedOrders();
    },
    async fetchOrders(restaurantId) {
      try {
        const response = await getOrdersByRestaurant(restaurantId);
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders:', error);
      }
    },
  },
};
</script>

<style>
.orders-management {
  margin: auto;
}

.orders-management h1 {
  color: #333;
  padding-bottom: 16px;
}

.orders-management table {
  width: 100%;
  border-collapse: collapse;
}

.orders-management th, .orders-management td {
  text-align: left;
  padding: 12px;
  border-bottom: 1px solid #ccc;
}

.orders-management th {
  background-color: #f9f9f9;
  cursor: pointer;
}

.orders-management button {
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 8px 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.orders-management button:hover {
  background-color: #2980b9;
}
</style>
