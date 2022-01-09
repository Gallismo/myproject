export default {
    actions: {
        getAllLessonOrders: function ({commit, dispatch}) {
            axios('/api/lessonsOrder')
                .then(response => {
                    commit('getAllLessonOrders', response.data);
                    commit('currentLessonOrderSet', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveLessonOrder({commit, dispatch}, data) {
            axios({
                method: 'patch',
                url: '/api/lessonsOrder',
                data: data
            })
                .then(response => {
                    commit('updateLessonOrder', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        deleteLessonOrder: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/lessonsOrder',
                data: data
            })
                .then(response => {
                    commit('deleteLessonOrder', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createLessonOrder: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/lessonsOrder',
                data: data
            })
                .then(response => {
                    dispatch('getAllLessonOrders');
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchLessonOrder({commit, dispatch}, code) {
            commit('switchLessonOrder', code);
        }
    },
    mutations: {
        deleteLessonOrder(state, data) {
            state.lessonOrdersData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.lessonOrdersData.splice(index, 1)
                }
            });
            state.currentLessonOrder = state.lessonOrdersData[0]
        },
        getAllLessonOrders: (state, response) => {
            state.lessonOrdersData = response;
        },
        currentLessonOrderSet: (state, response) => {
            state.currentLessonOrder = response[0]
        },
        switchLessonOrder(state, code) {
            state.currentLessonOrder = state.lessonOrdersData.find(lessonOrder => lessonOrder.code === code);
        },
        updateLessonOrder: (state, data) => {
            state.lessonOrdersData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.lessonOrdersData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        lessonOrdersData: [],
        currentLessonOrder: {}
    },
    getters: {
        getLessonOrdersData: state => {
            return state.lessonOrdersData
        },
        getLessonOrderDropdown: state => {
            let DropdownProp = {};
            state.lessonOrdersData.map(lessonOrder => DropdownProp[lessonOrder.code] = lessonOrder.name);
            return DropdownProp;
        },
        getCurrentLessonOrder: state => {return state.currentLessonOrder}
    }
}
