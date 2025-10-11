import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App);
app.use(router);
app.mount('#'+window.asoneId)

//createApp(App).use(router).mount('#'+window.asoneId)
