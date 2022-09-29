<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userEdit" @keypress.enter="openModalSave">

            <h5 class="card-title">{{getCurrentUser.login}}</h5>
            <inputText code="name" alias="ФИО" placeholder="ФИО" inputName="name" :valueInput="getCurrentUser.name"/>
            <label for="selectRole">Роль</label>
            <SelectComp :select="getCurrentUser.role.name" v-if="getCurrentUser.role"
                        :items="getRolesData" id="selectRole" @clickEvent="roleChanged"/>
            <div v-show="getCurrentUser.role.id == 3" id="selectGroupDiv">
            <label for="selectGroup">Группа</label>
            <SelectComp id="selectGroup" :items="getGroupDropdown" :select="getCurrentUser.group_name"
                        defaultTitle="Группа" defaultValue="0"/>
            <small class="form-text text-muted">Для роли "Староста"</small>
            </div>

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
            ...mapActions(['saveUser', 'deleteUser']),
            openModalSave() {
                $('#saveConfirm').modal('show');
            },
            save() {
                const data = {
                    login: $('#userEdit .card-title').text(),
                    role_id: $('#userEdit select#selectRole').val(),
                    role_name: $('#userEdit select#selectRole option:selected').text(),
                };

                if ($('form#userEdit select#selectGroup').val() != 0 && !$('form#userEdit div#selectGroupDiv').attr('disabled')) {
                    data.group_id = $('form#userEdit select#selectGroup').val();
                    data.group_name = $('form#userEdit select#selectGroup option:selected').text();
                } else {
                    data.group_name = '';
                }

                this.saveUser(data);
            },
            deleteD() {
                const data = {
                    login: $('#userEdit .card-title').text()
                };
                this.deleteUser(data);
            },
            roleChanged() {
                if ($('form#userEdit select#selectRole').val() != 3) {
                    $('form#userEdit select#selectGroup').val('0');
                    $('form#userEdit div#selectGroupDiv').hide();
                } else {
                    $('form#userEdit div#selectGroupDiv').show();
                }
            }
        },
        computed: {
            ...mapGetters(['getCurrentUser', 'getRolesData', 'getGroupDropdown'])
        }
    }
</script>

<style scoped>

</style>
