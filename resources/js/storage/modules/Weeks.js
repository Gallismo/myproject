export default {
    actions: {
        getAllWeeks: function ({commit, dispatch}) {
            axios('/api/Week')
                .then(response => {
                    commit('getAllWeeks', response.data);
                    commit('currentWeekSet', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveWeek({commit, dispatch}, data) {
            // axios({
            // //     method: 'patch',
            // //     url: '/api/Week',
            // //     data: data
            // // })
            // //     .then(response => {
            // //         commit('updateWeek', data);
            // //         dispatch('showNotification', response.data);
            // //     })
            // //     .catch(error => {
            // //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Week',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateWeek'
                ]
            });
        },
        deleteWeek: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Week',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteWeek', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Week',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteWeek'
                ]
            });
        },
        createWeek: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Week',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllWeeks');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Week',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllWeeks'
                ]
            });
        },
        switchWeek({commit, dispatch}, code) {
            commit('switchWeek', code);
        }
    },
    mutations: {
        deleteWeek(state, data) {
            state.weeksData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.weeksData.splice(index, 1)
                }
            });
            state.currentWeek = state.weeksData[0]
        },
        getAllWeeks: (state, response) => {
            state.weeksData = response;
        },
        currentWeekSet: (state, response) => {
            state.currentWeek = response[0]
        },
        switchWeek(state, code) {
            state.currentWeek = state.weeksData.find(week => week.code === code);
        },
        updateWeek: (state, data) => {
            state.weeksData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.weeksData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        weeksData: [],
        currentWeek: {}
    },
    getters: {
        getWeeksData: state => {
            return state.weeksData
        },
        getWeekDropdown: state => {
            let DropdownProp = {};
            state.weeksData.map(week => DropdownProp[week.code] = week.name);
            return DropdownProp;
        },
        getCurrentWeek: state => {return state.currentWeek}
    }
}
