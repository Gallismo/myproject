export default {
    actions: {
        getAllPrepods: function ({commit, dispatch}, query = {}) {
            commit('setLoading', true);

            axios.get('/api/Prepod', {
                params: {
                    name: query.name,
                    user: query.user
                }
            })
                .then(response => {
                    commit('getAllPrepods', response.data);
                    commit('currentPrepodSet', response.data);
                    commit('setLoading', false);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        savePrepod({commit, dispatch}, data) {
            // axios({
            //     method: 'patch',
            //     url: '/api/Prepod',
            //     data: data
            // })
            //     .then(response => {
            //         commit('updatePrepod', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Prepod',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updatePrepod'
                ]
            });
        },
        deletePrepod: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Prepod',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deletePrepod', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Prepod',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deletePrepod'
                ]
            });
        },
        createPrepod: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Prepod',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllPrepods');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Prepod',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllPrepods'
                ]
            });
        },
        switchPrepod({commit, dispatch}, code) {
            commit('switchPrepod', code);
        }
    },
    mutations: {
        deletePrepod(state, data) {
            state.prepodData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.prepodData.splice(index, 1)
                }
            });
            state.currentPrepod = state.prepodData[0]
        },
        getAllPrepods: (state, response) => {
            state.prepodData = response;
        },
        currentPrepodSet: (state, response) => {
            state.currentPrepod = response[0]
        },
        switchPrepod(state, code) {
            state.currentPrepod = state.prepodData.find(prepod => prepod.code === code);
        },
        updatePrepod: (state, data) => {
            state.prepodData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.prepodData[index].name = data.name : false;
                    data.login ? state.prepodData[index].login = data.login : false;
                }
            });
        },
    },
    state: {
        prepodData: [],
        currentPrepod: {}
    },
    getters: {
        getPrepodData: state => {
            return state.prepodData
        },
        getPrepodDropdown: state => {
            let DropdownProp = {};
            state.prepodData.map(prepod => DropdownProp[prepod.code] = prepod.name);
            return DropdownProp;
        },
        getCurrentPrepod: state => {return state.currentPrepod}
    }
}
