<template>
    <div class="d-flex flex-column">
        <div class="d-flex top-menu justify-content-end">
            <a href="/login" class="nav-link text-info">Вход</a>
        </div>
        <div class="d-flex text-white wrapper justify-content-center p-4">
            <div class="card bg-dark">
                <div class="card-header grid-sm-3 grid-1 grid-gap-1 lessons-tabs">
                    <h4 v-for="(name, id) in $store.getters.getLessonsTabs" :id="id"
                        class="btn btn-info" :class="{ active: active === id }" @click="switchAction">{{name}}</h4>
                </div>
                <div class="card-body">
                    <component :is="$store.getters.getCurrentLessonTab"/>
                </div>
            </div>
        </div>
        <NotificationBootstrap/>
    </div>
</template>

<script>
    export default {
        name: "index",

        methods: {
            switchAction(event) {
                this.$store.dispatch('switchLessonTab', event);
            }
        },
        computed: {
            active() {
                return this.$store.getters.getCurrentLessonTab
            }
        }
    }
</script>

<style scoped>
    .wrapper .card {
        min-width: 80%;
    }
</style>
