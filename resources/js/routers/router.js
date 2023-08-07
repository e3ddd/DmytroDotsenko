import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from "vue";


const Index = defineAsyncComponent(() => import ("../components/Frontend/Index.vue"));
const Admin = defineAsyncComponent(() => import("../components/Backend/AdminPanel.vue"));
const Login = defineAsyncComponent(() => import("../components/Backend/Login.vue"));
const Categories = defineAsyncComponent(() => import ("../components/Backend/Categories/Categories.vue"));
const Catalog = defineAsyncComponent(() => import ("../components/Backend/Catalog/Catalog.vue"));
const CreatePainting = defineAsyncComponent(() => import ("../components/Backend/CreatePainting/CreatePainting.vue"));
const UpdatePainting = defineAsyncComponent(() => import("../components/Backend/CreatePainting/UpdatePainting.vue"));
const PaintingPage = defineAsyncComponent(() => import("../components/Frontend/Body/PaintingPage.vue"));
const Body = defineAsyncComponent(() => import("../components/Frontend/Body/Body.vue"));


const routes = [
    {
        path: '/index',
        component: Index,
        name: 'index',
        children: [
            {
                path: '/',
                name: 'body',
                component: Body
            },
            {
                path: '/:painting_slug',
                component: PaintingPage
            },
            {
                path: '/:category_slug',
                name: 'category',
                component: Body,
            },
            {
                path: '/:category_slug/:subcategory_slug',
                name: 'subcategory',
                component: Body
            },
        ]
    },

    {
        path: '/admin/login',
        name: 'login',
        component: Login
    },
    {
        path: '/admin',
        component: Admin,
        children: [
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
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if(to.name === 'index'){
        return { name: 'body' }
    }
})

export default router;
