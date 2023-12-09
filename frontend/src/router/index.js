import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '@/views/HomePage.vue';
import RestaurantsPage from '@/views/RestaurantsPage.vue';
import AdminLogin from '@/views/admin/AdminLogin.vue';
import AdminPage from '@/views/AdminPage.vue';
import DashboardComponent from '@/components/admin/DashboardAdmin.vue';
import CategoryManagement from '@/components/admin/CategoryManagement.vue';
import MenuManagement from '@/components/admin/MenuManagement.vue';
import OrdersManagement from '@/components/admin/OrdersManagement.vue';
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
      { path: 'category-management', name: 'CategoryManagement', component: CategoryManagement },
      { path: 'menu-management', name: 'MenuManagement', component: MenuManagement },
      { path: 'orders-management', name: 'OrdersManagement', component: OrdersManagement },
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

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next({ name: to.meta.userType === 'admin' ? 'AdminLogin' : 'SuperAdminLogin' });
    } else if (to.meta.userType && to.meta.userType !== userType) {
      next(false); // Można przekierować na inną stronę błędu
    } else {
      next(); // Użytkownik jest zalogowany i ma odpowiednie uprawnienia
    }
  } else {
    next(); // Trasa nie wymaga autentykacji
  }
});

export default router;
