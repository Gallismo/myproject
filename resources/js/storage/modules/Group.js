import Notification from "./Notification";

export default {
    actions: {
        async getGroups({commit, dispatch}, query = {}) {
            commit('setLoading', true);
            // axios.get('/api/Group', {
            //     params: {
            //         department: query.department,
            //         start: query.start,
            //         end: query.end
            //     }
            // }).then(response => {
            //         commit('groupsDataFill', response.data);
            //         commit('currentGroupFill', response.data);
            //         commit('setLoadingGroup', false);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });

            dispatch('sendRequest', {
                entity: 'Group',
                method: 'get',
                params: {
                    department: query.department,
                    start: query.start,
                    end: query.end
                },
                toDoComm: [
                    'groupsDataFill',
                    'currentGroupFill'
                ]
            });
        },
        switchCurrentGroup: ({commit, dispatch}, id) => {
            commit('switchCurrentGroup', id)
        },
        editGroup: ({commit, dispatch}, data) => {
            // axios({
            //             //         method: 'patch',
            //             //         url: '/api/Group',
            //             //         data: data
            //             //     })
            //             //     .then(response => {
            //             //         commit('updateGroup', data);
            //             //         dispatch('showNotification', response.data);
            //             //     })
            //             //     .catch(error => {
            //             //         dispatch('showNotification', error.response.data);
            //             //     });
            dispatch('sendRequest', {
                entity: 'Group',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateGroup'
                ]
            });
        },
        deleteGroup: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Group',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteGroupData', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Group',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteGroupData'
                ]
            });
        },
        createGroup: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Group',
            //     data: data
            // }).then(response => {
            //         dispatch('showNotification', response.data);
            //         dispatch('getGroups');
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Group',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getGroups'
                ]
            });
        },
    },
    mutations: {
        groupsDataFill: (state, response) => {
            state.groupsData = response;
        },
        currentGroupFill: (state, response) => {
            state.currentGroup = response[0];
        },
        updateGroup: (state, data) => {
            state.groupsData.map((obj, index) => {
                if (obj.id == data.id) {
                    state.groupsData[index].name            = data.name             ?? state.groupsData[index].name;
                    state.groupsData[index].department_name = data.department_name  ?? state.groupsData[index].department_name;
                    state.groupsData[index].start_year      = data.start_year       ?? state.groupsData[index].start_year;
                    state.groupsData[index].end_year        = data.end_year         ?? state.groupsData[index].end_year;
                }
            });
        },
        deleteGroupData: (state, data) => {
            state.groupsData.map((obj, index) => {
                    if (obj.id == data.id) {
                        state.groupsData.splice(index, 1)
                    }
            });
            state.currentGroup = state.groupsData[0]
        },
        switchCurrentGroup: (state, id) => {
            state.currentGroup = state.groupsData.find(obj => obj.id == id);
        },
    },
    state: {
        groupsData: [],
        currentGroup: {},
    },
    getters: {
        getGroupsData: state => {
            return state.groupsData
        },
        getGroupDropdown: state => {
            let DropdownProp = {};
            state.groupsData.map(group => DropdownProp[group.id] = group.name);
            return DropdownProp;
        },
        getCurrentGroup: state => {return state.currentGroup},
    }
}
