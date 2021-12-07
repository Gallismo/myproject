import VueRouter from "vue-router";
import Vue from "vue";


Vue.use(VueRouter);

const files = require.context('./components', false, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import index from "./views/index";
import admin from "./views/admin";

const routes = [
    {
        path: '/',
        component: index
    },
    {
        path: '/admin',
        component: admin
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;
