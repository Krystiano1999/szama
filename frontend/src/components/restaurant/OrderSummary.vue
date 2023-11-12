<template>
  <div class="order-summary col-md-2 pe-md-0">
    <h3 class="fs-4">Podsumowanie zamówienia</h3>
    <transition-group name="list" tag="ul">
      <li v-for="(item, index) in groupedOrderItems" :key="index">
        {{ item.name }} - {{ item.quantity }}x - {{ formatCurrency(item.totalPrice) }}
        <button class="remove-item btn-close" aria-label="Close" @click="removeItem(item)"></button>
      </li>
    </transition-group>
    <div class="total-price">
      Łączna suma: {{ formatCurrency(totalPrice) }}
    </div>
    <button class="order-button">Zamów</button>
  </div>
</template>

<script>
export default {
  props: {
    orderItems: {
      type: Array,
      default: () => []
    },
  },
  computed: {
    groupedOrderItems() {
      const grouped = {};
      this.orderItems.forEach(item => {
        if (!grouped[item.name]) {
          grouped[item.name] = { ...item, quantity: 0, totalPrice: 0 };
        }
        grouped[item.name].quantity += item.quantity || 1;
        grouped[item.name].totalPrice += item.price * (item.quantity || 1);
      });
      return Object.values(grouped);
    },
    totalPrice() {
      return this.groupedOrderItems.reduce((acc, item) => acc + item.totalPrice, 0);
    },
  },
  methods: {
    formatCurrency(value) {
      const numberFormat = new Intl.NumberFormat('pl-PL', { style: 'currency', currency: 'PLN' });
      return numberFormat.format(value); 
    },
    removeItem(itemToRemove) {
      // Metoda do usuwania elementu zamówienia, emituje zdarzenie z nazwą usuwanego elementu
      this.$emit('removeItem', itemToRemove);
    },
  }
};
</script>

<style scoped>
.order-summary h3 {
  background-color: var(--color-orange);
  color: var(--color-light-cream);
  padding: 10px;
}

.order-summary ul {
  list-style-type: none;
  padding: 0;
}

.order-summary li {
  padding: 5px 0;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.order-summary li .remove-item {
  cursor: pointer;
  border: none;
  background-color: transparent;
  color: red;
  font-size: 1.2rem;
  line-height: 1;
}

.order-summary .total-price {
  font-weight: bold;
  margin-top: 10px;
}
.order-summary .order-button {
  background-color: var(--color-blue);
  color: var(--color-light-cream); 
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
  font-size: 1rem;
}

.order-summary .order-button:hover {
  background-color: var(--color-dark-gray); 
}
</style>
