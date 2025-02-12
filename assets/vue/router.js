import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import BusinessList from './components/BusinessList.vue';
import NotFound from './components/NotFound.vue';
import AppVue from './App.vue';

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
    history: createWebHistory(),
    routes
});

const app = createApp(AppVue);
app.use(router);
app.mount('#app');

export default router;
