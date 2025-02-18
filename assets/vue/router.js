import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Home from './vue/components/Home.vue';
import BusinessList from './vue/components/BusinessList.vue';
import NotFound from './vue/components/NotFound.vue';
import AppVue from './vue/App.vue';

// Configuration des routes
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/businesses',
        name: 'BusinessList',
        component: BusinessList
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});

const apps = createApp(AppVue);
apps.use(router);
apps.mount('#app');

export default router
