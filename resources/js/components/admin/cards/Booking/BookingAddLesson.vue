<template>
    <div class="card bg-dark text-white">
        <form class="card-body grid-1" id="LessonCreate" >
            <div class="grid-1 grid-md-2 grid-gap-4">
                <div class="form-group">
                    <label for="date">Дата</label>
                    <b-form-datepicker id="date" locale="ru" class="btn-secondary"
                                       :date-format-options="{'year': 'numeric', 'month': 'numeric', 'day': 'numeric'}"/>
                </div>
                <div class="form-group">
                    <label for="lesson_order">Пара</label>
                    <select-comp class="" id="lesson_order" :items="$store.getters.getLessonOrderDropdown"></select-comp>
                </div>
            </div>
            <div class="grid-1 grid-md-2 grid-lg-3 grid-gap-4">
                <div class="form-group">
                    <label for="group">Группы</label>
                    <select-comp class="" id="group" :items="$store.getters.getGroupDropdown"></select-comp>
                </div>
                <div class="form-group">
                    <label for="teacher">Преподаватель</label>
                    <select-comp class="" id="teacher" :items="$store.getters.getTeacherDropdown"></select-comp>
                </div>
                <div class="form-group">
                    <label for="audience">Кабинет</label>
                    <select-comp class="" id="audience" :items="$store.getters.getAudienceDropdown"></select-comp>
                </div>
            </div>
            <div class="grid-1 grid-md-2 grid-gap-4">
                <div class="form-group">
                    <label for="group_part">Подгруппа</label>
                    <select-comp class="" id="group_part" :items="$store.getters.getGroupPartDropdown"></select-comp>
                </div>
                <div class="form-group">
                    <label for="subject">Предмет</label>
                    <select-comp class="" id="subject" :items="$store.getters.getSubjectDropdown"></select-comp>
                </div>
            </div>
            <div class="row mt-4">
                <SaveButton target="#createConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="createConfirm"></BootstrapModalConfirm>
    </div>
</template>


<script>
import {BFormDatepicker} from 'bootstrap-vue';
export default {
    name: "BookingAddLesson",
    components: {BFormDatepicker}
}
</script>

<style scoped>

</style>
