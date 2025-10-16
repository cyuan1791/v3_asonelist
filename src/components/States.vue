<template>
    <div class="state d-flex justify-content-center p-3 bg-light bg-opacity-10">
        <input type="text" v-model="search" placeholder=" Search a city" :value="search" />
    </div>
    <div v-if="search">
        <div class="state d-flex flex-wrap p-3 bg-info bg-opacity-10">
            <span v-for="st in state">
                <span v-for="city in stateCity[st].filter(c => c.toLowerCase().includes(search.toLowerCase()))"
                    class="p-1">
                    <a class="text-decoration-underline" @click="selectSearch(city, st)">
                        {{ city }} {{ st }}</a>
                </span>
            </span>
        </div>
        <div v-if="selectedState && selectedCity"
            class="state d-flex justify-content-center p-3 bg-danger text-white bg-gradient">
            <span> {{ selectedCity }}, {{ selectedState }}</span>
        </div>
        <ListRequest v-if="selectedState && selectedCity" :mystate="selectedState" :city="selectedCity" />

    </div>
    <div v-else>
        <div v-if="stage == 0" class="state d-flex flex-wrap p-3 bg-info bg-opacity-10">
            <span @click="selectState" class="p-1 border border-primary m-1" v-for="st in state">
                {{ st }}
            </span>
        </div>
        <div v-if="stage == 1" class="state d-flex justify-content-center p-3 bg-warning bg-opacity-10">
            <h5> Select City in {{ selectedState }} </h5>
        </div>
        <div v-if="stage == 1" class="state d-flex flex-wrap p-3 bg-warning bg-opacity-10">
            <span @click="selectCity" class="p-1 border border-primary m-1" v-for="city in stateCities">
                {{ city }}
            </span>
        </div>

        <ListRequest v-if="selectedState && selectedCity" :mystate="selectedState" :city="selectedCity" />
    </div>
</template>
<script setup>
import { computed, ref } from "vue";
import ListRequest from "./ListRequest.vue";
import stateCity from '@/data/usStateCities.json';

const search = ref("");
const selectedState = ref("");
const selectedCity = ref("");
const stateCities = ref(null);
const stage = ref(0);
const state = computed(() => {
    return Object.keys(stateCity).sort();
});

if ('asoneCity' in window) {
    search.value = window.asoneCity;
    selectedCity.value = window.asoneCity;
    selectedState.value = window.asoneState;
}


const selectState = (event) => {
    // @ts-ignore
    //console.log(event.target.innerHTML);
    selectedState
        .value = event.target.innerHTML;
    stage.value = 1;
    stateCities.value = stateCity[selectedState.value].sort()
}
const selectSearch = (city, st) => {
    selectedCity.value = city;
    selectedState.value = st;
}
const selectCity = (event) => {
    // @ts-ignore
    //console.log(event.target.innerHTML);
    selectedCity.value = event.target.innerHTML;
    stage.value = 2;
}

// get the latest from webscmsa: /home/cmsnow/ws/trunk/template/asonelist/json/createJson.py 
</script>
