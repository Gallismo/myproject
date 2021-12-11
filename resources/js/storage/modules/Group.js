export default {
    actions: {
        getGroups: context => {
            axios('/api/Group')
                .then(response => context.commit('groupsDataFill', response.data))
                .catch(error => {
                    if (error.response) {
                        // Request made and server responded
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                });
        },
        switchCurrentGroup: (context, group) => context.commit('switchCurrentGroup', group.target.id)
    },
    mutations: {
        groupsDataFill: (state, response) => {
            state.groupsData = response;
            state.currentGroup = response[0];
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
        getCurrentGroup: state => state.currentGroup
    }
}
