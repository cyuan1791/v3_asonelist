<template>
  <!-- use vue3 and bootstrap 4 to create a blogpost. The post data is read from a json file. The main page display the title, data, author, image, summary and a read more link to read the content
  -->

  <nav class="d-flex justify-content-center p-3 bg-light">
    <RouterLink class="px-2 m-1 border border-danger bg-dark text-white" to="/">Go to Home</RouterLink>
    <RouterLink class="px-2 m-1 border border-primary bg-dark text-white " to="/Request">Free list request
    </RouterLink>
    <RouterLink class="px-2 m-1 border border-primary bg-dark text-white" to="/FindStateCity">Find other city
      ToList
    </RouterLink>
  </nav>

  <router-view />
</template>
