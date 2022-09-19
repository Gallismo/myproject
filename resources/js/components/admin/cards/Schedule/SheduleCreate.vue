<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="sheduleCreate" :data-id="getCurrentSchedule.id" @keypress.enter="openModalSave">
            <div class="form-group">
                <label for="department">Отделение</label>
                <select-comp class="" id="department" :items="getDepartmentDropdown"></select-comp>
            </div>
            <div class="form-group">
                <label for="lesson_number">Пара</label>
                <select-comp id="lesson_number" :items="getLessonOrderDropdown"></select-comp>
            </div>
            <div class="form-group">
                <label for="week_day">День недели</label>
                <select-comp id="week_day" :items="getWeekDropdown"></select-comp>
            </div>
            <inputText id="start_time" alias="Начало" placeholder="Начало" inputName="start_time" />
            <inputText id="end_time" alias="Конец" placeholder="Конец"  inputName="end_time" />
            <inputText id="break" alias="Перемена (Минут)" placeholder="Перемена"  inputName="break" />

            <div class="row mt-4">
                <SaveButton target="#createConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="createConfirm"  @confirmEvent="save"></BootstrapModalConfirm>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import checkTimeFormat from "../../../../mixins/checkTimeFormat";
import InputText from "../../../all/inputText";
import departments from "../../../../storage/modules/Departments";

export default {
    name: "ScheduleEdit",
    components: {InputText},
    mixins: [checkTimeFormat],
    methods: {
        ...mapActions(['createSchedule', 'deleteSchedule']),
        openModalSave() {
            $('#createConfirm').modal('show');
        },
        save() {
            const start_time = $('#sheduleCreate input[name=start_time]').val().trim();
            const end_time = $('#sheduleCreate input[name=end_time]').val().trim();
            if(!this.checkTimeFormat(start_time, end_time)) {
                this.$store.dispatch('showNotification', {
                    title: 'Ошибка ввода',
                    body: 'Неправильный формат ввода времени, требуется вводить в формате ЧЧ:ММ (например 12:30)',
                    errors: [
                        [`Вы ввели: " ${start_time} " и " ${end_time} "`]
                    ]
                });
                return;
            }

            const data = {
                start_time: start_time,
                end_time: end_time,
                department_id: $('#sheduleCreate select#department').val(),
                lesson_order_id: $('#sheduleCreate select#lesson_number').val(),
                week_day_id: $('#sheduleCreate select#week_day').val(),
                break: $('#sheduleCreate input[name=break]').val(),
            };

            this.createSchedule(data);
        }
    },
    computed: {
        ...mapGetters(['getCurrentSchedule', 'getWeekDropdown', 'getDepartmentDropdown' , 'getLessonOrderDropdown'])
    }
}
</script>

<style scoped>
    #createConfirm{
        z-index: 100;
    }
</style>
