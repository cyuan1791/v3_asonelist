<template>
  <!-- use vue3 and bootstrap 4 to create a blogpost. The post data is read from a json file. The main page display the title, data, author, image, summary and a read more link to read the content
  -->

  <div v-if="city" class="d-flex justify-content-center p-3 bg-light">
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border  text-primary"
      to="/">Local listing
    </RouterLink>
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border  text-primary "
      to="/Request">
      Free listing
    </RouterLink>
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border   text-primary"
      to="/FindStateCity">Other's
      listing
    </RouterLink>
  </div>
  <div v-else>
    <FindStateCity />
  </div>

  <router-view />
</template>
<script setup>
import { ref } from 'vue';
import FindStateCity from './components/FindStateCity.vue';

const city = ref('');
if ('asoneCity' in window) {
  city.value = window.asoneCity;
}


</script>