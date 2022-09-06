export default {
    actions: {
        getAllGroupParts: function ({commit, dispatch}) {
            axios('/api/groupsPart')
                .then(response => {
                    commit('getAllGroupParts', response.data);
                    commit('currentGroupPartSet', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveGroupPart({commit, dispatch}, data) {
            // axios({
            //     method: 'patch',
            //     url: '/api/groupsPart',
            //     data: data
            // })
            //     .then(response => {
            //         commit('updateGroupPart', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'groupsPart',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateGroupPart'
                ]
            });
        },
        deleteGroupPart: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/groupsPart',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteGroupPart', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'groupsPart',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteGroupPart'
                ]
            });
        },
        createGroupPart: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/groupsPart',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllGroupParts');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'groupsPart',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllGroupParts'
                ]
            });
        },
        switchGroupPart({commit, dispatch}, code) {
            commit('switchGroupPart', code);
        }
    },
    mutations: {
        deleteGroupPart(state, data) {
            state.groupPartsData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.groupPartsData.splice(index, 1)
                }
            });
            state.currentGroupPart = state.groupPartsData[0]
        },
        getAllGroupParts: (state, response) => {
            state.groupPartsData = response;
        },
        currentGroupPartSet: (state, response) => {
            state.currentGroupPart = response[0]
        },
        switchGroupPart(state, code) {
            state.currentGroupPart = state.groupPartsData.find(groupPart => groupPart.code === code);
        },
        updateGroupPart: (state, data) => {
            state.groupPartsData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.groupPartsData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        groupPartsData: [],
        currentGroupPart: {}
    },
    getters: {
        getGroupPartsData: state => {
            return state.groupPartsData
        },
        getGroupPartDropdown: state => {
            let DropdownProp = {};
            state.groupPartsData.map(groupPart => DropdownProp[groupPart.code] = groupPart.name);
            return DropdownProp;
        },
        getCurrentGroupPart: state => {return state.currentGroupPart}
    }
}
