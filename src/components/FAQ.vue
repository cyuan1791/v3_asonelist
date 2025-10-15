<script setup>
import { ref } from 'vue';

// Define reactive state or other logic here
const state = ref("");
const city = ref("");


if ('asoneState' in window) {
    state.value = window.asoneState;
}
if ('asoneCity' in window) {
    city.value = window.asoneCity
}





</script>

<template>
    <div class="state d-flex justify-content-center p-3 bg-warning bg-opacity-10">
        <div class="p-3">
            <h4 class="p-2"> Frequently Asked Questions (FAQ) : {{ city }} {{ state }}</h4>
            <ul class="list-group">
                <li class="list-group-item">Only real local websites will be listed. We will review each listing
                    requests.
                </li>
                <li class="list-group-item">Only one entry per website. Resubmit the same website will replace the
                    existing</li>
                <li class="list-group-item">Non active websites will be removed.</li>
                <li class="list-group-item">US cities with more than 30000 are listed.</li>
                <li class="list-group-item">Questions? info@webasone.com</li>

            </ul>
        </div>
    </div>
</template>