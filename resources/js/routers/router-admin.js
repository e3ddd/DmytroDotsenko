import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from "vue";

const Categories = defineAsyncComponent(() => import ("../components/Backend/Categories/Categories.vue"));
const Catalog = defineAsyncComponent(() => import ("../components/Backend/Catalog/Catalog.vue"));
const CreatePainting = defineAsyncComponent(() => import ("../components/Backend/CreatePainting/CreatePainting.vue"));
const UpdatePainting = defineAsyncComponent(() => import("../components/Backend/CreatePainting/UpdatePainting.vue"))

const routes = [
    {
        path: '/admin/categories',
        component: Categories,
    },
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
        component: UpdatePainting,
    },
];

const router_admin = createRouter({
    history: createWebHistory(),
    routes,
});

export default router_admin;
