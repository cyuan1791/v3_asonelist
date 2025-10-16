<script setup>
import { ref, onMounted, onUnmounted } from 'vue';


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


const windowWidth = ref(window.innerWidth);

const handleResize = () => {
    windowWidth.value = window.innerWidth;
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});

import { computed } from 'vue';

const isMobile = computed(() => windowWidth.value <= 768); // Example breakpoint
const isDesktop = computed(() => windowWidth.value > 768);
function selectCat(requestData, event) {
    //console.log(event.target.getAttribute(('myCat')));
    const cat = event.target.getAttribute(('myCat'));
    const website = event.target.getAttribute(('website'));


    selectCategory.value = requestData[website]['category'][cat];
}

function mover(event) {
    //console.log(event.target.getAttribute(('myURL')));
    selectURL.value = event.target.getAttribute(('myURL'));
    showPopup.value = true;
}

const toggleList = (item, event) => {
    const element = document.getElementById(item);
    if (element.style.display === 'none') {
        element.style.display = 'block'; // Or 'flex', 'grid', etc., depending on the desired display type
    } else {
        element.style.display = 'none';
    }
};
</script>

<template>
    <!-- Your component's template -->
    <div v-if="city">
        <div class="p-1 bg- d-flex justify-content-center">
            <h5>Find local, buy from local, support local business!</h5>
        </div>
        <div class="state d-flex justify-content-center  p-1">
            <h5 v-if="websiteType == 'shopping'"> {{ city }} {{ mystate }}, local shopping website</h5>
            <h5 v-else> {{ city }} {{ mystate }}, local non shopping website</h5>

        </div>
        <div v-if="isDesktop">
            <div class="d-flex justify-content-center p-1" v-if="requestData">
                <div>
                    <span class="btn btn-info btn-sm  text-white m-1" :myCat="item" :website="websiteType"
                        @click="selectCat(requestData, $event)" v-for="item in shoppingCategory" :key="item">
                        {{ item }} ({{ Object.keys(requestData[websiteType]['category'][item]).length }})
                    </span>
                </div>
            </div>
        </div>
        <div v-else>
            <!-- tab and mobile view -->
            <div class="d-flex justify-content-center p-1" v-if="requestData">
                <div>
                    <div class="p-2 bg-info text-white" :myCat="item" :website="websiteType"
                        v-for="item in shoppingCategory" :key="item">
                        <span @click="toggleList(item, $event)" class="btn btn-warning w-100"> {{ item }} ({{
                            Object.keys(requestData[websiteType]['category'][item]).length }})</span>
                        <div :id="item" style="display: none;">
                            <a class="btn btn-success btn-sm" :href="item.url" :myURL="item.url" target="_blank"
                                v-for="item in selectCategory" :key="item">
                                {{ item.url.replace('https://', '').replace('http://', '').replace('/',
                                    '').replace('www.', '') }}
                            </a>
                            <div class="p-3 border rounded border-light">
                                <div v-for="list in requestData[websiteType]['category'][item]" :key="list">
                                    <a class="btn btn-secondary w-100" :href="list['url']" target="_blank"> {{
                                        list['url']
                                        }}</a>
                                    <div class="p-2">
                                        <div class="p-2">{{ list['desc'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="isDesktop">
        <div v-if="selectCategory.length !== 0" class="p-1 bg-light d-flex justify-content-center"
            style="max-height: 300px;overflow: scroll;">
            <div>
                <a class="btn btn-success btn-sm m-1" :href="item.url" :myURL="item.url" target="_blank"
                    v-for="item in selectCategory" :key="item" @mouseover="mover" @mouseleave="showPopup = false">
                    {{ item.url.replace('https://', '').replace('http://', '').replace('/', '').replace('www.', '')
                    }}
                </a>
            </div>
        </div>
        <div class="p-3 bg-light d-flex justify-content-center" style="min-height: 200px;">

            <div v-if="showPopup" class="popup">
                <div style="display: block; max-width: 350px;">
                    {{ selectCategory[selectURL]['desc'] }}
                </div>
            </div>
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
    max-width: 350px;
    /* Prevent content from wrapping */
    z-index: 10;
    /* Ensure popup is above other elements */
}
</style>