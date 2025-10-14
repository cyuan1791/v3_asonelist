<template>
    <div class="state d-flex justify-content-center p-3 bg-light bg-opacity-10">
        <span class="px-4 py-2">{{ selectedCity }} {{ selectedState }}</span> <span class="btn btn-success"
            @click="startOver">
            Select a state</span>
    </div>
    <div v-if="stage == 0" class="state d-flex flex-wrap p-3 bg-info bg-opacity-10">
        <span @click="selectState" class="p-1 border border-primary m-1" v-for="st in state">
            {{ st }}
        </span>
    </div>
    <div v-if="stage == 1" class="state d-flex justify-content-center p-3 bg-warning bg-opacity-10">
        <h5> {{ stateName[selectedState] }} state website listing</h5>
    </div>
    <div v-if="stage == 1" class="state d-flex flex-wrap p-3 bg-warning bg-opacity-10">
        <span class="p-1" v-for="city in stateCities">
            <a :href="'https://' + mycity(city) + '-' + selectedState + '.asonelist.com'" target=_blank_>
                {{ mycity(city) }}</a>
        </span>
    </div>
</template>
<script setup>
import { computed, ref } from "vue";
import stateCity from '@/data/usStateCities.json';


const selectedState = ref("");
const selectedCity = ref("");
const stateCities = ref(null);
const stage = ref(0);
const state = computed(() => {
    return Object.keys(stateCity).sort();
});



function mycity(city) {
    return city.replace(' ', '').replace("'", '').replace('.', '-');
}

const selectState = (event) => {
    // @ts-ignore
    //console.log(event.target.innerHTML);
    selectedState
        .value = event.target.innerHTML;
    stage.value = 1;
    stateCities.value = stateCity[selectedState.value].sort()
}


const startOver = (event) => {
    stage.value = 0;
    selectedState.value = "";
    selectedCity.value = "";
}
const stateName = {
    "AK": "Alaska",
    "AL": "Alabama",
    "AR": "Arkansas",
    "AZ": "Arizona",
    "CA": "California",
    "CO": "Colorado",
    "CT": "Connecticut",
    "DC": "District of Columbia",
    "DE": "Delaware",
    "FL": "Florida",
    "GA": "Georgia",
    "HI": "Hawaii",
    "IA": "Iowa",
    "ID": "Idaho",
    "IL": "Illinois",
    "IN": "Indiana",
    "KS": "Kansas",
    "KY": "Kentucky",
    "LA": "Louisiana",
    "MA": "Massachusetts",
    "MD": "Maryland",
    "ME": "Maine",
    "MI": "Michigan",
    "MN": "Minnesota",
    "MO": "Missouri",
    "MS": "Mississippi",
    "MT": "Montana",
    "NC": "North Carolina",
    "ND": "North Dakota",
    "NE": "Nebraska",
    "NH": "New Hampshire",
    "NJ": "New Jersey",
    "NM": "New Mexico",
    "NV": "Nevada",
    "NY": "New York",
    "OH": "Ohio",
    "OK": "Oklahoma",
    "OR": "Oregon",
    "PA": "Pennsylvania",
    "RI": "Rhode Island",
    "SC": "South Carolina",
    "SD": "South Dakota",
    "TN": "Tennessee",
    "TX": "Texas",
    "UT": "Utah",
    "VA": "Virginia",
    "VT": "Vermont",
    "WA": "Washington",
    "WI": "Wisconsin",
    "WV": "West Virginia",
    "WY": "Wyoming",
}
// get the latest from webscmsa: /home/cmsnow/ws/trunk/template/asonelist/json/createJson.py 
</script>
