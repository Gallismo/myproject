<template>
    <div>
        <div class="row justify-content-around">
            <h5 class="card-title col-12">Отделения</h5>
            <editCard v-show="getCurrentDepartment.code"><DepartmentEdit/></editCard>
            <createCard><DepartmentCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around">
            <h5 class="card-title col-12">Отделения</h5>
            <editCard v-show="getCurrentDepartment.code"><DepartmentEdit/></editCard>
            <createCard><DepartmentCreate/></createCard>
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
        },
        computed: {
            ...mapGetters(['getCurrentDepartment'])
        }
    }
</script>

<style scoped>

</style>
