import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from "vue";

const Index = defineAsyncComponent(() => import ("./components/Index.vue"));


const routes = [
    {
        path: '/',
        component: Index
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
