import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const storage = new Vuex.Store({
    actions: {},
    mutations: {},
    state: {},
    getters: {},
    modules: {}
});

const modules = require.context('./modules', true, /\.js$/i)
modules.keys().map(key => storage.registerModule(key.split('/').pop().split('.')[0], modules(key).default))


export default storage;
