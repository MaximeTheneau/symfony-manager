import VueRouter from 'vue-router'

// components
import BusinessList from './components/BusinessList.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/businesses',
            name: 'BusinessList',
            component: BusinessList
        },
        
    ]
})

export default router

Vue.use(VueRouter)
