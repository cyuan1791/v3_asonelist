<template>
    <div class="state d-flex justify-content-center p-3 bg-dark text-light bg-opacity-75">
        <div>
            <label class="px-2">Select Website Type:</label>
            <label>
                <input type="radio" v-model="websiteType" value="shopping" @change="handleChange" /> Shopping website
            </label>,
            <label>
                <input type="radio" v-model="websiteType" value="nonshopping" @change="handleChange" /> Non shopping
                website
            </label>
        </div>
    </div>
    <div v-if="websiteType" class="state d-flex justify-content-center p-3 bg-secondary text-light bg-opacity-75">
        <span> Select a category for the website </span>
    </div>
    <div v-if="websiteType == 'shopping'" class="state d-flex flex-wrap p-3 bg-warning bg-opacity-10">
        <span @click="selectCat" class="p-1 border border-primary m-1" v-for="cat in shoppingCategory">
            {{ cat }}
        </span>
    </div>
    <div v-if="websiteType == 'nonshopping'" class="state d-flex flex-wrap p-3 bg-warning bg-opacity-10">
        <span @click="selectCat" class="p-1 border border-primary m-1" v-for="cat in websiteCategory">
            {{ cat }}
        </span>
    </div>
    <div v-if="processMessage" class="state d-flex justify-content-center p-3 bg-success bg-opacity-10">
        <div class="alert alert-danger">
            <div v-html="processMessage">

            </div>
        </div>
    </div>

    <div v-if="processingRequest" class="state d-flex justify-content-center p-3 bg-info bg-opacity-10">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Processing...</span>
        </div>
        <span class="px-2"> Processing your request...</span>
    </div>
    <div v-else class="state d-flex justify-content-center p-3 bg-success bg-opacity-10">


        <div v-if="selectedCategory && city && mystate" class="row w-7">
            <form class="col-12">
                <h3 class="text-center"> {{ city }} {{ mystate }} : {{ selectedCategory }}</h3>

                <div class="mb-3">
                    <label for="website" class="form-label">&nbsp;&nbsp;Website</label>
                    <input type="text" class="form-control" placeholder="https://... " id="website" value="" required>

                </div>
                <div class="mb-3">
                    <label for="websiet description" class="form-label">&nbsp;&nbsp;Descripiton of the website. Must
                        between 25 to
                        60 words.</label>
                    <textarea class="form-control" id="desc" rows="5"></textarea>
                </div>

                <div class="alert alert-danger">
                    <p> You are submitting a request to add your website to {{ city }}, {{ mystate }} listing.</p>
                    <p> Make sure the website you are submitting is live. It will listed after a quick review.</p>
                    <p> Note: Only one category per website. You are welcome to resubmit the same website. The previous
                        entry
                        will be replaced.</p>
                </div>
                <button @click.prevent="submitRequest(city, mystate, selectedCategory, websiteType, $event)"
                    class="btn btn-info w-100"> Submit
                    Request</button>
            </form>
        </div>
    </div>


</template>

<script setup>
//import { state } from '@/data/States';
//import { state } from '@/data/States';
import { ref } from 'vue';

defineProps({
    mystate: {
        type: String,
        required: true,
    },
    city: {
        type: String,
        required: true,
    },
})

const selectedCategory = ref("");
const websiteIsAlive = ref(false);
const processMessage = ref("");
const processingRequest = ref(false);

const selectCat = (event) => {
    // @ts-ignore
    //console.log(event.target.innerHTML);
    selectedCategory.value = event.target.innerHTML;
}
const websiteType = ref('');

const handleChange = (event) => {
    //console.log('Radio button changed:', event.target.value);
    websiteType.value = event.target.value;
    // Perform other actions based on the new selection
};

