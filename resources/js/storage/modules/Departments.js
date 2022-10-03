export default {
    actions: {
        getAllDepartments: function ({commit, dispatch}) {
            commit('setLoading', true)
            // axios('/api/Department')
            //     .then(response => {
            //         commit('getAllDepartments', response.data);
            //         commit('currentDepartmentSet', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Department',
                method: 'get',
                toDoComm:[
                    'getAllDepartments',
                    'currentDepartmentSet'
                ]
            });
        },
        saveDepartment({commit, dispatch}, data) {
            // axios({
            //     method: 'patch',
            //     url: '/api/Department',
            //     data: data
            // })
            //     .then(response => {
            //         commit('updateDepartment', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Department',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateDepartment'
                ]
            });
        },
        deleteDepartment: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Department',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteDepartment', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Department',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteDepartment'
                ]
            });

        },
        createDepartment: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Department',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllDepartments');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Department',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllDepartments'
                ]
            });
        },
        switchDepartment({commit, dispatch}, code) {
            commit('switchDepartment', code);
        }
    },
    mutations: {
        deleteDepartment(state, data) {
            state.departmentsData.map((obj, index) => {
                if (obj.id == data.id) {
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
        switchDepartment(state, id) {
            state.currentDepartment = state.departmentsData.find(department => department.id == id);
        },
        updateDepartment: (state, data) => {
            state.departmentsData.map((obj, index) => {
                if (obj.id == data.id) {
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
            state.departmentsData.map(department => DropdownProp[department.id] = department.name);
            return DropdownProp;
        },
        getCurrentDepartment: state => {return state.currentDepartment}
    }
}
