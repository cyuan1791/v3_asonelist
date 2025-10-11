import { createRouter, createWebHistory } from 'vue-router';
import States from './components/States.vue';
import ShowList from './components/ShowList.vue';
import FindStateCity from './components/FindStateCity.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/Request',
      component: States
    },
    {
      path: '/',
      component: ShowList
    },
    {
      path:'/FindStateCity',
      component: FindStateCity
    }
  ],
  scrollBehavior() {
    return { top: 0 }; // Always scroll to top
  }
});

export default router;
