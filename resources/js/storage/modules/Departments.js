export default {
    actions: {
        getAllDepartments: function ({commit, dispatch}) {
            axios('/api/Department')
                .then(response => {
                    commit('getAllDepartments', response.data);
                    commit('currentDepartmentSet', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        saveDepartment({commit, dispatch}, data) {
            axios({
                method: 'patch',
                url: '/api/Department',
                data: data
            })
                .then(response => {
                    commit('updateDepartment', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        deleteDepartment: ({commit, dispatch}, data) => {
            axios({
                method: 'delete',
                url: '/api/Department',
                data: data
            })
                .then(response => {
                    commit('deleteDepartment', data);
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        createDepartment: ({commit, dispatch}, data) => {
            axios({
                method: 'post',
                url: '/api/Department',
                data: data
            })
                .then(response => {
                    dispatch('getAllDepartments');
                    dispatch('showNotification', response.data);
                })
                .catch(error => {
                    dispatch('showNotification', error.response.data);
                });
        },
        switchDepartment({commit, dispatch}, code) {
            commit('switchDepartment', code);
        }
    },
    mutations: {
        deleteDepartment(state, data) {
            state.departmentsData.map((obj, index) => {
                if (obj.code === data.code) {
                    state.departmentsData.splice(index, 1)
                }
            });
            state.currentDepartment = state.departmentsData[0]
        },
        getAllDepartments: (state, response) => {
            state.departmentsData = response;
        },
        currentDepartmentSet: (state, response) => {
            state.currentDepartment = response[0]
        },
        switchDepartment(state, code) {
            state.currentDepartment = state.departmentsData.find(department => department.code === code);
        },
        updateDepartment: (state, data) => {
            state.departmentsData.map((obj, index) => {
                if (obj.code === data.code) {
                    data.name ? state.departmentsData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        departmentsData: [],
        currentDepartment: {}
    },
    getters: {
        getDepartmentsData: state => {return state.departmentsData},
        getDepartmentDropdown: state => {
            let DropdownProp = {};
            state.departmentsData.map(department => DropdownProp[department.code] = department.name);
            return DropdownProp;
        },
        getCurrentDepartment: state => {return state.currentDepartment}
    }
}
