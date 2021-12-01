import VueRouter from "vue-router";
import Vue from "vue";


Vue.use(VueRouter);

import ExampleComponent from "./components/ExampleComponent";
import ExampleComponent2 from "./components/ExampleComponent2";
import ExampleComponent3 from "./components/ExampleComponent3";


const routes = [
    {
        path: '/',
        component: ExampleComponent
    },
    {
        path: '/admin/second',
        component: ExampleComponent2
    },
    {
        path: '/admin',
        component: ExampleComponent3,
        meta: {
            requiresAuth: true
        }
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;
