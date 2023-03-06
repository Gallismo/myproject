import VueRouter from "vue-router";
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";

// Vue.use(BootstrapVue, {
//     BCalendar: { block: true }
// })
Vue.use(VueRouter);
const files = require.context('./components', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import index from "./views/index";
import admin from "./views/admin";
import login from './views/login';

const routes = [
    {
        path: '/',
        component: index
    },
    {
        path: '/admin',
        component: admin
    },
    {
        path: '/login',
        component: login
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;
