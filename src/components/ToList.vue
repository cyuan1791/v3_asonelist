<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    mystate: {
        type: String,
        required: true,
    },
    city: {
        type: String,
        required: true,
    },
    websiteType: {
        type: String,
        required: true
    },
    requestData: {
        type: Array,
        required: true,
    },
    shoppingCategory: {
        type: Array,
        required: true,
    }
})

// Define reactive state or other logic here

const selectCategory = ref([]);
const showPopup = ref(false);
const selectURL = ref("");



function selectCat(requestData, event) {
    console.log(event.target.getAttribute(('myCat')));
    const cat = event.target.getAttribute(('myCat'));
    const website = event.target.getAttribute(('website'));


    selectCategory.value = requestData[website]['category'][cat];
}

function mover(event) {
    console.log(event.target.getAttribute(('myURL')));
    selectURL.value = event.target.getAttribute(('myURL'));
    showPopup.value = true;
}
</script>

<template>
    <!-- Your component's template -->
    <div class="p-1 bg- d-flex justify-content-center">

        <h5 v-if="websiteType == 'shopping'"> {{ city }} {{ mystate }} Local shopping website</h5>
        <h5 v-else> {{ city }} {{ mystate }} Local non shopping website</h5>

    </div>
    <div class="d-flex justify-content-center p-1" v-if="requestData">
        <div>
            <span class="btn btn-info btn-sm  m-1" :myCat="item" :website="websiteType"
                @click="selectCat(requestData, $event)" v-for="item in shoppingCategory" :key="item">
                {{ item }} ({{ Object.keys(requestData[websiteType]['category'][item]).length }})
            </span>
        </div>
    </div>

    <div v-if="selectCategory.length !== 0" class="p-1 bg-light d-flex justify-content-center"
        style="max-height: 300px;overflow: scroll;">
        <div>
            <a class="btn btn-success btn-sm m-1" :href="item.url" :myURL="item.url" target="_blank"
                v-for="item in selectCategory" :key="item" @mouseover="mover" @mouseleave="showPopup = false">
                {{ item.url }}
            </a>
        </div>
    </div>
    <div class="p-3 bg-light d-flex justify-content-center" style="min-height: 400px;">

        <div v-if="showPopup" class="popup">
            <pre>
            {{ selectCategory[selectURL]['desc'] }} </pre>
        </div>
    </div>

</template>

<style scoped>
.hover-area {
    position: relative;
    display: inline-block;
    /* Or block, depending on your layout */
    padding: 10px;
    border: 1px solid #ccc;
}

.popup {
    position: relative;
    /* Position below the hover-area */
    background-color: #333;
    color: white;
    padding: 10px;
    border-radius: 5px;
    white-space: nowrap;
    /* Prevent content from wrapping */
    z-index: 10;
    /* Ensure popup is above other elements */
}
</style>