import { createApp } from "vue";
import ViewUIPlus from 'view-ui-plus'
import App from "./App.vue";
import router from "./router";
import store from "./store";
// import Swiper from "swiper/bundle";
import 'view-ui-plus/dist/styles/viewuiplus.css'


import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";

import 'swiper/css/bundle';

createApp(App).use(store).use(router).use(ViewUIPlus).mount("#app");
