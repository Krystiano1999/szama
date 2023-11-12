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
            <td><button>View</button></td>
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
          // Here you would fetch the actual order data
        ],
        currentSort: 'id',
        currentSortDir: 'asc',
      };
    },
    computed: {
      sortedOrders() {
        return this.orders.sort((a, b) => {
          let modifier = 1;
          if(this.currentSortDir === 'desc') modifier = -1;
          if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
          if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
          return 0;
        });
      }
    },
    methods: {
      sort(s) {
        // if we're already sorting by this column, reverse the direction
        if(s === this.currentSort) {
          this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
        }
        this.currentSort = s;
      }
    }
  };
  </script>
  
  <style>
  .orders-management table {
    /* Your styles here */
  }
  .orders-management th {
    cursor: pointer;
    /* Other styles for table headers */
  }
  /* Add additional styles as needed */
  </style>
  