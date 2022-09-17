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
                data: request.data ?? {},
                params: request.params ?? {}
            }).then(response => {
                if (Array.isArray(request.toDoComm) && request.toDoComm.length !== 0) {
                    if (request.method && request.method === 'get') {
                        request.toDoComm.map(item => {
                            commit(item, response.data)
                        })
                    }
                    if (request.method && request.method !== 'get') {
                        request.toDoComm.map(item => {
                            commit(item, request.data)
                        })
                    }
                }
                if (Array.isArray(request.toDoDisp) && request.toDoDisp.length !== 0) {
                    request.toDoDisp.map(item => {
                        dispatch(item, response.data);
                    })
                }
                if (request.method && request.method !== 'get') {
                    dispatch('showNotification', response.data);
                }

                commit('setLoading')
            }).catch(error => {
                if (error.response.status !== 500) {
                    dispatch('showNotification', error.response.data);
                }

                if (error.response.status === 500) {
                    dispatch('showNotification', {
                        title: 'Серверная ошибка',
                        text: 'Произошла серверная ошибка, в случае повторения сообщите техническому специалисту',
                        errors: {},
                    });
                }
            });
        }
    },
    mutations: {
        switchTab: (state, tabName) => state.currentTab = tabName,
        setLoading(state, type = false) {
            if (state.loading === type) {
                return;
            }
            state.loading = type;
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
