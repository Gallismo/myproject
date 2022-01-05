<template>
    <div>
        <div class="row justify-content-around">
            <DepartmentCard class="col-12 col-md-6 col-lg-5"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "Fundament",
        mounted() {
            this.getAllDepartments();
        },
        methods: {
            ...mapActions(['getAllDepartments'])
        }
    }
</script>

<style scoped>

</style>
