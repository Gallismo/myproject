<template>
        <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0; width: 300px">
            <div class="toast fade bg-secondary" :class="{show: getNotification.show, hide: getNotification.hide}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-white bg-dark border-info">
                    <strong class="mr-auto">{{getNotification.title}}</strong>
                    <small class="text-muted">Только что</small>
                </div>
                <div class="toast-body text-white bg-secondary">
                    <h6>{{ getNotification.text }}</h6>
                    <p v-for="(error, index) in getNotification.errors" :key="index">{{error}}</p>
                </div>
            </div>
        </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    name: "NotificationBootstrap",
    computed: {
        ...mapGetters(['getNotification'])
    }
}
</script>

<style scoped>

</style>
