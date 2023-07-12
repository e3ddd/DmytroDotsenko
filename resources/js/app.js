import './bootstrap';
import {createApp} from 'vue';
import App from "./App.vue";
import AdminPanel from "./components/Administration/AdminPanel.vue";
import Login from "./components/Administration/Login.vue";

createApp(Login).mount('#login');

import router from './router.js';
import router_admin from './router-admin.js';

const app = createApp(App);
const admin = createApp(AdminPanel);

app.use(router);
admin.use(router_admin);

app.mount('#app');
admin.mount('#admin');

