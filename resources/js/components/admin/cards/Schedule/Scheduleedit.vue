<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="scheduleEdit" :data-id="getCurrentSchedule.code" @keypress.enter="openModalSave">
            <div class="card-title">
                <h5 >{{getCurrentSchedule.department_name}}</h5>
                <h5 >{{getCurrentSchedule.week_day_name + " " + getCurrentSchedule.lesson_order_name}}</h5>
            </div>
            <inputText code="name" alias="Начало" placeholder="Начало"  inputName="start_time" :valueInput="getCurrentSchedule.start_time"/>
            <inputText code="name" alias="Конец" placeholder="Конец"  inputName="end_time" :valueInput="getCurrentSchedule.end_time"/>
            <inputText code="name" alias="Перемена (Минут)" placeholder="Перемена"  inputName="break" :valueInput="getCurrentSchedule.break"/>

            <div class="row mt-4">
                <SaveButton target="#saveConfirm"/>
                <DeleteButton target="#deleteConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="saveConfirm" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteConfirm" @confirmEvent="deleteD"></BootstrapModalConfirm>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "UserEdit",
        methods: {
            ...mapActions(['saveSchedule', 'deleteSchedule']),
            openModalSave() {
                $('#saveConfirm').modal('show');
            },
            save() {
                const data = {
                    code: $('#scheduleEdit').attr('data-id'),
                    start_time: $('#scheduleEdit input[name=start_time]').val(),
                    end_time: $('#scheduleEdit input[name=end_time]').val(),
                    break: $('#scheduleEdit input[name=break]').val(),
                };

                this.saveSchedule(data);
            },
            deleteD() {
                const data = {
                    login: $('#userEdit .card-title').text()
                };
                this.deleteUser(data);
            },
        },
        computed: {
            ...mapGetters(['getCurrentSchedule', 'getRolesData', 'getGroupDropdown'])
        }
    }
</script>

<style scoped>

</style>
