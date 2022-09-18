<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="scheduleEdit" :data-id="getCurrentSchedule.id" @keypress.enter="openModalSave">
            <div class="card-title">
                <h5 >{{getCurrentSchedule.department_name}}</h5>
                <h5 >{{getCurrentSchedule.week_day_name + " " + getCurrentSchedule.lesson_order_name}}</h5>
            </div>
            <inputText code="name" alias="Начало" placeholder="Начало"  inputName="start_time" :valueInput="getCurrentSchedule.start_time"/>
            <inputText code="name" alias="Конец" placeholder="Конец"  inputName="end_time" :valueInput="getCurrentSchedule.end_time"/>
            <inputText code="name" alias="Перемена (Минут)" placeholder="Перемена"  inputName="break" :valueInput="getCurrentSchedule.break"/>

            <div class="row mt-4">
                <SaveButton target="#saveConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="saveConfirm" @confirmEvent="save"></BootstrapModalConfirm>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "ScheduleEdit",
        methods: {
            ...mapActions(['saveSchedule', 'deleteSchedule']),
            openModalSave() {
                $('#saveConfirm').modal('show');
            },
            checkTimeFormat(start_time = '', end_time = '') {
                const startTimeArr = start_time.split(":");
                const endTimeArr = end_time.split(":");
                const startHour = startTimeArr[0];
                const startMin = startTimeArr[1];
                const endHour = endTimeArr[0];
                const endMin = endTimeArr[1];
                if ((Number.isNaN(startHour) || startHour === undefined || startHour.length !== 2) ||
                    (Number.isNaN(startMin)  || startMin === undefined  || startMin.length !== 2)) return false;

                if ((Number.isNaN(endHour)   || endHour === undefined   || endHour.length !== 2)   ||
                    (Number.isNaN(endMin)    || endMin === undefined    || endMin.length !== 2)) return false;

                return true;
            },
            save() {
                const start_time = $('#scheduleEdit input[name=start_time]').val().trim();
                const end_time = $('#scheduleEdit input[name=end_time]').val().trim();
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
                    id: $('#scheduleEdit').attr('data-id'),
                    start_time: start_time,
                    end_time: end_time,
                    break: $('#scheduleEdit input[name=break]').val(),
                };

                this.saveSchedule(data);
            }
        },
        computed: {
            ...mapGetters(['getCurrentSchedule', 'getRolesData', 'getGroupDropdown'])
        }
    }
</script>

<style scoped>

</style>
