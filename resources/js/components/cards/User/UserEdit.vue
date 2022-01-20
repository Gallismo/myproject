<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userEdit" @keypress.enter="openModalSave">

            <h5 class="card-title">{{getCurrentUser.login}}</h5>
            <label for="role">Роль</label>
            <SelectComp :select="getCurrentUser.role.name" v-if="getCurrentUser.role"
                        :items="getRolesData" id="role"/>

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
                    role_id: $('#userEdit select').val(),
                    role_name: $('#userEdit select option:selected').text()
                };

                this.saveUser(data);
            },
            deleteD() {
                const data = {
                    login: $('#userEdit .card-title').text()
                };
                this.deleteUser(data);
            }
        },
        computed: {
            ...mapGetters(['getCurrentUser', 'getRolesData'])
        }
    }
</script>

<style scoped>

</style>
