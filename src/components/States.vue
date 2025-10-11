<template>
    <div class="state d-flex justify-content-center p-3 bg-light bg-opacity-10">
        <span class="px-4 py-2">{{ selectedCity }} {{ selectedState }}</span> <span class="btn btn-success"
            @click="startOver">
            startOver</span>
    </div>
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

    <ListRequest :mystate="selectedState" :city="selectedCity" />
</template>
<script setup>
import { ref } from "vue";
import { state } from '@/data/States.js';
import ListRequest from "./ListRequest.vue";
import stateCity from '@/data/usStateCities.json';


const selectedState = ref("");
const selectedCity = ref("");
const stateCities = ref(null);
const stage = ref(0);



const selectState = (event) => {
    // @ts-ignore
    console.log(event.target.innerHTML);
    selectedState
        .value = event.target.innerHTML;
    stage.value = 1;
    stateCities.value = stateCity[selectedState.value].sort()
}
const selectCity = (event) => {
    // @ts-ignore
    console.log(event.target.innerHTML);
    selectedCity.value = event.target.innerHTML;
    stage.value = 2;
}

const startOver = (event) => {
    stage.value = 0;
    selectedState.value = "";
    selectedCity.value = "";
}
// get the latest from webscmsa: /home/cmsnow/ws/trunk/template/asonelist/json/createJson.py 
</script>
