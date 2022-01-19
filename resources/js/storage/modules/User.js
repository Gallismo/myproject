export default {
    actions: {
        getAllUsers: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            axios.get('/api/User', {
                params: {
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
        switchUser({commit, dispatch}, login) {
            commit('switchUser', login);
        },
        getRoles({commit, dispatch}) {
            axios('/api/Roles')
                .then(response => {
                    commit('setRoles', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
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
        switchUser(state, login) {
            state.currentUser = state.userData.find(user => user.login === login);
        },
        updateUser: (state, data) => {
            state.userData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.role_name ? state.userData[index].role.name = data.role_name : false;
                }
            });
        },
        setRoles(state, data) {
            state.rolesData = data;
        }
    },
    state: {
        userData: [],
        currentUser: {},
        rolesData: {}
    },
    getters: {
        getUserData: state => {
            return state.userData
        },
        getUserDropdown: state => {
            let DropdownProp = {};
            state.userData.map(user => DropdownProp[user.id] = user.login);
            return DropdownProp;
        },
        getRolesData: state => {return state.rolesData},
        getCurrentUser: state => {return state.currentUser}
    }
}
