export default {
    actions: {
        getAllUsers: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            // axios.get('/api/User', {
            //     params: {
            //         login: query.login,
            //         role: query.role,
            //         group: query.group,
            //         name: query.name
            //     }
            // })
            //     .then(response => {
            //         commit('getAllUsers', response.data);
            //         commit('currentUserSet', response.data);
            //         commit('setLoading', false);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'User',
                method: 'get',
                params: {
                    login: query.login,
                    role: query.role,
                    group: query.group,
                    name: query.name
                },
                toDoComm:[
                    'getAllUsers',
                    'currentUserSet',
                    'setLoading'
                ]
            });
            commit('setLoading', false);
        },
        saveUser({commit, dispatch}, data) {
            // axios({
            //     method: 'patch',
            //     url: '/api/User',
            //     data: data
            // })
            //     .then(response => {
            //         commit('updateUser', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'User',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateUser'
                ]
            });
        },
        changePassword({commit, dispatch}, data) {
            // axios({
            //     method: 'post',
            //     url: '/api/User/changePassword',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'changePassword',
                method: 'post',
                data: data,

            });
        },
        deleteUser: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/User',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteUser', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'User',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteUser'
                ]
            });
        },
        createUser: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/User/register',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllUsers');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'register',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllUsers'
                ]
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
                if (obj.login === data.login) {
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
                if (obj.login === data.login) {
                    data.role_name ? state.userData[index].role.name = data.role_name : false;
                    data.role_id ? state.userData[index].role.id = data.role_id : false;
                    data.name ? state.userData[index].name = data.name : false;
                    state.userData[index].group_name = data.group_name;
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
