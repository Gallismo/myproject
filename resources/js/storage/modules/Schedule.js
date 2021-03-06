export default {
    actions: {
        getSchedule: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            axios.get('/api/Schedule', {
                params: {
                    week_day: query.week_filter,
                    department: query.dep_filter,
                    lesson: query.les_filter
                }
            })
                .then(response => {
                    commit('setSchedules', response.data);
                    commit('currentScheduleSet', response.data);
                    commit('setLoading', false);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveSchedule({commit, dispatch}, data) {
            axios({
                method: 'patch',
                url: '/api/Schedule',
                data: data
            })
                .then(response => {
                    commit('updateSchedule', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        deleteSchedule: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/Schedule',
                data: data
            })
                .then(response => {
                    commit('deleteSchedule', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createSchedule: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/Schedule',
                data: data
            })
                .then(response => {
                    dispatch('getSchedule');
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchSchedule({commit, dispatch}, code) {
            commit('switchSchedule', code);
        }
    },
    mutations: {
        deleteSchedule(state, data) {
            state.scheduleData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.scheduleData.splice(index, 1)
                }
            });
            state.currentSchedule = state.scheduleData[0]
        },
        setSchedules: (state, response) => {
            state.scheduleData = response;
        },
        currentScheduleSet: (state, response) => {
            state.currentSchedule = response[0]
        },
        switchSchedule(state, code) {
            state.currentSchedule = state.scheduleData.find(schedule => schedule.code === code);
        },
        updateSchedule: (state, data) => {
            state.scheduleData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.start_time ? state.scheduleData[index].start_time = data.start_time : false;
                    data.end_time ? state.scheduleData[index].end_time = data.end_time : false;
                    data.break ? state.scheduleData[index].break = data.break : false;
                }
            });
        }
    },
    state: {
        scheduleData: [],
        currentSchedule: {},
    },
    getters: {
        getScheduleData: state => {
            return state.scheduleData
        },
        getScheduleDropdown: state => {
            let DropdownProp = {};
            state.scheduleData.map(schedule => DropdownProp[schedule.code] = schedule.code);
            return DropdownProp;
        },
        getCurrentSchedule: state => {return state.currentSchedule},

    }
}
