import Notification from "./Notification";

export default {
    actions: {
        async getGroups({commit, dispatch}, query = {}) {
            commit('setLoadingGroup', true);
            axios.get('/api/Group', {
                params: {
                    department: query.department,
                    start: query.start,
                    end: query.end
                }
            })
                .then(response => {
                    commit('groupsDataFill', response.data);
                    commit('currentGroupFill', response.data);
                    commit('setLoadingGroup', false);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchCurrentGroup: ({commit, dispatch}, code) => {
            commit('switchCurrentGroup', code)
        },
        editGroup: ({commit, dispatch}, data) => {
            axios({
                    method: 'patch',
                    url: '/api/Group',
                    data: data
                })
                .then(response => {
                    commit('updateGroup', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });

        },
        deleteGroup: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/Group',
                data: data
            })
                .then(response => {
                    commit('deleteGroupData', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createGroup: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/Group',
                data: data
            }).then(response => {
                    dispatch('showNotification', response.data);
                    dispatch('getGroups');
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
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
                if (obj.code === data.code) {
                    console.log(data.department_name);
                    data.name ? state.groupsData[index].name = data.name : false;
                    data.department_name ? state.groupsData[index].department_name = data.department_name : false;
                    data.start_year ? state.groupsData[index].start_year = data.start_year : false;
                    data.end_year ? state.groupsData[index].end_year = data.end_year : false;
                }
            });
        },
        deleteGroupData: (state, data) => {
            state.groupsData.map((obj, index) => {
                    if (obj.code === data.code) {
                        state.groupsData.splice(index, 1)
                    }
            });
            state.currentGroup = state.groupsData[0]
        },
        switchCurrentGroup: (state, code) => {
            state.currentGroup = state.groupsData.find(obj => obj.code === code);
        },
        setLoadingGroup(state, type) {
            if (state.loadingGroup === type) {
                return false;
            }
            state.loadingGroup = !state.loadingGroup;
        }
    },
    state: {
        groupsData: [],
        currentGroup: {},
        loadingGroup: false
    },
    getters: {
        getGroupsData: state => {
            return state.groupsData
        },
        getDropdownData: state => {
            let DropdownProp = {};
            state.groupsData.map(group => DropdownProp[group.code] = group.name);
            return DropdownProp;
        },
        getCurrentGroup: state => {return state.currentGroup},
        loadingGroup(state) {return state.loadingGroup}
    }
}
