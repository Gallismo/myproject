<template>
    <div>
        <div class="row justify-content-around departments">
            <h5 class="card-title col-12">Отделения</h5>
            <editCard v-show="getCurrentDepartment.code"><DepartmentEdit/></editCard>
            <createCard><DepartmentCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around audiences">
            <h5 class="card-title col-12">Аудитории</h5>
            <editCard v-show="getCurrentAudience.code"><AudienceEdit/></editCard>
            <createCard><AudienceCreate/></createCard>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "Fundament",
        mounted() {
            this.getAllDepartments();
            this.getAllAudiences();
        },
        methods: {
            ...mapActions(['getAllDepartments', 'getAllAudiences'])
        },
        computed: {
            ...mapGetters(['getCurrentDepartment', 'getCurrentAudience'])
        }
    }
</script>

<style scoped>

</style>
