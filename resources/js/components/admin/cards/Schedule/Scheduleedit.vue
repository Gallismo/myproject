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
                const regExp = new RegExp('^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$')

                if (!regExp.test(start_time)) return false;
                if (!regExp.test(end_time)) return false;

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
