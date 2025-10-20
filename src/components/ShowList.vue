<script setup>
import { onMounted, ref } from 'vue';
import ToList from './ToList.vue';
import SearchList from './SearchList.vue';

// Define reactive state or other logic here
const requestData = ref(null);
const state = ref("");
const city = ref("");
const selectShoppingWebsite = ref(true)
const search = ref("");

if ('asoneState' in window) {
    state.value = window.asoneState;
}
if ('asoneCity' in window) {
    city.value = window.asoneCity
}


onMounted(() => {
    async function processRequest() {

        try {
            let startURL = "";
            const vite_api_url = import.meta.env.VITE_API_URL
            if (typeof vite_api_url !== 'undefined') {
                // this is development environment
                startURL = vite_api_url;
            } else {
                // production environment
                startURL = window.asoneArea + '/';
            }
            const response = await fetch(startURL + 'ws/php/getList.php', {
                method: 'POST',
                body: JSON.stringify({
                    state: state.value,
                    city: city.value.replace(' ', '').replace("'", '').replace('.', '-').replace(' ', '').replace("'", ''),
                    shoppingCategory: shoppingCategory,
                    websiteCategory: websiteCategory

                })
            });
            const text = await response.text(); // Parse it as text
            const data = JSON.parse(text); // Try to parse it as JSON
            // The response was a JSON object
            // Do your JSON handling here
            requestData.value = data;
            //console.log(data)
        } catch (err) {
            console.error(err.message)
            // The response wasn't a JSON object
            // Do your text handling here
        }
    }
    processRequest();
});

// update this need to update v3_list:ListRequest.vue
const shoppingCategory = ['Apparel', 'Coffee', 'Fashion', 'Fine Art', 'Flowers', 'Food', 'Gifts', 'Health and Wellness', 'Sports', 'Pets', 'Misc'];

const websiteCategory = ['Activities', 'Business Help', 'Cleaning Services', 'Coffee', 'Counseling', 'Digital Agency',
    'Education', 'Farms Ranch', 'Gifts', 'Health Wellness', 'Jobs Related', 'Local Interests', 'Media', 'Medical', 'Misc',
    'Mortgage', 'Music', 'Night Life', 'Parks and Trails', 'Photography', 'Property Management', 'Real Estate', 'Solar', 'Sports',
    'Sports Rental', 'Tourism', 'Tree Services',
];


</script>

<template>
    <div class="p-1 bg- d-flex justify-content-center">
        <div>
            <h5>Find local, buy from local</h5>
            <h5>Support local business!</h5>
            <h5>Find local e-commerce website</h5>
        </div>
    </div>
    <div v-if="city" class="p-1 bg- d-flex justify-content-center">

        <div>
            <div v-if="selectShoppingWebsite">
                <span @click="selectShoppingWebsite = !selectShoppingWebsite" class="btn btn-danger text-white"> Switch
                    to non shopping website
                </span> &nbsp;&nbsp;<input class="px-2" type="text" v-model="search"
                    placeholder="Seach shopping website" />
            </div>
            <div v-else>
                <span @click="selectShoppingWebsite = !selectShoppingWebsite" class="btn btn-danger text-white"> Switch
                    to shopping website </span>&nbsp;&nbsp; <input class="px-2" type="text" v-model="search"
                    placeholder="Seach non-shopping website" />
            </div>
        </div>
    </div>

    <template v-if="search">
        <SearchList v-if="selectShoppingWebsite" :city="city" :mystate="state" :websiteType="'shopping'"
            :requestData="requestData" :shoppingCategory="shoppingCategory" :search />
        <SearchList v-else :city="city" :mystate="state" :websiteType="'nonshopping'" :requestData="requestData"
            :shoppingCategory="websiteCategory" :search />
    </template>
    <template v-else>
        <ToList v-if="selectShoppingWebsite" :city="city" :mystate="state" :websiteType="'shopping'"
            :requestData="requestData" :shoppingCategory="shoppingCategory" :search />
        <ToList v-else :city="city" :mystate="state" :websiteType="'nonshopping'" :requestData="requestData"
            :shoppingCategory="websiteCategory" :search />
    </template>

</template>