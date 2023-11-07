import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import RestaurantsPage from '@/views/RestaurantsPage.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomePage
  },
  {
    path: '/restaurants',
    name: 'Restaurants',
    component: RestaurantsPage
  }
  // Dodaj kolejne trasy w miarę potrzeb
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
