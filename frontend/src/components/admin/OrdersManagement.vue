<template>
    <div class="orders-management">
      <h1>Order history</h1>
      <table>
        <thead>
          <tr>
            <th @click="sort('id')">ID</th>
            <th @click="sort('payRef')">PayRef</th>
            <th @click="sort('amount')">Amount</th>
            <th @click="sort('status')">Status</th>
            <th @click="sort('dateDelivered')">Date delivered</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in sortedOrders" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.payRef }}</td>
            <td>{{ order.amount }}</td>
            <td>{{ order.status }}</td>
            <td>{{ order.dateDelivered }}</td>
            <td><button @click="changeStatus(order)">Change Status</button></td>
          </tr>
        </tbody>
      </table>
    </div>
</template>

  
  <script>
  export default {
    name: 'OrdersManagement',
    data() {
      return {
        orders: [
          { id: '#1', payRef: 'b55qZFeRkB', amount: '9500.00', status: 'pending', dateDelivered: '2023-11-12' },
          { id: '#2', payRef: 'FzqUoaJhlu', amount: '10400.00', status: 'pending', dateDelivered: '2023-11-12' },
          // ... inne zamówienia
        ],
        currentSort: 'id',
        currentSortDir: 'asc',
        statuses: ['pending', 'processing', 'shipped'], // Statusy zamówień
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
    methods: {
      sort() {
        // ... logika sortowania (bez zmian)
      },
      changeStatus(order) {
        const currentIndex = this.statuses.indexOf(order.status);
        const nextIndex = (currentIndex + 1) % this.statuses.length;
        order.status = this.statuses[nextIndex];
      },
    },
  };

  </script>
  
  <style>

 .orders-management {
  max-width: 800px;
  margin: auto;
}

.orders-management h1 {
  font-size: 24px;
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
  