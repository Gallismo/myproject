export default {
    actions: {
        showNotification({commit, dispatch, state}, data) {
            // Очистка предыдущего уведомления
            commit('clearNotification');
            clearTimeout(state.showId);
            clearTimeout(state.hideId);
            // Переменный для того чтобы запомнить счеткики для очистки
            let showId, hideId;

            commit('showNotification', data);
            // Счетчик для скрытия уведомления
            showId = setTimeout(function () {

                commit('unShowNotification');
                // Счетчик для полного скрытия уведомления
                hideId = setTimeout(function () {
                    commit('clearNotification');
                    commit('hideNotification');
                }, 200);
                commit('bindHideId', hideId);

            }, 5000);
            commit('bindShowId', showId);
        }
    },
    mutations: {
        showNotification(state, data) {
            state.notification.title = data.title;
            state.notification.text = data.text;
            Object.values(data.errors).map(errorArr => {
                errorArr.map(error => state.notification.errors.push(error));
            });
            state.notification.hide = false;
            state.notification.show = true;
        },
        unShowNotification(state) {
            state.notification.show = false;
        },
        clearNotification(state) {
            state.notification.title = 'Ошибка';
            state.notification.text = '';
            state.notification.errors = [];
        },
        hideNotification(state) {
            state.notification.hide = true;
        },
        bindShowId(state, timeoutId) {
            state.showId = timeoutId;
        },
        bindHideId(state, timeoutId) {
            state.hideId = timeoutId;
        }
    },
    state: {
        notification: {
            show: false,
            hide: true,
            title: 'Ошибка',
            text: '',
            errors: []
        },
        showId: null,
        hideId: null
    },
    getters: {
        getNotification(state) {
            return state.notification;
        }
    }
}
