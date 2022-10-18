export default {
    actions: {
        getAllSubjects: function ({commit, dispatch}) {
            commit('setLoading', true)
            // axios('/api/Week')
            //     .then(response => {
            //         commit('getAllWeeks', response.data);
            //         commit('currentSubjectSet', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });

            dispatch('sendRequest', {
                entity: 'Subject',
                method: 'get',
                toDoComm: [
                    'getAllSubjects',
                    'currentSubjectSet'
                ]
            });
        },
        saveSubject({commit, dispatch}, data) {
            // axios({
            // //     method: 'patch',
            // //     url: '/api/Week',
            // //     data: data
            // // })
            // //     .then(response => {
            // //         commit('updateWeek', data);
            // //         dispatch('showNotification', response.data);
            // //     })
            // //     .catch(error => {
            // //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Subject',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateSubject'
                ]
            });
        },
        deleteSubject: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Week',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteWeek', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Subject',
                method: 'delete',
                data: data,
                toDoComm:[
                    'deleteSubject'
                ]
            });
        },
        createSubject: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Week',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllWeeks');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Subject',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllSubjects'
                ]
            });
        },
        switchSubject({commit, dispatch}, id) {
            commit('switchSubject', id);
        }
    },
    mutations: {
        deleteSubject(state, data) {
            state.subjectsData.map((obj, index) => {
                if (obj.id == data.id) {
                    state.subjectsData.splice(index, 1)
                }
            });
            state.currentSubject = state.subjectsData[0]
        },
        getAllSubjects: (state, response) => {
            state.subjectsData = response;
        },
        currentSubjectSet: (state, response) => {
            state.currentSubject = response[0]
        },
        switchSubject(state, id) {
            state.currentSubject = state.subjectsData.find(subject => subject.id == id);
        },
        updateSubject: (state, data) => {
            state.subjectsData.map((obj, index) => {
                if (obj.id == data.id) {
                    data.name ? state.subjectsData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        subjectsData: [],
        currentSubject: {}
    },
    getters: {
        getSubjectsData: state => {
            return state.subjectsData
        },
        getSubjectDropdown: state => {
            let DropdownProp = {};
            state.subjectsData.map(subject => DropdownProp[subject.id] = subject.name);
            return DropdownProp;
        },
        getCurrentSubject: state => {return state.currentSubject}
    }
}