async function checkWebsiteReachability(url) {
    try {
        const response = await fetch(url, { method: 'HEAD', mode: 'no-cors' });
        // If the request completes without error, it implies reachability.
        // 'no-cors' mode prevents cross-origin issues and only checks if the server responds.
        //console.log(response)
        websiteIsAlive.value = true;
        return true;
    } catch (error) {
        // An error likely indicates the website is unreachable or there's a network issue.
        console.error("Website unreachable:", error);
        return false;
    }
}
function countWords(str) {
    // 1. Trim leading/trailing whitespace to avoid empty strings at the ends.
    const trimmedStr = str.trim();

    // 2. Handle empty strings: if the string is empty after trimming, it has 0 words.
    if (trimmedStr === "") {
        return 0;
    }

    // 3. Split the string by one or more whitespace characters.
    //    The regular expression /\s+/ matches one or more whitespace characters (spaces, tabs, newlines).
    const words = trimmedStr.split(/\s+/);

    // 4. Return the length of the resulting array, which represents the word count.
    return words.length;
}
async function processRequest(url, desc, city, mystate, category, websiteType) {
    const fmdata = {
        url: url.replace(/\/$/, "").replace(/\/$/, "").replace(/\/$/, ""),
        desc: desc,
        city: city.replace(' ', '').replace("'", '').replace('.', '-').replace(' ', '').replace("'", ''),
        state: mystate,
        category: category,
        websiteType: websiteType
    }
    //console.log('fm', fmdata)
    try {
        const response = await fetch(window.asoneArea + '/ws/php/processRequest.php', {
            method: 'POST',
            body: JSON.stringify(fmdata),
        });
        const text = await response.text(); // Parse it as text
        const data = JSON.parse(text); // Try to parse it as JSON
        // The response was a JSON object
        // Do your JSON handling here
        console.log('success json responace', data)
        processingRequest.value = false;
        processMessage.value
            = "<p> You have successfully submit your request. Once it passes review, it will be listed." +
            "<p> Only one category per website. You are welcome to resubmit the same website. " +
            " The previous entry will be replaced.</p>";
    } catch (err) {
        console.error(err.message)
        // The response wasn't a JSON object
        // Do your text handling here
    }
}

const submitRequest = (city, mystate, category, websiteType, event) => {
    console.log('submit request');
    processingRequest.value = true;
    const url = document.getElementById('website').value.trim();
    const desc = document.getElementById('desc').value;
    const wordCount = countWords(desc);

    //console.log('url:', url);

    /* setTimeout(() => {
        //console.log('clear message');
        processMessage.value = '';
    }, 4000); */
    processMessage.value = ''
    if (wordCount < 24 || wordCount > 61) {
        processMessage.value = "<p> The number of words in the description must be between 25 to 60 words. " + wordCount;
        //console.log(processMessage.value)
        return
    }
    //console.log('sub', url.substring(0, 7))
    if (url.substring(0, 8) != 'https://') {
        processMessage.value += "<p> Please enter correct website url. Must started with https://</p>";
        return
    }



    checkWebsiteReachability(url);


    //console.log('desc word', countWords(desc))
    setTimeout(() => {
        // make sure the website is accessable before process the request
        //console.log('timeout', websiteIsAlive.value);
        if (websiteIsAlive.value) {
            processRequest(url, desc, city, mystate, category, websiteType)
        } else {
            processMessage.value += `<p> ${url} is not a live website. Please enter website starting with https://`
        }

    }, 2000);

}


const shoppingCategory = ['Apparel', 'Coffee', 'Fashion', 'Fine Art', 'Food', 'Gifts', 'Health and Wellness', 'Sports', 'Pets', 'Misc'];

// update this need to update v3_list:ShowList.vue

const websiteCategory = ['Activities', 'Business Help', 'Cleaning Services', 'Coffee', 'Counseling', 'Digital Agency',
    'Education', 'Farms Ranch', 'Gifts', 'Health Wellness', 'Jobs Related', 'Local Interests', 'Media', 'Medical', 'Misc',
    'Mortgage', 'Music', 'Night Life', 'Parks and Trails', 'Photography', 'Property Management', 'Real Estate', 'Solar', 'Sports',
    'Sports Rental', 'Tourism', 'Tree Services',
]
</script>
