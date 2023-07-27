import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// import the package
import VueAwesomePaginate from "vue-awesome-paginate";

// import the necessary css file
import "vue-awesome-paginate/dist/style.css";

// Register the package
createApp(App).use(VueAwesomePaginate).mount("#app");

const app = createApp(App)

app.use(router)

app.mount('#app')


