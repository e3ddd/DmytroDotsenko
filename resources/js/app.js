import './bootstrap';

import {createApp} from 'vue';


import App from "./App.vue";
import VueSocialSharing from 'vue-social-sharing'

import router from './routers/router.js';
import vuex from "./vuex/vuex.js";

const app = createApp(App);

app.use(router);
app.use(vuex);
app.use(VueSocialSharing);


app.mount('#app');

