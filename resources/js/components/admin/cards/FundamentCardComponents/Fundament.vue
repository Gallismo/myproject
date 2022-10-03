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
        <hr>
        <div class="row justify-content-around lesson-orders">
            <h5 class="card-title col-12">Пары</h5>
            <editCard v-if="getCurrentLessonOrder"><LessonOrderEdit/></editCard>
            <createCard><LessonOrderCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around group-parts">
            <h5 class="card-title col-12">Подгруппы</h5>
            <editCard v-if="getCurrentGroupPart"><GroupPartsEdit/></editCard>
            <createCard><GroupPartsCreate/></createCard>
        </div>
        <hr>
        <div class="row justify-content-around subjects">
            <h5 class="card-title col-12">Предметы</h5>
            <editCard v-if="getCurrentSubject"><SubjectsEdit/></editCard>
            <createCard><SubjectsCreate/></createCard>
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
            this.getAllLessonOrders();
            this.getAllGroupParts();
        },
        methods: {
            ...mapActions(['getAllDepartments', 'getAllAudiences', 'getAllWeeks', 'getAllLessonOrders', 'getAllGroupParts'])
        },
        computed: {
            ...mapGetters(['getCurrentDepartment', 'getCurrentSubject', 'getCurrentAudience', 'getCurrentWeek', 'getCurrentLessonOrder', 'getCurrentGroupPart'])
        }
    }
</script>

<style scoped>

</style>
