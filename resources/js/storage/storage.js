import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    actions: {
        switchTab: (context, tabName) => context.commit('switchTab', tabName.target.id),
        callAllData({commit, dispatch}) {
            dispatch('getAllAudiences');
            dispatch('getAllDepartments');
            dispatch('getGroups');
            dispatch('getAllGroupParts');
            dispatch('getAllLessonOrders');
            dispatch('getAllPrepods');
            dispatch('getAllUsers');
            dispatch('getAllWeeks');
            dispatch('getRoles');
            dispatch('getSchedule');
        },
        sendRequest({commit, dispatch}, request) {
            const instance = axios.create({
                baseURL: '/api/'
            })
            instance.request({
                url: request.entity,
                method: request.method ?? 'get',
                data: request.data ?? {}
            }).then(response => {
                request.toDoArr.map(item => {
                    commit(item, response.data);
                })
                dispatch('showNotification', response.data);
            }).catch(error => {
                dispatch('showNotification', error.response.data);
            });
        }
    },
    mutations: {
        switchTab: (state, tabName) => state.currentTab = tabName,
        setLoading(state, type) {
            if (state.loading === type) {
                return false;
            }
            state.loading = !state.loading;
        }
    },
    state: {
        links: {
            simpleLinks: {
                User:'Пользователи'
            },
            dropdowns: {
                dropdown2: {
                    name: 'Группы и аудитории',
                    items: {
                        Groups:'Группы',
                        Counter:'Счетчик остатка часов',
                        Fundament: 'Основные'
                    }
                },
                dropdown1: {
                    name: 'Звонки и расписания',
                    items: {
                        Schedule:'Расписание звонков',
                        Booking:'Расписание занятий'
                    }
                },
                // dropdown3: {
                //     name: 'Преподаватели и старосты',
                //     items: {
                //         Prepod:'Преподаватели',
                //         Captain: 'Старосты'
                //     }
                // }
            }
        },
        currentTab: "Schedule",
        loading: false
    },
    getters: {
        getLinks: state => state.links,
        getCurrentTab: state => state.currentTab,
        getLoading: state => state.loading
    },
    modules: {

    }
});

const modules = require.context('./modules', true, /\.js$/i)
modules.keys().map(key => store.registerModule(key.split('/').pop().split('.')[0], modules(key).default))


export default store;
