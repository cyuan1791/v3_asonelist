import { createRouter, createWebHistory } from 'vue-router';
import States from './components/States.vue';
import ShowList from './components/ShowList.vue';
import FindStateCity from './components/FindStateCity.vue';
import FAQ from './components/FAQ.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/Request', component: States},
    { path: '/', component: ShowList},
    { path:'/FAQ', component: FAQ},
    { path:'/FindStateCity',component: FindStateCity }
  ],
  scrollBehavior() {
    return { top: 0 }; // Always scroll to top
  }
});

export default router;
