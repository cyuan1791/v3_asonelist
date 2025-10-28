<template>
  <!-- use vue3 and bootstrap 4 to create a blogpost. The post data is read from a json file. The main page display the title, data, author, image, summary and a read more link to read the content
  -->

  <template v-if="city && state">

    <div class="d-flex justify-content-center  bg-light">
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 border border-2 text-center border-info text-primary" to="/">Local Listing
      </RouterLink>


      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 border border-2 border-info text-center  text-primary " to="/Request">
        Free Listing
      </RouterLink>
    </div>
    <div class="d-flex justify-content-center bg-light">
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 border border-2 border-info text-center  text-primary" to="/FindStateCity">Other's Listing
      </RouterLink>
      <a v-if="myWebsite" :href="myWebsite" target="_blank"
        class="px-3 m-1 border border-2 border-info text-center  text-primary">
        My Agency</a>
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 border border-2 border-info text-center text-primary" to="/FAQ">FAQ
      </RouterLink>
    </div>
  </template>
  <div v-else>
    <FindStateCity />
  </div>

  <router-view />
</template>
<script setup>
import { computed, ref } from 'vue';
import FindStateCity from './components/FindStateCity.vue';

const city = ref('');
const state = ref('');
if ('asoneCity' in window) {
  city.value = window.asoneCity;
}
if ('asoneState' in window) {
  state.value = window.asoneState;
}
const myWebsite = computed(() => {
  if (state.value === 'CA') {
    return `https://${city.value.toLowerCase()}-${state.value}.webasone-ca.com`;
  } else if (state.value) {
    return `https://${city.value.toLowerCase()}-${state.value}.webasone-us.com`;
  } else {
    return '';
  }
})

</script>