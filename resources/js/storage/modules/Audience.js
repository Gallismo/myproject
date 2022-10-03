export default {
    actions: {
        getAllAudiences: function ({commit, dispatch}) {
            commit('setLoading', true)
            // axios('/api/Audience')
            //     .then(response => {
            //         commit('getAllAudiences', response.data);
            //         commit('currentAudienceSet', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Audience',
                method: 'get',
                data: {},
                toDoComm: [
                    'getAllAudiences',
                    'currentAudienceSet'
                ]
            });
        },
        saveAudience({commit, dispatch}, data) {
            // axios({
            //     method: 'patch',
            //     url: '/api/Audience',
            //     data: data
            // })
            //     .then(response => {
            //         commit('updateAudience', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Audience',
                method: 'patch',
                data: data,
                toDoComm: [
                    'updateAudience',
                ]
            });
        },
        deleteAudience: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'delete',
            //     url: '/api/Audience',
            //     data: data
            // })
            //     .then(response => {
            //         commit('deleteAudience', data);
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Audience',
                method: 'delete',
                data: data,
                toDoComm: [
                    'deleteAudience',
                ]
            });
        },
        createAudience: ({commit, dispatch}, data) => {
            // axios({
            //     method: 'post',
            //     url: '/api/Audience',
            //     data: data
            // })
            //     .then(response => {
            //         dispatch('getAllAudiences');
            //         dispatch('showNotification', response.data);
            //     })
            //     .catch(error => {
            //         dispatch('showNotification', error.response.data);
            //     });
            dispatch('sendRequest', {
                entity: 'Audience',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllAudiences'
                ]
            });

        },
        switchAudience({commit, dispatch}, code) {
            commit('switchAudience', code);
        }
    },
    mutations: {
        deleteAudience(state, data) {
            state.audienceData.map((obj, index) => {
                if (obj.id == data.id) {
                    state.audienceData.splice(index, 1)
                }
            });
            state.currentAudience = state.audienceData[0]
        },
        getAllAudiences: (state, response) => {
            state.audienceData = response;
        },
        currentAudienceSet: (state, response) => {
            state.currentAudience = response[0]
        },
        switchAudience(state, id) {
            state.currentAudience = state.audienceData.find(audience => audience.id == id);
        },
        updateAudience: (state, data) => {
            state.audienceData.map((obj, index) => {
                if (obj.id == data.id) {
                    data.name ? state.audienceData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        audienceData: [],
        currentAudience: {}
    },
    getters: {
        getAudiencesData: state => {
            return state.audienceData
        },
        getAudienceDropdown: state => {
            let DropdownProp = {};
            state.audienceData.map(audience => DropdownProp[audience.id] = audience.name);
            return DropdownProp;
        },
        getCurrentAudience: state => {return state.currentAudience}
    }
}
