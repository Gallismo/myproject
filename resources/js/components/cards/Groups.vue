<template >
    <div>
        <groupDescription class="col-12 col-md-6 col-lg-5"/>
        <groupCreate class="col-12 col-md-5 mt-3 mt-md-0"/>
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
            ...mapGetters(['getCurrentGroup', 'getGroupsData'])
        }
    }
</script>

<style scoped>

</style>
