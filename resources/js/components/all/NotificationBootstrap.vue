<template>
        <div class="position-fixed p-3" style="z-index: 20000; right: 0; bottom: 0; width: 310px">
            <div class="toast fade bg-secondary" :class="{show: getNotification.show, hide: getNotification.hide}"
                 role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-white bg-dark border-info">
                    <svg class="rounded mr-2" height="15" width="15" focusable="false">
                        <rect width="100%" height="100%" :fill="color" />
                    </svg>
                    <strong class="mr-auto">{{getNotification.title}}</strong>
                    <small class="text-muted">Только что</small>
                </div>

                <div class="toast-body text-white bg-secondary">
                    <h6>{{ getNotification.text }}</h6>
                    <hr v-show="getNotification.errors[0]">
                    <ul class="pl-2 errors-list">
                        <li v-for="(error, index) in getNotification.errors" :key="index">{{error}}</li>
                    </ul>
                </div>

            </div>
        </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    name: "NotificationBootstrap",
    computed: {
        ...mapGetters(['getNotification']),
        color: function () {
            if (this.getNotification.title.toLowerCase().includes('успешно')) {
                return '#28a745';
            } else {
                return '#dc3545';
            }
        }
    },
}
</script>

<style scoped>

</style>
