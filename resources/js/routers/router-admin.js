import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from "vue";

const Catalog = defineAsyncComponent(() => import ("../components/Administration/Catalog/Catalog.vue"));
const CreatePainting = defineAsyncComponent(() => import ("../components/Administration/CreatePainting/CreatePainting.vue"));

const routes = [
    {
        path: '/admin/catalog',
        component: Catalog,
    },
    {
        path: '/admin/create',
        component: CreatePainting,
    },
    {
        path: '/admin/edit/:id',
        component: CreatePainting,
    },
];

const router_admin = createRouter({
    history: createWebHistory(),
    routes,
});

export default router_admin;
