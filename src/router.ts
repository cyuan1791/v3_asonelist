import { createRouter, createWebHistory } from 'vue-router';
import States from './components/States.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: States
    },
  ],
  scrollBehavior() {
    return { top: 0 }; // Always scroll to top
  }
});

export default router;
