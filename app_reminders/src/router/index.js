import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/create-account',
      name: 'create-user',
      component: () => import('../views/CreateUserView.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/AboutView.vue'),
      meta: {requiresAuth: true}
    },
    {
      path: '/reminders',
      name: 'reminder',
      component: () => import('../views/ReminderView.vue'),
      meta: {requiresAuth: true}
    },
  ]
})

router.beforeEach((to, from, next) => {
if (to.matched.some((record) => record.meta.requiresAuth)) {
if (!localStorage.getItem('token')) {
next({ path: '/' });
 } else {
next();
  }
} else {
 next();
}
});
export default router
