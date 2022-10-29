<template>
    <div class="card bg-dark text-white">
        <form class="card-body grid-1" id="LessonCreate" >
            <div class="grid-1 grid-md-2 grid-gap-4">
                <div class="form-group">
                    <label for="date">Дата</label>
                    <b-form-datepicker id="date" locale="ru" class="btn-secondary" :dark="true" v-model="date"
                                       label-no-date-selected="Дата не выбрана" :reset-button="true"
                                       label-reset-button="Сбросить" label-today-button="Сегодня"
                                       label-current-month="Текущий месяц" label-next-month="Следующий месяц"
                                       label-next-year="Следующий год" label-prev-month="Предыдущий месяц"
                                       label-prev-year="Предыдущий год" label-help="Используйте стрелки для навигации по числам"
                                       :today-button="true" start-weekday="1" @input="loadLessonOrders"
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

        <BootstrapModalConfirm id="createConfirm" @confirmEvent="create"></BootstrapModalConfirm>
    </div>
</template>


<script>
import {BFormDatepicker} from 'bootstrap-vue';
export default {
    name: "BookingAddLesson",
    components: {BFormDatepicker},

    data() {
        return {
            date: '',
            lessonOrders: {}
        }
    },
    methods: {
        create() {
            let data = {
                lesson_date: this.date,
                lesson_order_id: $('#LessonCreate select#lesson_order').val(),
                audience_id: $('#LessonCreate select#audience').val(),
                subject_id: $('#LessonCreate select#subject').val(),
                teacher_id: $('#LessonCreate select#teacher').val(),
                group_id: $('#LessonCreate select#group').val(),
                group_part_id: $('#LessonCreate select#group_part').val()
            };

            this.$store.dispatch('createBooking', data);
        },
        loadLessonOrders(date) {
            if (!date) {
                return;
            }
            axios.get()
        }
    }
}
</script>

<style scoped>

</style>
