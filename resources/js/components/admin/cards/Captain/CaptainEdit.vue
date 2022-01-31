<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="captainEdit" @keypress.enter="confirmSave">

            <inputText code="name" alias="ФИО" placeholder="Иванов Иван Иванович" inputName="name" :valueInput="getCurrentCaptain.name"/>
            <label for="selectGroup">Группа</label>
            <SelectComp id="selectGroup" :items="getGroupDropdown" :select="getCurrentCaptain.group_name"/>
            <label for="selectUser">Пользователь</label>
            <SelectComp id="selectUser" :items="getUserDropdown" :select="getCurrentCaptain.user_name"/>

            <div class="row mt-4">
                <SaveButton target="#saveConfirm"/>
            </div>

            <BootstrapModalConfirm id="saveConfirm" @confirmEvent="save"></BootstrapModalConfirm>
        </form>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "CaptainEdit",
        methods: {
            ...mapActions(['saveCaptain']),
            confirmSave() {
                $('#saveConfirm').modal('show');
            },
            save() {
                const data = {
                    name: $('#captainEdit input[name=name]').val(),
                    user_id: $('#captainEdit select#selectUser').val(),
                    user_name: $('#captainEdit select#selectUser option:selected').text(),
                    group_code: $('#captainEdit select#selectGroup').val(),
                    group_name: $('#captainEdit select#selectGroup option:selected').text(),
                    code: this.getCurrentCaptain.code
                }
                this.saveCaptain(data);
            }
        },
        computed: {
            ...mapGetters(['getGroupDropdown', 'getUserDropdown', 'getCurrentCaptain'])
        }
    }
</script>

<style scoped>

</style>
