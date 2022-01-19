export default {
    actions: {
        getAllUsers: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            axios.get('/api/User', {
                params: {
                    name: query.name,
                    login: query.login,
                    role: query.role
                }
            })
                .then(response => {
                    commit('getAllUsers', response.data);
                    commit('currentUserSet', response.data);
                    commit('setLoading', false);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveUser({commit, dispatch}, data) {
            axios({
                method: 'patch',
                url: '/api/User',
                data: data
            })
                .then(response => {
                    commit('updateUser', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        deleteUser: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/User',
                data: data
            })
                .then(response => {
                    commit('deleteUser', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createUser: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/User',
                data: data
            })
                .then(response => {
                    dispatch('getAllUsers');
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchUser({commit, dispatch}, code) {
            commit('switchUser', code);
        }
    },
    mutations: {
        deleteUser(state, data) {
            state.userData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.userData.splice(index, 1)
                }
            });
            state.currentUser = state.userData[0]
        },
        getAllUsers: (state, response) => {
            state.userData = response;
        },
        currentUserSet: (state, response) => {
            state.currentUser = response[0]
        },
        switchUser(state, code) {
            state.currentUser = state.userData.find(user => user.code === code);
        },
        updateUser: (state, data) => {
            state.userData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.userData[index].name = data.name : false;
                    data.surname ? state.userData[index].surname = data.surname : false;
                    data.middle_name ? state.userData[index].middle_name = data.middle_name : false;
                }
            });
        },
    },
    state: {
        userData: [],
        currentUser: {}
    },
    getters: {
        getUserData: state => {
            return state.userData
        },
        getUserDropdown: state => {
            let DropdownProp = {};
            state.userData.map(user => DropdownProp[user.code] = user.login);
            return DropdownProp;
        },
        getCurrentUser: state => {return state.currentUser}
    }
}
