export default {
    actions: {
        getGroups: context => {
            axios('/api/Group')
                .then(response => {
                    context.commit('groupsDataFill', response.data)
                    context.commit('currentGroupFill', response.data)
                })
                .catch(error => console.log(error.response.data));
        },
        switchCurrentGroup: (context, group) => {
            context.commit('switchCurrentGroup', group.target.id)
        },
        editGroup: (context, data) => {
            axios({
                    method: 'patch',
                    url: '/api/Group',
                    data: data
                })
                .then(response => console.log(response.data))
                .then(() => {
                    context.dispatch('updateData', data)
                })
                .catch(error => console.log(error.response.data));

        },
        updateData: (context, data) => {
            context.commit('updateData', data)
        }
    },
    mutations: {
        groupsDataFill: (state, response) => {
            state.groupsData = response;
        },
        currentGroupFill: (state, response) => {
            state.currentGroup = response[0];
        },
        updateData: (state, data) => {
            state.groupsData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.groupsData[index].name = data.name : false;
                    data.department_name ? state.groupsData[index].department_name = data.department_name : false;
                    data.start_year ? state.groupsData[index].start_year = data.start_year : false;
                    data.end_year ? state.groupsData[index].end_year = data.end_year : false;
                }
            });
        },
        switchCurrentGroup: (state, code) => {
            state.currentGroup = state.groupsData.find(obj => obj.code === code);
        }
    },
    state: {
        groupsData: [],
        currentGroup: {}
    },
    getters: {
        getGroupsData: state => state.groupsData,
        getDropdownData: state => {
            let DropdownProp = {};
            state.groupsData.map(group => DropdownProp[group.code] = group.name);
            return DropdownProp;
        },
        getCurrentGroup: state => {return state.currentGroup}
    }
}
