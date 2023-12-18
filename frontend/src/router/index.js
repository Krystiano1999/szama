import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '@/views/HomePage.vue';
import RestaurantsPage from '@/views/RestaurantsPage.vue';
import AdminLogin from '@/views/admin/AdminLogin.vue';
import AdminPage from '@/views/AdminPage.vue';
import DashboardComponent from '@/components/admin/DashboardAdmin.vue';
import MenuManagement from '@/components/admin/MenuManagement.vue';
import OrdersManagement from '@/components/admin/OrdersManagement.vue';
import AccountManagement from '@/components/admin/AccountManagement.vue';
import RegisterRestaurant from '@/components/registration/RegisterRestaurant.vue';
import NewRestaurantManagement from '@/components/superadmin/NewRestaurantManagement.vue';
import RestaurantManagement from '@/components/superadmin/RestaurantManagement.vue';
import SuperAdminLogin from '@/views/superadmin/SuperAdminLogin.vue';
import SuperAdminPage from '@/views/SuperAdminPage.vue';

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
    path: '/register-restaurant',
    name: 'RegisterRestaurant',
    component: RegisterRestaurant
  },
  {
    path: '/admin/login',
    name: 'AdminLogin',
    component: AdminLogin,
    meta: { requiresAuth: false, userType: 'admin' }
  },
  {
    path: '/superadmin/login',
    name: 'SuperAdminLogin',
    component: SuperAdminLogin,
    meta: { requiresAuth: false, userType: 'superadmin' }
  },
  {
    path: '/admin',
    name: 'Admin',
    redirect: '/admin/dashboard',
    component: AdminPage,
    meta: { requiresAuth: true, userType: 'admin' },
    children: [
      { path: 'dashboard', name: 'Dashboard', component: DashboardComponent },
      { path: 'menu-management', name: 'MenuManagement', component: MenuManagement },
      { path: 'orders-management', name: 'OrdersManagement', component: OrdersManagement },
      { path: 'account-management', name: 'AccountManagement', component: AccountManagement },
    ]
  },
  {
    path: '/superadmin',
    name: 'SuperAdmin',
    redirect: '/superadmin/new-restaurant-management',
    component: SuperAdminPage,
    meta: { requiresAuth: true, userType: 'superadmin' },
    children: [
      { path: 'new-restaurant-management', name: 'NewRestaurantManagement', component: NewRestaurantManagement },
      { path: 'restaurant-management', name: 'RestaurantManagement', component: RestaurantManagement },
    ]
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  const userType = localStorage.getItem('userType');
  const isAuthenticated = token !== null;

  const numericUserType = parseInt(userType, 10);

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/'); // Brak autoryzacji
  } else if (to.meta.userType === 'admin' && numericUserType !== 1) {
    next('/'); // Przekierowanie, jeśli nie jest adminem
  } else if (to.meta.userType === 'superadmin' && numericUserType !== 2) {
    next('/'); // Przekierowanie, jeśli nie jest superadminem
  } else {
    next(); // Kontynuuj, jeśli wszystkie warunki są spełnione
  }
});







export default router;
