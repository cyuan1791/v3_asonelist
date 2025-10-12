<template>
  <!-- use vue3 and bootstrap 4 to create a blogpost. The post data is read from a json file. The main page display the title, data, author, image, summary and a read more link to read the content
  -->

  <nav class="d-flex justify-content-center p-3 bg-light">
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border  text-primary"
      to="/">My listing
    </RouterLink>
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border  text-primary "
      to="/Request">
      Free listing request
    </RouterLink>
    <RouterLink active-class="bg-success bg-opacity-50 border-danger rounded" class="px-3 m-1 border   text-primary"
      to="/FindStateCity">Find
      other city's
      listing
    </RouterLink>
  </nav>

  <router-view />
</template>
