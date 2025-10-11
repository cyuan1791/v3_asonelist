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
    stateCities.value = stateCity[selectedState
        .value]
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
const stateCity = {
    'AK': [],
    'AL': [],
    'AR': [],
    'AS': [],
    'AZ': [],
    'CA': ['Los Angeles', 'San Diego', 'San Jose', 'San Francisco', 'Fresno', 'Sacramento', 'Long Beach', 'Oakland'
        , 'Bakersfield', 'Anaheim', 'Stockton', 'Riverside', 'Irvine', 'Santa Ana', 'Chula Vista', 'Santa Clarita', 'Fremont'
        , 'San Bernardino', 'Modesto', 'Fontana', 'Moreno Valley', 'Oxnard', 'Huntington Beach', 'Glendale', 'Ontario', 'Elk Grove'
        , 'Santa Rosa', 'Rancho Cucamonga', 'Garden Grove', 'Oceanside', 'Lancaster', 'Roseville', 'Palmdale', 'Corona', 'Salinas'
        , 'Hayward', 'Sunnyvale', 'Escondido', 'Pomona', 'Visalia', 'Victorville', 'Fullerton', 'Torrance', 'Orange', 'Pasadena'
        , 'Santa Clara', 'Clovis', 'Simi Valley', 'Thousand Oaks', 'Concord', 'Vallejo', 'Fairfield', 'Berkeley', 'Antioch'
        , 'Menifee', 'Richmond', 'East Los Angeles', 'Carlsbad', 'Murrieta', 'Temecula', 'Santa Maria', 'San Buenaventura (Ventura)'
        , 'Downey', 'Costa Mesa', 'Jurupa Valley', 'West Covina', 'Rialto', 'El Monte', 'Vacaville', 'Burbank city', 'El Cajon'
        , 'San Mateo', 'Chico', 'Inglewood', 'Hesperia', 'Daly City', 'Tracy', 'Vista', 'Norwalk', 'San Marcos', 'Arden-Arcade'
        , 'Merced', 'Manteca', 'Indio', 'Chino', 'Redding', 'Hemet', 'Mission Viejo', 'Carson', 'Compton', 'South Gate', 'Santa Monica'
        , 'Westminster', 'Folsom', 'Mountain View city', 'Santa Barbara', 'Lake Forest', 'Citrus Heights', 'San Leandro', 'San Ramon'
        , 'Whittier', 'Livermore', 'Rancho Cordova', 'Hawthorne', 'Perris', 'Redwood City', 'Newport Beach', 'Buena Park', 'Alhambra'
        , 'Milpitas', 'Upland', 'Tustin', 'Alameda', 'Lakewood', 'Carmichael', 'Chino Hills', 'Pittsburg', 'Napa', 'Bellflower'
        , 'Pleasanton', 'Rocklin', 'Apple Valley', 'Redlands', 'Lake Elsinore', 'Turlock', 'Tulare', 'Walnut Creek', 'Eastvale'
        , 'Dublin', 'Camarillo', 'Baldwin Park', 'Yuba City', 'Madera', 'Lodi', 'Redondo Beach', 'Palo Alto', 'Davis', 'Yorba Linda'
        , 'Brentwood', 'Union City', 'Castro Valley', 'South San Francisco', 'Laguna Niguel', 'Lynwood', 'Porterville', 'Woodland'
        , 'San Clemente', 'Santa Cruz', 'Florence-Graham', 'La Habra', 'Encinitas', 'La Mesa', 'Montebello', 'Hanford', 'Gilroy'
        , 'San Rafael', 'Beaumont', 'Petaluma', 'Pico Rivera', 'Santee', 'Gardena', 'Cupertino', 'National City', 'Monterey Park'
        , 'Highland', 'Lincoln', 'Fountain Valley', 'West Sacramento', 'San Jacinto', 'South Whittier', 'Hacienda Heights', 'Arcadia'
        , 'Yucaipa', 'Colton', 'Placentia', 'Delano', 'Palm Desert', 'Cathedral City', 'Novato', 'Diamond Bar', 'Huntington Park'
        , 'Watsonville', 'Paramount', 'El Dorado Hills', 'Aliso Viejo', 'Glendora', 'San Luis Obispo', 'Rosemead', 'Florin', 'Poway'
        , 'Cypress', 'Ceres', 'Covina', 'Antelope', 'Los Banos', 'Azusa', 'North Highlands', 'Brea', 'Oakley', 'Cerritos'],
    'CO': [],
    'CT': [],
    'DC': [],
    'DE': [],
    'FL': [],
    'FM': [],
    'GA': [],
    'GU': [],
    'HI': [],
    'IA': [],
    'ID': [],
    'IL': [],
    'IN': [],
    'KS': [],
    'KY': [],
    'LA': [],
    'MA': [],
    'MD': [],
    'ME': [],
    'MH': [],
    'MI': [],
    'MN': [],
    'MO': [],
    'MP': [],
    'MS': [],
    'MT': [],
    'NC': [],
    'ND': [],
    'NE': [],
    'NH': [],
    'NJ': [],
    'NM': [],
    'NV': [],
    'NY': [],
    'OH': [],
    'OK': [],
    'OR': [],
    'PA': [],
    'PR': [],
    'PW': [],
    'RI': [],
    'SC': [],
    'SD': [],
    'TN': [],
    'TX': [],
    'UT': [],
    'VA': [],
    'VI': [],
    'VT': [],
    'WA': [],
    'WI': [],
    'WV': [],
    'WY': []
}
</script>
