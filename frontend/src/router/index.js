import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import RestaurantsPage from '@/views/RestaurantsPage.vue'
import AdminLogin from '@/views/admin/AdminLogin.vue'
import AdminPage from '@/views/AdminPage.vue'
import DashboardComponent from '@/components/admin/DashboardAdmin.vue'
import CategoryManagement from '@/components/admin/CategoryManagement.vue'
import MenuManagement from '@/components/admin/MenuManagement.vue'
import OrdersManagement from '@/components/admin/OrdersManagement.vue'

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
  },
  {
    path: '/admin/login',
    name: 'AdminLogin',
    component: AdminLogin,
    meta: { requiresAuth: false }
  },
  {
    path: '/admin',
    name: 'Admin',
    redirect: '/admin/dashboard', // Domyślne przekierowanie na dashboard
    component: AdminPage,
    meta: { requiresAuth: true },
    children: [
      { path: 'dashboard', name: 'Dashboard', component: DashboardComponent },
      { path: 'category-management', name: 'CategoryManagement', component: CategoryManagement },
      { path: 'menu-management', name: 'MenuManagement', component: MenuManagement },
      { path: 'orders-management', name: 'OrdersManagement', component: OrdersManagement },
      // ... inne trasy podrzędne
    ]
  },
  // Dodaj kolejne trasy w miarę potrzeb
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


router.beforeEach((to, from, next) => {
  // Tutaj dodaj logikę sprawdzającą, czy użytkownik jest zalogowany
  const isAuthenticated = true; // Przykładowa zmienna, zaktualizuj według własnej logiki

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      // Przekierowanie na stronę logowania
      next({ name: 'AdminLogin' });
    } else {
      next(); // Użytkownik jest zalogowany, przejdź do trasy
    }
  } else {
    next(); // Trasa nie wymaga autentykacji
  }
});

export default router
