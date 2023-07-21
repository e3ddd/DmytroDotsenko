import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from "vue";

const Index = defineAsyncComponent(() => import ("../components/Frontend/Index.vue"));
// const CategoryPage = defineAsyncComponent(() => import(''))

const routes = [
    {
        path: '/',
        component: Index,
    },

    // {
    //     path: `/:category`,
    //     component: CategoryPage,
    // }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
