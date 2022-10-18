export default {
    actions: {
        getAllBookings: function ({commit, dispatch}, query) {
            commit('setLoading', true)

            dispatch('sendRequest', {
                entity: 'lessonBooking',
                method: 'get',
                params: query,
                toDoComm: [
                    'getAllBookings',
                    'currentBookingSet'
                ]
            });
        },
        saveBooking({commit, dispatch}, data) {
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
                entity: 'lessonBooking',
                method: 'patch',
                data: data,
                toDoComm:[
                    'updateBooking'
                ]
            });
        },
        deleteBooking: ({commit, dispatch}, data) => {
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
                entity: 'lessonBooking',
                method: 'delete',
                data: data,
                toDoDisp:[
                    'getAllBookings'
                ]
            });
        },
        createBooking: ({commit, dispatch}, data) => {
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
                entity: 'lessonBooking',
                method: 'post',
                data: data,
                toDoDisp:[
                    'getAllBookings'
                ]
            });
        },
        switchBooking({commit, dispatch}, id) {
            commit('switchBooking', id);
        }
    },
    mutations: {
        deleteBooking(state, data) {
            state.weeksData.map((obj, index) => {
                if (obj.id == data.id) {
                    state.weeksData.splice(index, 1)
                }
            });
            state.currentBooking = state.bookingsData[0]
        },
        getAllBookings: (state, response) => {
            state.bookingsData = response.raw_bookings;
            state.formattedBookings = response.formatted_bookings;
        },
        currentBookingSet: (state, response) => {
            state.currentBooking = response.raw_bookings[0]
        },
        switchBooking(state, id) {
            state.currentBooking = state.bookingsData.find(booking => booking.id == id);
        },
        updateBooking: (state, data) => {
            state.bookingsData.map((obj, index) => {
                if (obj.id == data.id) {
                    data.name ? state.bookingsData[index].name = data.name : false;
                }
            });
        },
    },
    state: {
        bookingsData: [],
        currentBooking: {},
        formattedBookings: []
    },
    getters: {
        getBookingsData: state => {
            return state.bookingsData
        },
        getFormattedBookingsData: state => state.formattedBookings,
        getCurrentBooking: state => {return state.currentBooking}
    }
}
