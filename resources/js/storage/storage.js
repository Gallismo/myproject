import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    actions: {
        switchTab: (context, tabName) => context.commit('switchTab', tabName.target.id)
    },
    mutations: {
        switchTab: (state, tabName) => state.currentTab = tabName
    },
    state: {
        links: {
            simpleLinks: {
                Prepod:'Преподаватели',
                User:'Пользователи'
            },
            dropdowns: {
                dropdown2: {
                    name: 'Группы и аудитории',
                    items: {
                        Groups:'Группы',
                        Counter:'Счетчик остатка часов',
                        Subjects:'Предметы',
                        Audiences:'Аудитории',
                        Department:'Отделения'
                    }
                },
                dropdown1: {
                    name: 'Звонки и расписания',
                    items: {
                        Schedule:'Расписание звонков',
                        Booking:'Расписание занятий'
                    }
                }
            }
        },
        currentTab: "Groups"
    },
    getters: {
        getLinks: state => state.links,
        getCurrentTab: state => state.currentTab
    },
    modules: {}
});

const modules = require.context('./modules', true, /\.js$/i)
modules.keys().map(key => store.registerModule(key.split('/').pop().split('.')[0], modules(key).default))


export default store;
