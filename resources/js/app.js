import './bootstrap';

import {createApp} from 'vue';

import App from "./App.vue";

import AdminPanel from "./components/Backend/AdminPanel.vue";

import Login from "./components/Backend/Login.vue";

createApp(Login).mount('#login');

import router from './routers/router.js';
import router_admin from './routers/router-admin.js';
import vuex from "./vuex/vuex.js";

const app = createApp(App);
const admin = createApp(AdminPanel);

app.use(router);
admin.use(router_admin);

app.use(vuex);
admin.use(vuex);

app.mount('#app');
admin.mount('#admin');

