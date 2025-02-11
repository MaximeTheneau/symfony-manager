// assets/bootstrap.js
import { startStimulusApp } from '@symfony/stimulus-bridge';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// assets/app.js
import './bootstrap.js';
import './styles/app.css';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import AppVue from './vue/App.vue';
import Home from './vue/components/Home.vue';
import BusinessList from './vue/components/BusinessList.vue';
import NotFound from './vue/components/NotFound'

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

// Création du router
const router = createRouter({
    history: createWebHistory('/'),
    routes
});

// Création et configuration de l'application Vue
const apps = createApp(AppVue);
apps.use(router);
apps.mount('#app');