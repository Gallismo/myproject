<template >
    <div>
        <groupDescription class="col-12 col-md-6 col-lg-5" v-show="getCurrentGroup"/>
        <groupCreate class="col-12 col-md-5 mt-3 mt-md-0" v-show="getCurrentDepartment"/>
        <div class="card-text text-center" v-show="!getCurrentDepartment">
            Требуется наличие хотя бы одного отделения для того, чтобы добавить группу
        </div>

    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name: "Groups",
        async mounted() {
            this.getGroups();
            this.getAllDepartments();
        },
        methods: {
            ...mapActions(['getGroups', 'getAllDepartments'])
        },
        computed: {
            ...mapGetters(['getCurrentGroup', 'getGroupsData', 'getCurrentDepartment'])
        }
    }
</script>

<style scoped>

</style>
