<template>
  <!-- use vue3 and bootstrap 4 to create a blogpost. The post data is read from a json file. The main page display the title, data, author, image, summary and a read more link to read the content
  -->

  <template v-if="city && state">

    <div class="d-flex justify-content-center pt-2 bg-light">
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 py-1 border border-2 text-center border-info text-primary rounded" to="/">
        {{ capitalizeFirstLetter(city) }} {{ state }} List
      </RouterLink>


      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded text-primary"
        class="px-3 m-1 py-1 border border-2 border-info text-center rounded" to="/Request">
        List Request
      </RouterLink>
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 py-1 border border-2 border-info text-center text-primary rounded" to="/FAQ">FAQ
      </RouterLink>
    </div>
    <div class="d-flex justify-content-center pb-2 bg-light">
      <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded"
        class="px-3 m-1 py-1 border border-2 border-info text-center  text-primary rounded" to="/FindStateCity">Other's
        List
      </RouterLink>
      <a v-if="myWebsite" :href="myWebsite" target="_blank"
        class="px-3 m-1 py-1 border border-2 border-info text-center rounded text-primary">
        Agency</a>
      <a v-if="communityWebsite" :href="communityWebsite" target="_blank"
        class="px-3 m-1 py-1 border border-2 border-info text-center rounded text-primary">
        Community</a>
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
function myurl(city, state, domain) {
  return 'https://' + city.replace(' ', '').replace("'", '').replace(' ', '').replace("'", '').replace('.', '-') + '-' + state + '.' + domain;
}
const myWebsite = computed(() => {
  if (state.value === 'CA') {
    return myurl(city.value, state.value, 'webasone-ca.com');
    //return `https://${city.value.toLowerCase()}-${state.value}.webasone-ca.com`;
  } else if (state.value) {
    return myurl(city.value, state.value, 'webasone-us.com');
    //return `https://${city.value.toLowerCase()}-${state.value}.webasone-us.com`;
  } else {
    return '';
  }
})
const communityWebsite = computed(() => {
    return myurl(city.value, state.value, 'citywebasone.com');
})

function capitalizeFirstLetter(str) {
  if (!str) { // Handle empty or null strings
    return str;
  }
  return str.charAt(0).toUpperCase() + str.slice(1);
}

</script>