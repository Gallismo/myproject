<template>
    <div>
        <div class="row justify-content-around departments">
            <h5 class="card-title col-12">Отделения</h5>
            <editCard v-if="getCurrentDepartment"><DepartmentEdit/></editCard>
            <createCard><DepartmentCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around audiences">
            <h5 class="card-title col-12">Аудитории</h5>
            <editCard v-if="getCurrentAudience"><AudienceEdit/></editCard>
            <createCard><AudienceCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around weeks">
            <h5 class="card-title col-12">Дни недели</h5>
            <editCard v-if="getCurrentWeek"><WeeksEdit/></editCard>
            <createCard><WeeksCreate/></createCard>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "Fundament",
        async mounted() {
            this.getAllDepartments();
            this.getAllAudiences();
            this.getAllWeeks();
        },
        methods: {
            ...mapActions(['getAllDepartments', 'getAllAudiences', 'getAllWeeks'])
        },
        computed: {
            ...mapGetters(['getCurrentDepartment', 'getCurrentAudience', 'getCurrentWeek'])
        }
    }
</script>

<style scoped>

</style>
