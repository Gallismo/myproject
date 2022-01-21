export default {
    actions: {
        getAllCaptains: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            axios.get('/api/Captain', {
                params: {
                    name: query.name,
                    user: query.user,
                    group_name: query.group_name
                }
            })
                .then(response => {
                    commit('getAllCaptains', response.data);
                    commit('currentCaptainSet', response.data);
                    commit('setLoading', false);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveCaptain({commit, dispatch}, data) {
            axios({
                method: 'patch',
                url: '/api/Captain',
                data: data
            })
                .then(response => {
                    commit('updateCaptain', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        deleteCaptain: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/Captain',
                data: data
            })
                .then(response => {
                    commit('deleteCaptain', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createCaptain: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/Captain',
                data: data
            })
                .then(response => {
                    dispatch('getAllCaptains');
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchCaptain({commit, dispatch}, code) {
            commit('switchCaptain', code);
        }
    },
    mutations: {
        deleteCaptain(state, data) {
            state.captainData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.captainData.splice(index, 1)
                }
            });
            state.currentCaptain = state.captainData[0]
        },
        getAllCaptains: (state, response) => {
            state.captainData = response;
        },
        currentCaptainSet: (state, response) => {
            state.currentCaptain = response[0]
        },
        switchCaptain(state, code) {
            state.currentCaptain = state.captainData.find(captain => captain.code === code);
        },
        updateCaptain: (state, data) => {
            state.captainData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.captainData[index].name = data.name : false;
                    data.user_id ? state.captainData[index].user_id = data.user_id : false;
                    data.user_name ? state.captainData[index].user_name = data.user_name : false;
                    data.group_id ? state.captainData[index].group_id = data.group_id : false;
                    data.group_name ? state.captainData[index].group_name = data.group_name : false;
                }
            });
        },
    },
    state: {
        captainData: [],
        currentCaptain: {}
    },
    getters: {
        getCaptainData: state => {
            return state.captainData
        },
        getCaptainDropdown: state => {
            let DropdownProp = {};
            state.captainData.map(captain => DropdownProp[captain.code] = captain.name);
            return DropdownProp;
        },
        getCurrentCaptain: state => {return state.currentCaptain}
    }
}
