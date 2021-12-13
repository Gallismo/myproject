export default {
    actions: {
        getAllDepartments: function (context) {
            axios('/api/Department')
                .then(response => {
                    context.commit('getAllDepartments', response.data)
                    context.commit('currentDepartmentSet', response.data)
                })
                .catch(error => console.log(error.response.data));
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
