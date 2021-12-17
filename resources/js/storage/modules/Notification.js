export default {
    actions: {
        showNotification({context, state}, data) {
            console.log('уведомление')
            clearTimeout(state.showId);
            clearTimeout(state.hideId);
            let showId, hideId;
            context.commit('showNotification', data);
            showId = setTimeout(function () {
                context.commit('unShowNotification');
                hideId = setTimeout(function () {
                    context.commit('hideNotification');
                }, 200);
                context.commit('bindHideId', hideId);
            }, 5000);
            context.commit('bindShowId', showId);
        }
    },
    mutations: {
        showNotification(state, data) {
            state.notification.title = data.title;
            state.notification.text = data.text;
            state.notification.text = data.errors;
            state.notification.hide = false;
            state.notification.show = true;
        },
        unShowNotification(state) {
            state.notification.show = false;
        },
        hideNotification(state) {
            state.notification.title = 'Ошибка';
            state.notification.text = '';
            state.notification.errors = {};
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
            errors: {}
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
