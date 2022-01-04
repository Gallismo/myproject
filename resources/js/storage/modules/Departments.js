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
        }
    },
    mutations: {
        getAllDepartments: (state, response) => {
            state.departmentsData = response;
        },
        currentDepartmentSet: (state, response) => {
            state.currentDepartment = response[0]
        }
    },
    state: {
        departmentsData: [],
        currentDepartment: {}
    },
    getters: {
        getDepartmentsData: state => state.groupsData,
        getDepartmentDropdown: state => {
            let DropdownProp = {};
            state.departmentsData.map(department => DropdownProp[department.code] = department.name);
            return DropdownProp;
        },
        getCurrentDepartment: state => {return state.currentDepartment}
    }
}
