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
    },
    search: {
        type: String,
        required: false,
    },
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

const isDesktop = computed(() => windowWidth.value > 768);
function selectCat(requestData, event) {
    //console.log(event.target.getAttribute(('myCat')));
    const cat = event.target.getAttribute(('myCat'));
    const website = event.target.getAttribute(('website'));


    selectCategory.value = requestData[website]['category'][cat];
}

function mover(websiteType, requestData, event) {
    //console.log(event.target.getAttribute(('myURL')));
    selectURL.value = event.target.getAttribute(('myURL'));
    const cat = event.target.getAttribute(('myCat'));
    selectCategory.value = requestData[websiteType]['category'][cat];

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

    <template v-if="!isDesktop">
        <div class="p-1 bg-light d-flex justify-content-center" v-if="search">
            <div>
                <div v-for:="(value, cat) in requestData[websiteType]['category']" :key="cat">
                    <div v-for="item in value" :key="item">
                        <div class="border rounded p-2 text-primary"
                            v-if="item.desc.toLowerCase().includes(search.toLowerCase())">
                            <a class="btn btn-success btn-sm m-1" :href="item.url" :myURL="item.url" :myCat="cat"
                                target="_blank">
                                {{ item.url.replace('https://', '').replace('http://', '').replace('/',
                                    '').replace('www.',
                                        '').slice(0, 30)
                                }}
                            </a>
                            <div>{{ item.desc }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>


    <template v-if="isDesktop">
        <div class="p-1 bg-light d-flex flex-wrap" v-if="search">

            <template v-for:="(value, cat) in requestData[websiteType]['category']" :key="cat">
                <div v-for="item in value" :key="item">
                    <div v-if="item.desc.toLowerCase().includes(search.toLowerCase())">
                        <a class="btn btn-success btn-sm m-1" :href="item.url" :myURL="item.url" :myCat="cat"
                            target="_blank" @mouseover.prevent="mover(websiteType, requestData, $event)"
                            @mouseleave.prevent="showPopup = false">
                            {{ item.url.replace('https://', '').replace('http://', '').replace('/',
                                '').replace('www.',
                                    '').slice(0, 30)
                            }}
                        </a>
                    </div>
                </div>
            </template>

        </div>
        <div class="p-3 bg-light d-flex justify-content-centerfl" style="min-height: 200px;">

            <div v-if="showPopup" class="popup">
                <div style="display: block; max-width: 680px;">
                    {{ selectCategory[selectURL]["desc"] }}
                </div>
            </div>
        </div>
    </template>


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
    max-width: 700px;
    /* Prevent content from wrapping */
    z-index: 10;
    /* Ensure popup is above other elements */
}
</style>