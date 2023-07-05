import './bootstrap';

import {createApp} from 'vue';

import Test from "./Test.vue";

import Index from "./components/Index.vue";
import Login from "./components/Administration/Login.vue";
import AdminPanel from "./components/Administration/AdminPanel.vue";

createApp(Test).mount('#test');
createApp(Index).mount('#index');
createApp(Login).mount('#admin-login')
createApp(AdminPanel).mount('#admin-panel')
