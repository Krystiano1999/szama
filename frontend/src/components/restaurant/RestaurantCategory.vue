<template>
    <div class="col-md-1 restaurant-categories ps-0">
      <ul class="category-list">
        <li v-for="category in categories" :key="category"
            :class="{ active: activeCategory === category }"
            @click="selectCategory(category)">
          {{ category }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      restaurant: {
        type: Object,
        default: null
      },
      activeCategory: {
        type: String,
        default: ''
      }
    },
    computed: {
      categories() {
        if (this.restaurant && this.restaurant.menu) {
          return Object.keys(this.restaurant.menu);
        }
        return []; 
      }
    },
    methods: {
      selectCategory(category) {
        this.$emit('categorySelected', category);
      }
    }
  };
  </script>
  
  <style>

    ul.category-list {
        list-style-type: none;
        padding: 0;
    }

    .category-list li {
        padding: 5px;
        cursor: pointer;
        color: var(--color-light-cream);
        background-color: var(--color-orange); 
        transition: background-color 0.3s, color 0.2s;
        font-size:17px;
        border: 1px solid var(--color-dark-gray);
    }

    .category-list li:hover,
    .category-list li.active {
        background-color: var(--color-blue); 
        color: var(--color-light-cream); 
        font-weight: 600;
    }

    .category-list li:not(.active):hover {
        background-color: var(--color-orange);
        color: var(--color-light-cream);
    }

  </style>
  